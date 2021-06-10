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


    public function allCourses(){
        return view('modules-lms-learning-base::tenants.course.index');
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

    public function edit()
    {
        return view('modules-lms-learning-base::tenants.course.edit');
    }

    public function show()
    {
        return view('modules-lms-learning-base::tenants.course.show');
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
    public function createModules()
    {
        return view('modules-lms-learning-base::tenants.modules.create');
    }

    public function editModules()
    {
        return view('modules-lms-learning-base::tenants.modules.edit');
    }

    public function allModules()
    {
        return view('modules-lms-learning-base::tenants.modules.index');
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
            ->addBodyParam('image',$request->image ?? 'https://aws-demo.com')
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
            ->addBodyParam('image',$request->image ?? 'https://aws-demo.com')
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
        ->addBodyParam('course_image',$request->image ?? 'https://aws-demo.com')
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


    //    Asset
    public function createAsset()
    {
        return view('modules-lms-learning-base::tenants.resources.asset.create');
    }

    public function editAsset()
    {
        return view('modules-lms-learning-base::tenants.resources.asset.edit');
    }

    public function allAsset()
    {
        return view('modules-lms-learning-base::tenants.resources.asset.index');
    }


    //    Quiz
    public function createQuiz()
    {
        return view('modules-lms-learning-base::tenants.resources.quiz.create');
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
