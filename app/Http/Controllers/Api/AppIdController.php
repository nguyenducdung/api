<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Customer\SaveTokenRequest;
use App\Repositories\AppIdRepository;
use App\Services\ApiService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppIdController extends Controller
{
    protected $apiService;
    protected $appIdRepository;
    public function __construct( ApiService $apiService,AppIdRepository $appIdRepository)
    {
        $this->apiService = $apiService;
        $this->appIdRepository = $appIdRepository;
    }

    public function saveToken(SaveTokenRequest $request){
        $user = $request->user;
        $token = $request->get('token');
        $token_info = $this->appIdRepository->findByToken($token);
        if (!$token_info){
            $input = [
                'token'   => $token,
                'user_id' => $user->id
            ];
          $token_info = $this->appIdRepository->create($input);
        }
        return $this->apiService->jsonResponse(200,'token',$token_info,200);
    }
    public function getAll(){
        $tokens = $this->appIdRepository->getAll();
        if (!$tokens){
            return $this->apiService->jsonResponse(400,'error','Token not found',400);
        }
        return $this->apiService->jsonResponse(200,'token',$tokens,200);
    }
}
