<?php
namespace Modullo\ModulesLmsLearningBase\Services;

use Carbon\Carbon;
use Hostville\Modullo\Sdk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SchedulerService
{

    public function getSchedulerToken($sdk,$data = null){
        $schedulerToken = auth()->user()->scheduler_token;
        if(empty($schedulerToken)){
            if(is_null($data)){
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
                
            }
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

    public function createSchedule($data,$token = null){
        if(is_null($token)){
            $token = decrypt(auth()->user()->scheduler_token);
        }

        $url = config('scheduler.domain').'/api/auth/schedules';
        $response = Http::withToken($token)->post($url,$data);
        if(!$response->successful()){
            $response = $response->collect()->toArray();
            $error = $response['errors'][0]['title'];
            return response(['Message' => $error], 400);
        }
        $response = $response->collect();
        dd($response);
        return $response['schedules'];

    }

    public function schedulerSchedules($token = null){
        if(is_null($token)){
            $token = decrypt(auth()->user()->scheduler_token);
        }

        $url = config('scheduler.domain').'/api/auth/schedules';
        try {
            $response = Http::withToken($token)->withHeaders(['accept'=>'application/json'])->get($url);
            if(!$response->successful()){
                $response = $response->collect()->toArray();
                $error = $response['errors'][0]['title'];
                return response(['Message' => $error], 400);
            }
            $response = $response->collect();
            return $response['schedules'];
        }catch (\Throwable $e){
            Log::error($e->getMessage());
        }
        return [];

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
