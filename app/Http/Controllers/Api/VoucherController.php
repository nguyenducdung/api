<?php

namespace App\Http\Controllers\Api;

use App\Services\ApiService;
use App\Services\VoucherService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    protected $apiService;

    protected $voucherService;
    public function __construct(
        VoucherService $voucherService,
        ApiService $apiService
    )
    {
        $this->apiService     = $apiService;
        $this->voucherService = $voucherService;
    }

    public function getByCustomer(Request $request){
        $user = $request->user;
        $vouchers = $this->voucherService->getByCustomer($user->id);

        if (!$vouchers){
            return $this->apiService->jsonResponse(400,'error','Vouchers not found',400);
        }
        return $this->apiService->jsonResponse(200,'vouchers',$vouchers,200);
    }
    public function getInfo($id){
        $info = $this->voucherService->findById($id);
        if (!$info){
            return $this->apiService->jsonResponse(400,'error','Voucher not found',400);
        }
        return $this->apiService->jsonResponse(200,'voucher',$info,200);
    }
}
