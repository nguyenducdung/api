<?php

namespace App\Http\Controllers\Api;

use App\Services\ApiService;
use App\Services\TypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    protected $apiService;
    protected $typeService;
    public function __construct(
        ApiService $apiService,
        TypeService $typeService
    )
    {
        $this->typeService = $typeService;
        $this->apiService = $apiService;

    }

    public function getAll(Request $request){
        $data = $this->typeService->getAll();
        if (!$data){
            return $this->apiService->jsonResponse(400,'error','Type not found',400);
        }
        return $this->apiService->jsonResponse(200,'type',$data,200);
    }
}
