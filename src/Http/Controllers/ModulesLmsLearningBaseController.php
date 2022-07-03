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
        $response = $query->send('get', $path);
        return $response;
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

    public function startCourse(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createLearnerCourseService();
        $path = [$id.'/start'];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['course'];
            $data['started'] = true;
            return view('modules-lms-learning-base::learners.courses.single', compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::learners.courses.single', compact('data'));
    }

    //Learners courses
    protected function getLearnersCourses($id=null){
        $query = $this->sdk->createLearnersCoursesService();
        $query = $query->addQueryArgument('limit',100);
        if(!is_null($id)){
            $query = $query->addQueryArgument('course',$id);
        }
        $path = [''];
        return $query->send('get', $path);
    }

    public function allLearnerCourses($id,Sdk $sdk){
        $response = $this->getLearnersCourses($id);

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

            $learnersPrograms = [];
            $glp = $this->getLearnersPrograms();
            if ($glp->isSuccessful()){
                $response = $glp->getData();
                $learnersPrograms = $response['learners_programs'];
            }

            return response(['Message' => 'Programs Successfully fetched', 'programs' => $data, 'learnersPrograms' => $learnersPrograms], 200);
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return response(['Message' => $data, 'programs' => null, 'learnerPrograms' => null], 404);
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

            $learnersCourses = [];
            $glp = $this->getLearnersCourses();
            if ($glp->isSuccessful()){
                $response = $glp->getData();
                $learnersCourses = $response['learners_courses'];
            }

            return response(['Message' => 'Courses Successfully fetched', 'courses' => $data,'learnersCourses'=>$learnersCourses], 200);
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return response(['Message' => $data, 'courses' => null,'learnersCourses'=>null], 404);
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

    public function enrollToProgram(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createLearnerProgramService();
        $path = [$id.'/enroll'];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['program'];
            $data['enrolled'] = true;
            return view('modules-lms-learning-base::learners.programs.show', compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::learners.programs.show', compact('data'));
    }

    //Programs courses
    protected function getLearnersPrograms($id=null){
        $query = $this->sdk->createLearnersProgramsService();
        $query = $query->addQueryArgument('limit',100);
        if(!is_null($id)){
            $query = $query->addQueryArgument('program',$id);
        }
        $path = [''];
        return $query->send('get', $path);
    }

    public function allLearnerPrograms($id,Sdk $sdk){
        $response = $this->getLearnersPrograms($id);

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

    // Lessons

    public function showLesson(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createCourseService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['course'];
            return view('modules-lms-learning-base::learners.courses.single', compact('data'));
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return view('modules-lms-learning-base::learners.courses.single', compact('data'));
    }

    public function completeLesson(string $id, Sdk $sdk, Request $request) 
    {
        $sdkObject = $sdk->createLearnerLessonService();
        $path = ['complete', $id];
        $response = $sdkObject->send('post', $path);
        if ($response->isSuccessful()){
            $sdkObject = $sdk->createCourseService();
            $path = [$request->course_id];
            $courseResponse = $sdkObject->send('get', $path);
            $courseData = $courseResponse->data['course'];
            // dd($request->course_id);
            $lessonData = $response->data['lesson'];
            return response([
                'Message' => 'Lesson Completed', 
                'course' => $courseData, 
                'lesson' => $lessonData
            ], 200);
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return response(['Message' => $data, 'courses' => null], 404);
    }

    public function submitQuiz(string $quiz_id, string $lesson_id, Sdk $sdk, Request $request) 
    {
        $resource = $sdk->createLearnerLessonService();
        $resource = $resource
        ->addBodyParam('score', 40)
        ->addBodyParam('submission',$request->all());
        $path = ['quiz', 'submit', $quiz_id, $lesson_id];
        $response = $resource->send('post', $path);
        if ($response->isSuccessful()){
            $quizReport = $response->data['quiz-report'];
            // Complete the lesson
            $sdkObject = $sdk->createLearnerLessonService();
            $path = ['complete', $lesson_id];
            $lessonResponse = $sdkObject->send('post', $path);
            $lessonData = $lessonResponse->data['lesson'];
            
            // Fetch updated Course
            $sdkObject = $sdk->createCourseService();
            $path = [$request->course_id];
            $courseResponse = $sdkObject->send('get', $path);
            $courseData = $courseResponse->data['course'];

            return response([
                'Message' => 'Lesson Completed', 
                'quizReport' => $quizReport, 
                'course' => $courseData,
                'lesson' => $lessonData
            ], 200);
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return response(['Message' => $data, 'lesson' => null], 404);
    }

    public function fetchLessonQuiz(string $id, Sdk $sdk)
    {
        $sdkObject = $sdk->createQuizService();
        $path = [$id];
        $response = $sdkObject->send('get', $path);
        if ($response->isSuccessful()){
            $data = $response->data['quiz'];
            return response([
                'Message' => 'Lesson Completed', 
                'quiz' => $data, 
            ], 200);
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return response(['Message' => $data, 'quiz' => null], 404);
    }
}
