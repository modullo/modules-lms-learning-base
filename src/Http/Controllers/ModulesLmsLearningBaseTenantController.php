<?php

namespace Modullo\ModulesLmsLearningBase\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Hostville\Modullo\Sdk;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modullo\ModulesLmsLearningBase\Jobs\Complete3pCourseJob;
use Modullo\ModulesLmsLearningBase\Services\SchedulerService;

class ModulesLmsLearningBaseTenantController extends Controller
{
    protected Sdk $sdk;
    private SchedulerService $schedulerService;
    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
        $this->schedulerService = new SchedulerService;
    }

    public function index()
    {
        $query = $this->sdk->createHomeService();
        $path = ['tenant','dashboard'];
        $response = $query->send('get',$path);

        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005'){
                $data = ['validation_error' => $response['errors'][0]['source'] ?? ''];
            }
            else{
                $data = ['error' => $response['errors'][0]['title'] ?? ''];
            }
            return view('modules-lms-base::welcome',compact('data'));
        }

        $data = $response->getData()['dashboardData'];
        return view('modules-lms-learning-base::tenants.base.dashboard',compact('data'));
    }

    public function settings()
    {
        $data = \auth()->user();
        return view('modules-lms-learning-base::tenants.base.settings',compact('data'));
    }

    public function updateSettings(Request $request, string $id, Sdk $sdk): JsonResponse
    {
        $user = \auth()->user();
        if ($request->filled('update_type') && $request->update_type === 'organization'){
            $resource = $sdk->createTenantsService();
            $resource = $resource
                ->addBodyParam('company_name',$request->company_name)
                ->addBodyParam('country',$request->country)
                ->addBodyParam('logo',$request->logo);
            $response = $resource->send('put',[$id]);
            if (!$response->isSuccessful()) {
                $response = $response->getData();
                if ($response['errors'][0]['code'] === '005') return response()->json(['validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
                return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

            }
            $data = $response->getData()['tenant'];
            $user->organization_details = $data['tenant'];
            $user->save();
        }
        else{
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
            ]);
        }
        return response()->json(['message' => 'Updated Successfully'],200);
    }

    public function management()
    {
        return view('modules-lms-learning-base::tenants.base.learner-management');
    }

    protected function getCourses(){
        $query = $this->sdk->createCourseService();
        $query = $query->addQueryArgument('limit',100);
        $path = ['all'];
        return $query->send('get', $path);
    }

    public function allCourses(Sdk $sdk){
        
        if ($this->getCourses()->isSuccessful()){
            $response = $this->getCourses()->getData();
            $data = $response['courses'];
            if(\request()->wantsJson()){
                return response()->json(['status' => 'Success','data'=>$data],200);
            }
            return view('modules-lms-learning-base::tenants.course.index',compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        if(\request()->wantsJson()){
            return response()->json(['status' => 'Error','data'=>$data],400);
        }
        return view('modules-lms-learning-base::tenants.course.index', compact('data'));
    }

    public function updateCourse(string $id, Request $request, Sdk $sdk): JsonResponse
    {
        $resource = $sdk->createCourseService();
        $resource = $resource
            ->addBodyParam('title',$request->title)
            ->addBodyParam('course_image',$request->course_image)
            ->addBodyParam('duration',$request->duration)
            ->addBodyParam('course_state',$request->course_state)
            ->addBodyParam('skills_to_be_gained',$request->skills_to_be_gained)
            ->addBodyParam('description',$request->description)
            ->addBodyParam('program_id',$request->program);
        $response = $resource->send('put',[$id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['message' => 'Updated Successfully'],200);
    }

    public function create()
    {
        $programs = [];
        if ($this->getPrograms()->isSuccessful()) {
            $response = $this->getPrograms()->getData();
            $programs = $response['programs'];
        }
        return view('modules-lms-learning-base::tenants.course.create',compact('programs'));
    }

    public function editCourse(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createCourseService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);

        $programs = [];
        if ($this->getPrograms()->isSuccessful()) {
            $programResponse = $this->getPrograms()->getData();
            $programs = $programResponse['programs'];
        }

        if ($response->isSuccessful()){
            $data = $response->data['course'];
            return view('modules-lms-learning-base::tenants.course.edit',compact('data', 'programs'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::tenants.course.edit',compact('data', 'programs'));
    }

    public function show(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createCourseService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['course'];
            if(\request()->wantsJson()){
                return response()->json(['status' => 'Success','data'=>$data],200);
            }
            return view('modules-lms-learning-base::tenants.course.show',compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        if(\request()->wantsJson()){
            return response()->json(['status' => 'Error','data'=>$data],400);
        }
        return view('modules-lms-learning-base::tenants.course.show',compact('data'));
    }

    public function courseStart(Request $request, Sdk $sdk)
    {
        $resource = $sdk->createCourseService();
        $path = ['start'];
        $resource = $resource
            ->addBodyParam('course_id',$request->course_id)
            ->addBodyParam('learner_id',$request->learner_id)
            ->addBodyParam('learner_course_id',$request->learner_course_id ?? null)
            ->addBodyParam('started_at',$request->started_at ?? null)
            ->addBodyParam('completed_at',$request->completed_at ?? null)
            ->addBodyParam('progress',$request->progress); //0 - 100

        if ($request->hasHeader('src') && $request->header('src') == '3p'){
            $resource = $resource
//                ->addBodyParam('uuid',$request->id)
                ->addBodyParam('src','3p');
        }

        $response = $resource->send('post',$path);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['status' => false,'message' => $response['errors'][0]['source'] ?? '','validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['status' => false,'message' => $response['errors'][0]['title'] ?? '','error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['status' => true,'message' => 'Course successfully started'],200);
    }

    public function courseComplete(Request $request, Sdk $sdk)
    {
        $resource = $sdk->createCourseService();
        $path = ['complete'];
        $resource = $resource
            ->addBodyParam('course_id',$request->course_id)
            ->addBodyParam('learner_id',$request->learner_id)
            ->addBodyParam('learner_course_id',$request->learner_course_id ?? null)
            ->addBodyParam('started_at',$request->started_at ?? null)
            ->addBodyParam('completed_at',$request->completed_at ?? null);

        if ($request->hasHeader('src') && $request->header('src') == '3p'){
            $resource = $resource
//                ->addBodyParam('uuid',$request->id)
                ->addBodyParam('src','3p');
        }

        $response = $resource->send('post',$path);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['status' => false,'message' => $response['errors'][0]['source'] ?? '','validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['status' => false,'message' => $response['errors'][0]['title'] ?? '','error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['status' => true,'message' => 'Course successfully completed'],200);
    }

    public function courseCompleteMany(Request $request, Sdk $sdk)
    {
        $request->validate([
            'courses' => 'required|array',
            'count' => 'required|integer',
        ]);

        if ($request->count !== count($request->courses)) {
            return response()->json(['status' => false,'message' => 'Course count does not match'],400);
        }

        foreach ($request->courses as $course){
            Complete3pCourseJob::dispatch($course);
        }

        return response()->json(['status' => true,'message' => 'Courses successfully queued for processing'],200);
    }


//    Lessons
    protected function getLessons(){
        $query = $this->sdk->createLessonService();
        $query = $query->addQueryArgument('limit',100);
        $path = [''];
        return $query->send('get', $path);
    }

    public function createLesson(Sdk $sdk)
    {
        $assets = [];
        $modules = [];
        $quizzes = [];
        $schedules = [];
        if ($this->getAssets()->isSuccessful()) {
            $assetSdk = $this->getAssets()->getData();
            $modulesSdk = $this->getModules()->getData();
            $quizzesSdk = $this->getQuiz()->getData();
            $assets = $assetSdk['assets'];
            $modules = $modulesSdk['modules'];
            $quizzes = $quizzesSdk['quizzes'];

            $schedulerToken = $this->schedulerService->getSchedulerToken($sdk,$this->tenantDetails());
            $schedules = $this->schedulerService->schedulerSchedules($schedulerToken);
//            dd($schedules);
            return view('modules-lms-learning-base::tenants.lessons.create', compact('assets','quizzes', 'modules','schedules'));
        }
        return view('modules-lms-learning-base::tenants.lessons.create', compact('assets','quizzes', 'modules','schedules'));
    }

    public function submitLesson(string $id, Request $request, Sdk $sdk) : JsonResponse
    {
        $resource = $sdk->createLessonService();
        $resource = $resource
        ->addBodyParam('title',$request->title)
        ->addBodyParam('description',$request->description)
        ->addBodyParam('duration',$request->duration)
        ->addBodyParam('lesson_number',$request->lesson_number)
        ->addBodyParam('lesson_type',$request->lesson_type)
        ->addBodyParam('lesson_image',  $request->lesson_image)
        ->addBodyParam('skills_gained',$request->skills_gained)
        ->addBodyParam('has_code_editor',$request->has_code_editor === 'yes' ? true : false)
        ->addBodyParam('code_language',$request->code_language)
        ->addBodyParam('resource_id',$request->resource_id);

        if ($request->hasHeader('src') && $request->header('src') == '3p'){
            $resource = $resource
                ->addBodyParam('uuid',$request->id)
                ->addBodyParam('full_data',$request->all())
                ->addBodyParam('src','3p');
        }

        switch ($request->lesson_type){
            case 'scheduler':
                $resource = $resource
                    ->addBodyParam('schedule_type',$request->schedule_type)
                    ->addBodyParam('schedule_instruction',$request->schedule_instruction);
                break;
            case 'project':
                $resource = $resource->addBodyParam('project_details',$request->project_details);
                break;
        }

        $response = $resource->send('post',['create', $id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['status' => false,'message' => $response['errors'][0]['source'] ?? '','error' => $response['errors'][0]['source'] ?? ''], $response['errors'][0]['status']);
            return response()->json(['status' => false,'message' => $response['errors'][0]['title'] ?? '','error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['status' => true,'message' => 'Lesson Created Successfully!'],200);
    }

    public function editLesson(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createLessonService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);
        $modules = [];
        $quizzes = [];
        $assets = [];
        if ($this->getAssets()->isSuccessful()) {
            $programResponse = $this->getAssets()->getData();
            $assets = $programResponse['assets'];
        }

        if ($response->isSuccessful()){
            $modulesSdk = $this->getModules()->getData();
            $quizzesSdk = $this->getQuiz()->getData();
            $modules = $modulesSdk['modules'];
            $quizzes = $quizzesSdk['quizzes'];
            $data = $response->data['lesson'];
            return view('modules-lms-learning-base::tenants.lessons.edit',compact('data', 'assets','quizzes', 'modules'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::tenants.lessons.edit',compact('data', 'assets','quizzes', 'modules'));
    }

    public function updateLesson(string $id, Request $request, Sdk $sdk): JsonResponse
    {
        $resource = $sdk->createLessonService();
        $resource = $resource
            ->addBodyParam('title',$request->title)
            ->addBodyParam('description',$request->description)
            ->addBodyParam('duration',$request->duration)
            ->addBodyParam('lesson_number',$request->lesson_number)
            ->addBodyParam('lesson_type',$request->lesson_type)
            ->addBodyParam('scheduler_type',$request->scheduler_type)
            ->addBodyParam('lesson_image',$request->lesson_image)
            ->addBodyParam('skills_gained',$request->skills_gained)
            ->addBodyParam('has_code_editor',$request->has_code_editor === 'yes' ? true : false)
            ->addBodyParam('code_language',$request->code_language)
            ->addBodyParam('resource_id', !$request->resource_id ? $request->lesson_resource['id'] : $request->resource_id)
            ->addBodyParam('module_id',$request->module_id);
        $response = $resource->send('put',[$id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['message' => 'Updated Successfully'],200);
    }

    public function allLesson()
    {
        $modules = [];
        if ($this->getLessons()->isSuccessful()){
            $modulesSdk = $this->getModules()->getData();
            $modules = $modulesSdk['modules'];
            $response = $this->getLessons()->getData();
            $data = $response['lessons'];
            if(\request()->wantsJson()){
                return response()->json(['status' => 'Success','data'=>$data],200);
            }
            return view('modules-lms-learning-base::tenants.lessons.index',compact('data', 'modules'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        if(\request()->wantsJson()){
            return response()->json(['status' => 'Error','data'=>$data],400);
        }
        return view('modules-lms-learning-base::tenants.lessons.index', compact('data', 'modules'));
    }

    public function filterLessonsByModule(string $id, Sdk $sdk) 
    {
        $sdkObject = $sdk->createLessonService();
        $path = ['all', $id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful())
        {
            return response(['data' => $response->getData()['lessons']], 200);
        }
        return response(['message'  => 'Error While Fetching lessons']);
    }


    //    Modules
    protected function getModules(){
        $query = $this->sdk->createModuleService();
        $query = $query->addQueryArgument('limit',100);
        $path = [''];
        return $query->send('get', $path);
    }

    public function createModules()
    {
        $courses = [];
        if ($this->getCourses()->isSuccessful()) {
            $response = $this->getCourses()->getData();
            $courses = $response['courses'];
            return view('modules-lms-learning-base::tenants.modules.create', compact('courses'));
        }
        return view('modules-lms-learning-base::tenants.modules.create', compact('courses'));
    }

    public function submitModule(Request $request, Sdk $sdk){
        $resource = $sdk->createModuleService();
        $resource = $resource
        ->addBodyParam('title',$request->title)
        ->addBodyParam('description',$request->description)
        ->addBodyParam('duration',$request->duration)
        ->addBodyParam('module_number',$request->module_number);

        if ($request->hasHeader('src') && $request->header('src') == '3p'){
            $resource = $resource
                ->addBodyParam('uuid',$request->id)
                ->addBodyParam('full_data',$request->all())
                ->addBodyParam('src','3p');
        }

        $response = $resource->send('post',['create',$request->course_id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['status' => false,'message' => $response['errors'][0]['source'] ?? '','error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['status' => false,'message' => $response['errors'][0]['title'] ?? '','error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['status' => true,'message' => 'Module Created Successfully!'],200);
    }

    public function editModules(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createModuleService();
        $path = [$id];
        $courses = [];
        $coursesSdk = $this->getCourses()->getData();
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $courses = $coursesSdk['courses'];
            $data = $response->data['module'];
            return view('modules-lms-learning-base::tenants.modules.edit',compact('data', 'courses'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::tenants.modules.edit',compact('data', 'courses'));
    }

    public function updateModule(string $id, Request $request, Sdk $sdk): JsonResponse
    {
        $resource = $sdk->createModuleService();
        $resource = $resource
            ->addBodyParam('title',$request->title)
            ->addBodyParam('description',$request->description)
            ->addBodyParam('duration',$request->duration)
            ->addBodyParam('module_number',$request->module_number)
            ->addBodyParam('course',$request->course['id']);
        $response = $resource->send('put',[$id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['message' => 'Updated Successfully'],200);
    }

    public function allModules()
    {
        $courses = [];
        // dd($this->getModules());
        $coursesSdk = $this->getCourses()->getData();
        if ($this->getModules()->isSuccessful()){
            $courses = $coursesSdk['courses'];
            $response = $this->getModules()->getData();
            $data = $response['modules'];
            if(\request()->wantsJson()){
                return response()->json(['status' => 'Success','data'=>$data],200);
            }
            return view('modules-lms-learning-base::tenants.modules.index', compact('data', 'courses'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        if(\request()->wantsJson()){
            return response()->json(['status' => 'Error','data'=>$data],400);
        }
        return view('modules-lms-learning-base::tenants.modules.index', compact('data', 'courses'));
    }

    public function filterModulesByCourse(string $id, Sdk $sdk) 
    {
        $sdkObject = $sdk->createModuleService();
        $path = ['all', $id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful())
        {
            return response(['data' => $response->getData()['modules']], 200);
        }
        return response(['message'  => 'Error While Fetching Modules']);
    }

    //    Program
    public function createProgram(Sdk $sdk)
    {
        return view('modules-lms-learning-base::tenants.programs.create');
    }

    public function submitProgram(Request $request, Sdk $sdk): JsonResponse
    {
        $resource = $sdk->createProgramService();
        $resource = $resource
            ->addBodyParam('title',$request->ProgramTitle)
            ->addBodyParam('description',$request->ProgramDescription)
            ->addBodyParam('image',$request->ProgramImage)
            ->addBodyParam('visibility_type',$request->ProgramVisibility);
        if ($request->hasHeader('src') && $request->header('src') == '3p'){
            $resource = $resource
                ->addBodyParam('uuid',$request->id)
                ->addBodyParam('full_data',$request->all())
                ->addBodyParam('src','3p');
        }

        $response = $resource->send('post',['']);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['status' => false,'message' => $response['errors'][0]['source'] ?? '','error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['status' => false,'message' => $response['errors'][0]['title'] ?? '','error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['status' => true,'message' => 'creation successful'],200);
    }

    /**
     * @throws GuzzleException
     */
    public function updateProgram(string $id, Request $request, Sdk $sdk): JsonResponse
    {
        $resource = $sdk->createProgramService();
        $resource = $resource
            ->addBodyParam('title',$request->title)
            ->addBodyParam('description',$request->description)
            ->addBodyParam('image',$request->image)
            ->addBodyParam('visibility_type',$request->visibility_type);
        $response = $resource->send('put',[$id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['message' => 'Updated Successfully'],200);
    }

    public function editProgram(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createProgramService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['program'];
            return view('modules-lms-learning-base::tenants.programs.edit',compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::tenants.programs.edit',compact('data'));
    }

    protected function getPrograms(){
        $query = $this->sdk->createProgramService();
        $query = $query->addQueryArgument('limit',100);
        $path = [''];
        return $query->send('get', $path);
    }

    public function allPrograms(Sdk $sdk)
    {
        if ($this->getPrograms()->isSuccessful()){
            $response = $this->getPrograms()->getData();
            $data = $response['programs'];
            if(\request()->wantsJson()){
                return response()->json(['status' => 'Success','data'=>$data],200);
            }
            return view('modules-lms-learning-base::tenants.programs.index',compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        if(\request()->wantsJson()){
            return response()->json(['status' => 'Error','data'=>$data],400);
        }
        return view('modules-lms-learning-base::tenants.programs.index',compact('data'));

    }

    public function showProgram(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createProgramService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['program'];
            if(\request()->wantsJson()){
                return response()->json(['status' => 'Success','data'=>$data],200);
            }
            return view('modules-lms-learning-base::tenants.programs.show', compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        if(\request()->wantsJson()){
            return response()->json(['status' => 'Error','data'=>$data],400);
        }
        return view('modules-lms-learning-base::tenants.programs.show', compact('data'));
    }

    public function programEnroll(Request $request, Sdk $sdk)
    {
        $resource = $sdk->createProgramService();
        $path = ['enroll'];
        $resource = $resource
            ->addBodyParam('program_id',$request->program_id)
            ->addBodyParam('learner_id',$request->learner_id)
            ->addBodyParam('learner_program_id',$request->learner_program_id ?? null)
            ->addBodyParam('started',$request->started ?? 'no')
            ->addBodyParam('progress',$request->progress ?? null); //0 - 100

        if ($request->hasHeader('src') && $request->header('src') == '3p'){
            $resource = $resource
//                ->addBodyParam('uuid',$request->id)
                ->addBodyParam('src','3p');
        }

        $response = $resource->send('post',$path);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['status' => false,'message' => $response['errors'][0]['source'] ?? '','validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['status' => false,'message' => $response['errors'][0]['title'] ?? '','error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['status' => true,'message' => 'Learner Successfully enrolled'],200);
    }

    public function programComplete(Request $request, Sdk $sdk)
    {
        $resource = $sdk->createProgramService();
        $path = ['complete'];
        $resource = $resource
            ->addBodyParam('program_id',$request->program_id)
            ->addBodyParam('learner_id',$request->learner_id)
            ->addBodyParam('learner_program_id',$request->learner_program_id ?? null);

        if ($request->hasHeader('src') && $request->header('src') == '3p'){
            $resource = $resource
//                ->addBodyParam('uuid',$request->id)
                ->addBodyParam('src','3p');
        }

        $response = $resource->send('post',$path);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['status' => false,'message' => $response['errors'][0]['source'] ?? '','validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['status' => false,'message' => $response['errors'][0]['title'] ?? '','error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['status' => true,'message' => 'Learner Successfully enrolled and completed program'],200);
    }

    public function submitCourse(Request $request, Sdk $sdk){
        $resource = $sdk->createCourseService();
        $resource = $resource
        ->addBodyParam('title',$request->title)
        ->addBodyParam('course_image',$request->course_image)
        ->addBodyParam('duration',$request->duration)
        ->addBodyParam('course_state',$request->course_state)
        ->addBodyParam('skills_to_be_gained',$request->skills_to_be_gained)
        ->addBodyParam('description',$request->description);

        if ($request->hasHeader('src') && $request->header('src') == '3p'){
            $resource = $resource
                ->addBodyParam('uuid',$request->id)
                ->addBodyParam('full_data',$request->all())
                ->addBodyParam('src','3p');
        }

        $response = $resource->send('post',['create',$request->program]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['status'=>false,'message' => $response['errors'][0]['source'] ?? '','error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['status'=>false,'message' => $response['errors'][0]['title'] ?? '','error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['status' => true,'message' => 'Course Created Successfully!'],200);
    }

    // Assets 
    protected function getAssets(){
        $query = $this->sdk->createAssetService();
        $query = $query->addQueryArgument('limit',100);
        $path = [''];
        return $query->send('get', $path);
    }

    public function uploadAsset(Request $request, Sdk $sdk)
    {
        // dd($request->file);
        $resource = $sdk->createAssetService();
        $file = $request->file('asset');
        $resource = $resource
            ->addMultipartParam('asset_file', file_get_contents($file->getRealPath(), false), 
            $file->getClientOriginalName());
        $path = ['custom', 'upload'];
        $response = $resource->send('post', $path);
        if ($response->isSuccessful()){
            return response([
                'message'       => 'file uploaded successfully!!!',
                'file_url'      =>  $response->getData()['file_url'],
                ]);
        }
        return response(['message'  => 'file not uploaded']);
    }

    public function createAsset()
    {
        return view('modules-lms-learning-base::tenants.resources.asset.create');
    }

    public function submitAsset(Request $request, Sdk $sdk){
        $resource = $sdk->createAssetService();
        $resource = $resource
        ->addBodyParam('asset_name',$request->asset_name)
        ->addBodyParam('asset_type',$request->asset_type)
        ->addBodyParam('asset_url',$request->asset_url);
        $response = $resource->send('post',['']);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['message' => 'Asset Uploaded Successfully!'], 200);
    }

    public function editAsset(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createAssetService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['asset'];
            return view('modules-lms-learning-base::tenants.resources.asset.edit',compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::tenants.resources.asset.edit',compact('data'));
    }

    public function updateAsset(string $id, Request $request, Sdk $sdk): JsonResponse
    {
        $resource = $sdk->createAssetService();
        $resource = $resource
            ->addBodyParam('asset_name',$request->asset_name)
            ->addBodyParam('asset_type',$request->asset_type)
            ->addBodyParam('asset_url',$request->asset_url);
        $response = $resource->send('put',[$id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['message' => 'Updated Successfully'],200);
    }

    public function allAsset()
    {
        if ($this->getAssets()->isSuccessful()){
            $response = $this->getAssets()->getData();
            $data = $response['assets'];
            return view('modules-lms-learning-base::tenants.resources.asset.index', compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::tenants.resources.asset.index', compact('data'));
    }


    //    Quiz
    protected function getQuiz(){
        $query = $this->sdk->createQuizService();
        $query = $query->addQueryArgument('limit',100);
        $path = [''];
        return $query->send('get', $path);
    }

    public function createQuiz()
    {
        $courses = [];
        if ($this->getCourses()->isSuccessful()) {
            $response = $this->getCourses()->getData();
            $courses = $response['courses'];
        }
        return view('modules-lms-learning-base::tenants.resources.quiz.create', compact('courses'));
    }

    public function submitQuiz(Request $request, Sdk $sdk){
        $resource = $sdk->createQuizService();
        $resource = $resource
            ->addBodyParam('title',$request->quiz_title)
            ->addBodyParam('quiz_type',$request->quiz_type)
            ->addBodyParam('pq_course',$request->pq_course)
            ->addBodyParam('total_quiz_mark',$request->total_quiz_mark)
            ->addBodyParam('pass_mark',$request->pass_mark)
            ->addBodyParam('timing_mode',$request->timing_mode)
            ->addBodyParam('time_per_question',$request->time_per_question === 'yes' ? true : false)
            ->addBodyParam('quiz_timer',$request->quiz_timer)
            ->addBodyParam('randomize_questions',$request->randomize_questions === 'yes' ? true : false)
            ->addBodyParam('randomize_options',$request->randomize_options === 'yes' ? true : false)
            ->addBodyParam('disable_on_submit',$request->disable_on_submit === 'true' ? true : false)
            ->addBodyParam('retake_on_request',$request->retake_on_request === 'true' ? true : false)
            ->addBodyParam('questions', json_decode($request->questions, true));
        $response = $resource->send('post',['']);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            dump($response);
            if ($response['errors'][0]['code'] === '005') return response()->json(['error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['message' => 'Quiz Created Successfully!'], 200);
    }

    public function editQuiz(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createQuizService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['quiz'];
            return view('modules-lms-learning-base::tenants.resources.quiz.edit',compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::tenants.resources.quiz.edit',compact('data'));
    }

    public function updateQuiz(string $id, Request $request, Sdk $sdk): JsonResponse
    {
        $resource = $sdk->createQuizService();
        $resource = $resource
            ->addBodyParam('title',$request->quiz_title)
            ->addBodyParam('quiz_type',$request->quiz_type)
            ->addBodyParam('pq_course',$request->pq_course)
            ->addBodyParam('total_quiz_mark',$request->total_quiz_mark)
            ->addBodyParam('pass_mark',$request->pass_mark)
            ->addBodyParam('timing_mode',$request->timing_mode)
            ->addBodyParam('time_per_question',$request->time_per_question === 'yes' ? true : false)
            ->addBodyParam('quiz_timer',$request->quiz_timer)
            ->addBodyParam('randomize_questions',$request->randomize_questions === 'yes' ? true : false)
            ->addBodyParam('randomize_options',$request->randomize_options === 'yes' ? true : false)
            ->addBodyParam('disable_on_submit',$request->disable_on_submit === 'true' ? true : false)
            ->addBodyParam('retake_on_request',$request->retake_on_request === 'true' ? true : false);
        $response = $resource->send('put',[$id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['message' => 'Updated Successfully'],200);
    }

    public function addQuestions(string $id, Request $request, Sdk $sdk): JsonResponse
    {
        $resource = $sdk->createQuizService();
        $resource = $resource
        ->addBodyParam('question_text',$request->question_text)
        ->addBodyParam('answer',$request->answer)
        ->addBodyParam('question_type',$request->question_type)
        ->addBodyParam('score',$request->score)
        ->addBodyParam('question_number',$request->question_number)
        ->addBodyParam('options',$request->options);
        $response = $resource->send('post',['questions', 'add',$id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['message' => 'Created Successfully'],200);
    }

    public function destroyQuestions(string $id, Request $request, Sdk $sdk): JsonResponse
    {
        $resource = $sdk->createQuizService();
        $response = $resource->send('delete',['questions',$id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['message' => 'Deleted Successfully'],200);
    }

    public function updateQuestions(string $id, Request $request, Sdk $sdk): JsonResponse
    {
        $resource = $sdk->createQuizService();
        $resource = $resource
        ->addBodyParam('question_text',$request->question_text)
        ->addBodyParam('answer',$request->answer)
        ->addBodyParam('question_type',$request->question_type)
        ->addBodyParam('score',$request->score)
        ->addBodyParam('question_number',$request->question_number)
        ->addBodyParam('options',$request->options);
        $response = $resource->send('put',['questions',$request->question_id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        return response()->json(['message' => 'Updated Successfully'],200);
    }

    public function allQuiz()
    {
        if ($this->getQuiz()->isSuccessful()){
            $response = $this->getQuiz()->getData();
            $data = $response['quizzes'];
            return view('modules-lms-learning-base::tenants.resources.quiz.index', compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::tenants.resources.quiz.index', compact('data'));
    }

    public function allGrades(){
        return view('modules-lms-learning-base::tenants.grades.index');
    }

    public function showGrade(){
        return view('modules-lms-learning-base::tenants.grades.show');
    }

    public function allLearnerPrograms($id,Sdk $sdk){
        $query = $this->sdk->createLearnersProgramsService();
        $query = $query
            ->addQueryArgument('limit',100)
            ->addQueryArgument('program',$id);
        $path = [''];
        $response = $query->send('get', $path);

        if ($response->isSuccessful()){
            $response = $response->getData();
            $data = [
                'Message' => 'Learners programs successfully fetched',
                'learnerPrograms' => $response['learners_programs']
            ];
            return response($data, 200);
        }
        $data = ['error' => 'unable to fetch the learners'];
        return response(['Message' => $data, 'learnerPrograms' => null], 404);
    }

    public function LearnerPrograms($id,Sdk $sdk){
        $query = $this->sdk->createLearnersProgramsService();
        $query = $query
            ->addQueryArgument('limit',100)
            ->addQueryArgument('program',$id);
        $path = [''];
        $response = $query->send('get', $path);

        if ($response->isSuccessful()){
            $response = $response->getData();
            $data = [
                'Message' => 'Learners programs successfully fetched',
                'learnerPrograms' => $response['learners_programs']
            ];
            return response($data, 200);
        }
        $data = ['error' => 'unable to fetch the learners'];
        return response(['Message' => $data, 'learnerPrograms' => null], 404);
    }

    public function allLearnerCourses($id,Sdk $sdk){
        $query = $this->sdk->createLearnersCoursesService();
        $query = $query
            ->addQueryArgument('limit',100)
            ->addQueryArgument('course',$id);
        $path = [''];
        $response = $query->send('get', $path);

        if ($response->isSuccessful()){
            $response = $response->getData();
            $data = [
                'Message' => 'Learners courses successfully fetched',
                'learnerCourses' => $response['learners_courses']
            ];
            return response($data, 200);
        }
        $data = ['error' => 'unable to fetch the learners'];
        return response(['Message' => $data, 'learnerCourses' => null], 404);
    }

    private function tenantDetails():array{
        return  [
            'firstname' => auth()->user()->first_name,
            'lastname' => \auth()->user()->last_name,
            'email' => \auth()->user()->email,
            'phone' => \auth()->user()->phone_number,
            'password' => \auth()->user()->email,
            'password_confirmation' => \auth()->user()->email,
            'business_id' => config('scheduler.business_id')
        ];

    }

    public function submitSchedule(Request $request, Sdk $sdk){
        $data = [
            'source' => 'external',
            'action' => 'create_class',
            'name' => $request->name,
            'type' => 0,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'currency' => 'NGN',
            'amount' => $request->price,
            'sitting_capacity' => $request->capacity,
            'is_free' => $request->is_free === 'yes' ? true : false,
            'auto_confirm' => $request->auto_confirm === 'yes' ? true : false,
            'extra_json' => [],
            'schedule_type' => $request->schedule_type,
            'schedule_frequency' => $request->schedule_frequency,
            'schedule_access_type' => $request->schedule_access_type,
            'schedule_seats_per_frequency' => (int)$request->seats_per_frequency,
            'schedule_choose_datetime' => 'none',
            'schedule_datetime' => null,
            'schedule_logo_url' => null
        ];
        $schedulerToken = $this->schedulerService->getSchedulerToken($sdk,$this->tenantDetails());
//        $schedule = $this->schedulerService->createSchedule($data,$schedulerToken);
//        dd($schedule);
        $data['business_id'] = 3;
        return response()->json([
            'message' => 'Schedule item successfully created!',
            'schedule' => $data
//            'schedule' => $schedule
        ], 200);
    }
}
