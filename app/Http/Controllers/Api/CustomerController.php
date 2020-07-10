<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Services\ApiService;
use App\Services\CustomerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;
    protected $apiService;

    public function __construct(
        CustomerService $customerService,
        ApiService $apiService
    )
    {
        $this->apiService = $apiService;
        $this->customerService = $customerService;

    }

    public function getInfo(Request $request){
        $customer = $request->user;
        $info = $this->customerService->findUserById($customer->id);
        if (!$info){
            return $this->apiService->jsonResponse(400,'error','Customer not found',400);
        }
        return $this->apiService->jsonResponse(200,'customer',$info,200);
    }
    public function update(UpdateCustomerRequest $request){
        $user = $request->user;
        $params = $request->only('name','avatar','birthday','gender','email');
        if (empty($params)){
            return $this->apiService->jsonResponse(400,'error','Nothing to change',400);
        }
        if ($request->file('avatar')){
            $validator = Validator::make($request->all(), [
                'avatar' => 'image|mimes:jpg,jpeg,png'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => '400', 'errors' => 'Avatar must be a file of type: jpg,jpeg,png.'], 400);
            }
        }
        $update = $this->customerService->updateUserInfo($user->id,$params);
        if (!$update){
            return $this->apiService->jsonResponse(400,'error','Update customer false',400);
        }
        return $this->apiService->jsonResponse(200,'customer',$update,200);
    }
}
