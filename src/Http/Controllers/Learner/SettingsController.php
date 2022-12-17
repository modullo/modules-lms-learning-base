<?php

namespace Modullo\ModulesLmsLearningBase\Http\Controllers\Learner;

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
        $data = auth()->user()->learner_details;
        $data['uuid'] = auth()->user()->uuid;
        return view('modules-lms-learning-base::learners.base.settings',compact('data'));
    }

    public function update(Request $request, string $id, Sdk $sdk): JsonResponse
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
}
