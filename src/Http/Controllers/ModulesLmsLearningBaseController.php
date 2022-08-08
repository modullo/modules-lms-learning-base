<?php

namespace Modullo\ModulesLmsLearningBase\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Hostville\Modullo\Sdk;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Modullo\ModulesLmsLearningBase\Services\SchedulerService;

class ModulesLmsLearningBaseController extends Controller
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
        return view('modules-lms-learning-base::learners.base.dashboard');
    }

    public function settings(Sdk $sdk)
    {
        $data = auth()->user()->learner_details;
        $data['uuid'] = auth()->user()->uuid;
        return view('modules-lms-learning-base::learners.base.settings',compact('data'));
    }

    public function updateSettings(Request $request, string $id, Sdk $sdk): JsonResponse
    {
        $user = \auth()->user();
        $resource = $sdk->createLearnersService();
        $resource = $resource
            ->addBodyParam('first_name',$request->first_name)
            ->addBodyParam('last_name',$request->last_name)
            ->addBodyParam('phone_number',$request->phone_number)
            ->addBodyParam('gender',$request->gender)
            ->addBodyParam('location',$request->location)
            ->addBodyParam('image',$request->image);
        $response = $resource->send('put',[$user->learner_details['id']]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['validation_error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }
        $data = $response->getData();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'learner_details' => $data['learner'],
        ]);
        return response()->json(['message' => 'Updated Successfully'],200);
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

        $resource = $sdk->createLearnerLessonService();
        if($request->filled('scheduler')){
            $schedulerToken = $this->getSchedulerToken($sdk);
            $schedules = json_encode($this->schedulerSchedules($schedulerToken));
            $resource = $resource
                ->addBodyParam('schedule', $schedules);
        }
        $path = ['complete', $id];
        $response = $resource->send('post', $path);
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

    public function launchScheduler(string $id,string $lessonId,Sdk $sdk){
        $schedulerToken = $this->schedulerService->getSchedulerToken($sdk);

//        $schedulerUserDetails = $this->schedulerUser($schedulerToken);
        $schedules = $this->schedulerService->schedulerSchedules($schedulerToken);
        return response([
            'Message' => 'Schedule record fetched',
//            'user' => $schedulerUserDetails,
            'schedules' => $schedules,
            'url' => config('scheduler.domain').'/schedules/'.$schedules[0]['slug'].'/?member_token='.$schedulerToken
        ], 200);

    }

    public function getSchedulerToken($sdk){
        $schedulerToken = auth()->user()->scheduler_token;
        if(empty($schedulerToken)){
            $sdkObject = $sdk->createProfileService();
            $path = [];
            $response = $sdkObject->send('get', $path);
            if (!$response->isSuccessful()){
                return response(['Message' => 'Unable to get user profile. Please try again.'], 404);
//            return response(['Message' => 'Unable to get user profile. Please try again.', 'courses' => $data,'learnersCourses'=>$learnersCourses], 200);
            }

            $details = $response->data['user'];
            $data = [
                'firstname' => $details['learner']['first_name'],
                'lastname' => $details['learner']['last_name'],
                'email' => $details['email'],
                'phone' => $details['learner']['phone_number'],
                'password' => $details['email'],
                'password_confirmation' => $details['email'],
                'business_id' => config('scheduler.business_id')
            ];
            /*            $data = [
                            'firstname' => 'test-fname15',
                            'lastname' => 'test-lname15',
                            'email' => 'test15@email.com',
                            'phone' => '08111111115',
                            'password' => 'test15@email.com',
                            'password_confirmation' => 'test15@email.com',
                            'business_id' => config('scheduler.business_id')
                        ];*/

            $url = config('scheduler.domain').'/api/auth/register';
            $response = Http::post($url,$data);
            if(!$response->successful()){
                $response = $response->collect()->toArray();
                $error = $response['errors'][0]['title'];
                return response(['Message' => $error], 400);
//            return response(['Message' => 'Error establishing connection with scheduler. Please try again.'], 400);
            }
            $response = $response->object();
            $schedulerUser = $response->user;
            $schedulerToken = encrypt($response->token);
            auth()->user()->update(['scheduler_token'=>$schedulerToken]);
        }

        return decrypt($schedulerToken);
    }

    public function schedulerUser($token = null){
        if(is_null($token)){
            $token = decrypt(auth()->user()->scheduler_token);
        }

        $url = config('scheduler.domain').'/api/auth/me';
        $response = Http::withToken($token)->get($url);
        if(!$response->successful()){
            $response = $response->collect()->toArray();
            $error = $response['errors'][0]['title'];
            return response(['Message' => $error], 400);
        }
        $response = $response->collect();
        return $response['user'];
    }

    public function schedulerSchedules($token = null){
        if(is_null($token)){
            $token = decrypt(auth()->user()->scheduler_token);
        }

        $url = config('scheduler.domain').'/api/auth/schedules';
        $response = Http::withToken($token)->get($url);
        if(!$response->successful()){
            $response = $response->collect()->toArray();
            $error = $response['errors'][0]['title'];
            return response(['Message' => $error], 400);
        }
        $response = $response->collect();
        return $response['schedules'];

    }

    public function schedulerUI($slug,$token = null){
        if(is_null($token)){
            $token = decrypt(auth()->user()->scheduler_token);
        }

        $url = config('scheduler.domain').'/schedules/'.$slug.'/?member_token='.urlencode($token);
        $response = Http::get($url);
        if(!$response->successful()){
            $response = $response->collect()->toArray();
            $error = $response['errors'][0]['title'];
            return response(['Message' => $error], 400);
        }
        $response = $response->body();
        dd($response);
        return $response['schedules'];

    }

    public function updateSchedule(string $id, Sdk $sdk, Request $request)
    {
        $schedulerToken = $this->getSchedulerToken($sdk);
        $schedules = json_encode($this->schedulerSchedules($schedulerToken));

        $resource = $sdk->createLearnerLessonService();
        $resource = $resource
        ->addBodyParam('schedule', $schedules);
        $path = ['complete', $id];
        $response = $resource->send('post', $path);
        if ($response->isSuccessful()){
            return response([
                'Message' => 'Lesson Completed',
                'course' => $courseData,
                'lesson' => $lessonData
            ], 200);
        }
        $data = ['error' => 'unable to fetch the requested resource'];
        return response(['Message' => $data, 'courses' => null], 404);
    }

}
