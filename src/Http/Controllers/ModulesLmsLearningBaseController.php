<?php

namespace Modullo\ModulesLmsLearningBase\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Hostville\Modullo\Sdk;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ModulesLmsLearningBaseController extends Controller
{
    protected Sdk $sdk;
    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
    }
    
    public function index()
    {
        return view('modules-lms-learning-base::learners.base.dashboard');
    }

    public function settings()
    {
        return view('modules-lms-learning-base::learners.base.settings');
    }

    // Courses
    protected function getCourses(){
        $query = $this->sdk->createLearnerCourseService();
        $query = $query->addQueryArgument('limit',100);
        $path = [''];
        return $query->send('get', $path);
    }

    public function allCourses(Sdk $sdk)
    {
        if ($this->getCourses()->isSuccessful()){
            $response = $this->getCourses()->getData();
            $data = $response['courses'];
            return response(['Message' => 'Courses Successfully fetched', 'courses' => $data, 'user' => auth()->user()], 200);
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return response(['Message' => $data, 'courses' => null], 404);
    }

    public function courses()
    {
        return view('modules-lms-learning-base::learners.courses.index');
    }

    public function showCourse(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createCourseService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['course'];
            return view('modules-lms-learning-base::learners.courses.show',compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::learners.courses.show',compact('data'));
    }

    // Programs
    protected function getPrograms(){
        $query = $this->sdk->createLearnerProgramService();
        $query = $query->addQueryArgument('limit',100);
        $path = [''];
        return $query->send('get', $path);
    }

    public function allPrograms(Sdk $sdk)
    {
        if ($this->getPrograms()->isSuccessful()){
            $response = $this->getPrograms()->getData();
            $data = $response['programs'];
            return response(['Message' => 'Programs Successfully fetched', 'programs' => $data], 200);
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return response(['Message' => $data, 'programs' => null], 404);
    }

    public function programs()
    {
        return view('modules-lms-learning-base::learners.programs.index');
    }

    public function allProgramCourses(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createLearnerCourseService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['courses'];
            return response(['Message' => 'Courses Successfully fetched', 'courses' => $data], 200);
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return response(['Message' => $data, 'courses' => null], 404);
    }

    public function showProgram(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createProgramService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['program'];
            return view('modules-lms-learning-base::learners.programs.show', compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::learners.programs.show', compact('data'));
    }
}
