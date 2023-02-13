<?php

namespace Modullo\ModulesLmsLearningBase\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use Hostville\Modullo\Sdk;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modullo\ModulesAuth\Http\Controllers\ModulesAuthController;
use Modullo\ModulesLmsApiMapper\Http\Requests\StoreModulesLmsApiMapperRequest;
use Modullo\ModulesLmsApiMapper\Http\Requests\UpdateModulesLmsApiMapperRequest;
use Modullo\ModulesLmsApiMapper\Services\ModulesLmsApiMapperService;
use Modullo\ModulesLmsBaseAccounts\Services\ModulesLmsBaseAccountsTenantService;

class SettingsController extends Controller
{
//    protected Sdk $sdk;
    protected $accountService;
    public function __construct()
    {
//        $this->sdk = $sdk;
        $this->accountService = new ModulesLmsBaseAccountsTenantService();
    }

    public function index(Sdk $sdk)
    {
        $data = \auth()->user();
        return view('modules-lms-learning-base::tenants.base.settings',compact('data'));
    }

    public function update(Request $request, string $id, Sdk $sdk): JsonResponse
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

    public function generateToken(Request $request){
        $user = $request->user();
        $user->tokens()->delete();
        $user->refresh();
        $token = $user->createToken('General Token');
        return response()->json(['token' => $token->plainTextToken],200);
    }

    public function generateUserToken(Request $request, Sdk $sdk){
//        $auth = app(ModulesAuthController::class)->
        $user = User::where('email',$request->email)->first();
        if (is_null($user)){
            $learner = $this->accountService->getSingleLearnerByEmail($request->email,$sdk);
            $user = User::updateOrCreate(['email' => $request->email],
                [
                    'uuid' => $learner['id'],
                    'email' => $request->email,
                    'first_name' => $learner['first_name'],
                    'last_name' => $learner['last_name'],
                    'password' => $learner['password'] ?? 'password',
                    'phone_number' => $learner['phone_number'],
                    'learner_details' => $learner,
                ]);

        }
        if(is_null($user)){
            return response()->json(['error' => 'User not found'],404);
        }
        $tempPassword = encrypt(str_random(8));
        $user->update([
            'temp_password' => $tempPassword
        ]);
        $user->tokens()->delete();
        $user->refresh();
        $token = $user->createToken('General Token');
        $sso = $this->generateSsoLink($user);
        return response()->json([
            'email' => $request->email,
            'token' => $token->plainTextToken,
            'sso_link' => $sso,
            'possible_routes' => [
                'programs' => 'learner-programs',
                'allPrograms' => 'all-programs',
                'courses' => 'learner-courses',
                'allCourses' => 'learner-courses.all',
            ]
        ],200);
    }

    private function generateSsoLink($user){
        $email = $user->email;
        $pass = decrypt($user->temp_password);
        $data = $email.'**'.$pass;
        $signature = encrypt($data);
        return route('loginSSO',urlencode($signature));
//        $signature = openssl_encrypt($data,'AES-256-CBC','dor2023',0,);
    }
}
