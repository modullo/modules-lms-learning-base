<?php

namespace Modullo\ModulesLmsLearningBase\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Hostville\Modullo\Sdk;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modullo\ModulesLmsApiMapper\Http\Requests\StoreModulesLmsApiMapperRequest;
use Modullo\ModulesLmsApiMapper\Http\Requests\UpdateModulesLmsApiMapperRequest;
use Modullo\ModulesLmsApiMapper\Services\ModulesLmsApiMapperService;
use Modullo\ModulesLmsBaseAccounts\Services\ModulesLmsBaseAccountsTenantService;

class SettingsController extends Controller
{
    protected Sdk $sdk;
    protected $accountService;
    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
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
}
