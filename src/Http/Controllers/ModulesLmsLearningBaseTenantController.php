<?php

namespace Modullo\ModulesLmsLearningBase\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Hostville\Modullo\Sdk;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ModulesLmsLearningBaseTenantController extends Controller
{
    protected Sdk $sdk;
    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
    }

    public function index()
    {
        return view('modules-lms-learning-base::tenants.base.dashboard');
    }

    public function settings()
    {
        return view('modules-lms-learning-base::tenants.base.settings');
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
            return view('modules-lms-learning-base::tenants.course.index',compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
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
            ->addBodyParam('program_id',$request->program['id']);
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
            return view('modules-lms-learning-base::tenants.course.show',compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::tenants.course.show',compact('data'));
    }



//    Lessons
    public function createLesson()
    {
        return view('modules-lms-learning-base::tenants.lessons.create');
    }

    public function editLesson()
    {
        return view('modules-lms-learning-base::tenants.lessons.edit');
    }

    public function allLesson()
    {
        return view('modules-lms-learning-base::tenants.lessons.index');
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
        $response = $resource->send('post',['create',$request->course_id]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['message' => 'Module Created Successfully!'],200);
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
            return view('modules-lms-learning-base::tenants.modules.index', compact('data', 'courses'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
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
            ->addBodyParam('title',$request->title)
            ->addBodyParam('description',$request->MajorDescription)
            ->addBodyParam('image',$request->overviewImageUrl)
            ->addBodyParam('visibility_type',$request->visiblityType);
        $response = $resource->send('post',['']);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['message' => 'creation successful blah blah'],200);
    }

    /**
     * @throws GuzzleException
     */
    public function updateProgram(string $id, Request $request, Sdk $sdk): JsonResponse
    {
        $resource = $sdk->createProgramService();
        $resource = $resource
            ->addBodyParam('title',$request->title)
            ->addBodyParam('description',$request->MajorDescription)
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
            return view('modules-lms-learning-base::tenants.programs.index',compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::tenants.programs.index',compact('data'));

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
        $response = $resource->send('post',['create',$request->program]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['message' => 'Course Created Successfully!'],200);
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
        $file = $request->file('file');
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
    public function createQuiz()
    {
        return view('modules-lms-learning-base::tenants.resources.quiz.create');
    }

    public function submitQuiz(Request $request, Sdk $sdk){
        // dd(($request->questions))
        $resource = $sdk->createQuizService();
        $resource = $resource
        ->addBodyParam('title',$request->quiz_title)
        ->addBodyParam('total_quiz_mark',$request->total_quiz_mark)
        ->addBodyParam('quiz_timer',$request->quiz_timer)
        ->addBodyParam('disable_on_submit',$request->disable_on_submit === 'true' ? true : false)
        ->addBodyParam('retake_on_request',$request->retake_on_request === 'true' ? true : false)
        ->addBodyParam('questions', $request->questions);
        $response = $resource->send('post',['']);
        dd($response);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['message' => 'Asset Uploaded Successfully!'], 200);
    }

    public function editQuiz()
    {
        return view('modules-lms-learning-base::tenants.resources.quiz.edit');
    }

    public function allQuiz()
    {
        return view('modules-lms-learning-base::tenants.resources.quiz.index');
    }

    public function allGrades(){
        return view('modules-lms-learning-base::tenants.grades.index');
    }

    public function showGrade(){
        return view('modules-lms-learning-base::tenants.grades.show');
    }
}
