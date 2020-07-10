<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Bill\StoreBillRequest;
use App\Model\Bill;
use App\Services\ApiService;
use App\Services\BillService;
use App\Services\CustomerService;
use App\Services\VoucherService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    protected $apiService;
    protected $billService;
    protected $customerService;
    protected $voucherService;
    public function __construct(
        ApiService $apiService,
        BillService $billService,
        CustomerService $customerService,
        VoucherService $voucherService
    )
    {
        $this->apiService = $apiService;
        $this->billService = $billService;
        $this->voucherService = $voucherService;
        $this->customerService = $customerService;
    }

    public function getByCustomer(Request $request){
        $customer = $request->user;
        $data = $this->billService->getBillByCustomer($customer->id);
        if (!$data){
            return $this->apiService->jsonResponse(400,'error','Bill not found',400);
        }
        return $this->apiService->jsonResponse(200,'bill',$data,200);
    }
    public function getInfo($id){
        $info = $this->billService->findByBillId($id);
        if (!$info){
            return $this->apiService->jsonResponse(400,'error','Bill not found',400);
        }
        return $this->apiService->jsonResponse(200,'bill',$info,200);
    }
    public function store(StoreBillRequest $request){
        $user = $request->user;
        $foods = $request->get('foods');
        $params = $request->only('voucher_id','table_id','num_of_food','price_total','price_discount');
        $params['customer_id'] = $user->id;
        DB::beginTransaction();
        try {
            $inputs = [];
            $bill = $this->billService->create($params);
            if (!empty($foods)){
                foreach ($foods as $key => $food){
                    $food['bill_id'] = $bill->id;
                    $food['status'] = Bill::WAITING_STATUS;
                    $food['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
                    array_push($inputs,$food);
                }
            }
            if (!empty($inputs)){
                $this->billService->createBillFood($inputs);
            }
//            $voucher_used = $this->voucherService->updateVoucher($request->get('voucher_id'),['status' => 0]);

            $info = $this->billService->findByBillId($bill->id);
            DB::commit();
            return $this->apiService->jsonResponse(200,'bill',$info,200);
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return $this->apiService->jsonResponse(400,'error','Bill create fail',400);
            // something went wrong
        }
    }
    public function updateBillFood(Request $request,$id){
        $params = $request->only('num_of_food','price_total','status');
        if (empty($params)){
            return $this->apiService->jsonResponse(400,'error','Nothing to change',400);

        }
        $update = $this->billService->updateBillFood($id,$params);
        if (!$update){
            return $this->apiService->jsonResponse(400,'error','Nothing to change',400);
        }
        return $this->apiService->jsonResponse(200,'foods',$update,200);

    }
}
