<?php

namespace App\Http\Controllers\Backend;

use App\Model\Bill;
use App\Model\BillFood;
use App\Model\Voucher;
use App\Repositories\BillFoodRepository;
use App\Repositories\BillRepository;
use App\Repositories\VoucherRepository;
use App\Services\BillService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    protected $billService;
    protected $billRepository;
    protected $billFoodRepository;
    protected $voucherRepository;
    public function __construct(
        BillRepository $billRepository,
        BillFoodRepository $billFoodRepository,
        BillService $billService,
        VoucherRepository $voucherRepository
    )
    {
        $this->billService = $billService;
        $this->billRepository = $billRepository;
        $this->billFoodRepository = $billFoodRepository;
        $this->voucherRepository = $voucherRepository;
    }
    public function index(){
        $status = request('status');
        if ($status == null){
            $data = $this->billRepository->getAll();
        }else{
            $data = $this->billRepository->getByStatus($status);
        }
        return view('backend.bill.index',compact('data'));
    }
    public function view($id){
        $info = $this->billRepository->findById($id);
        return view('backend.bill.form',compact('info'));
    }
    public function update(Request $request,$id){
        $params = $request->only('status','num_of_food','price_total','price_discount','voucher_id');
        DB::beginTransaction();
        try {
            $this->billRepository->updateById($id,$params);
            DB::commit();
            return redirect()->route('bill.index')->with('success','Sửa hóa đơn thành công.');
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            // something went wrong
        }
    }
    public function delete($id){
        $delete = $this->billService->delete($id);
        if ($delete){
            return redirect()->route('bill.index')->with('success','Xóa hóa đơn thành công.');
        }
        return redirect()->route('bill.index')->with('error','Xóa hóa đơn thất bại.');
    }
    public function paid($id){
        $info = $this->billRepository->findById($id);
        $info->status = Bill::PAID_STATUS;
        if ($info->save()){
            //nếu có voucher => chuyển trạng thái voucher
            if ($info->voucher_id != null){
                $this->voucherRepository->updateById($info->voucher_id, ['status' => Voucher::USED_STATUS]);
            }
            // chuyển trạng thái các món ăn
            $this->billFoodRepository->updateAllFoodOfBill($id,['status' => BillFood::DONE_STATUS]);

            return redirect()->route('bill.index')->with('success','Thanh toán hóa đơn thành công.');
        }
        return redirect()->route('bill.index')->with('error','Thanh toán hóa đơn thất bại.');

    }
}
