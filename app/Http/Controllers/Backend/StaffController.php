<?php

namespace App\Http\Controllers\Backend;

use App\Model\BillFood;
use App\Repositories\BillFoodRepository;
use App\Repositories\FoodRepository;
use App\Services\BillService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    protected $billFoodRepository;
    protected $foodRepository;
    protected $billService;
    public function __construct(
        BillFoodRepository $billFoodRepository,
        FoodRepository $foodRepository,
        BillService $billService
    )
    {
        $this->billFoodRepository = $billFoodRepository;
        $this->foodRepository = $foodRepository;
        $this->billService = $billService;
    }

    public function getWaitingFood(){
        $data = $this->billFoodRepository->getByStatus(BillFood::WAITING_STATUS);
//        return $data;
        return view('backend.home.food-list',compact('data'));
    }
    public function updateStatus(Request $request){
        $id = $request->get('id');
        $info = $this->billFoodRepository->find($id);
        $info->status = BillFood::DONE_STATUS;
       if ($info->save()){
           // kiểm tra nếu không con món ăn nào của bill đang ở trạng thái chờ làm => đổi trạng thái đơn:hoàn thành, chờ thanh toán
           $this->billService->updateBillStatusByFood($id);
           $food = $this->foodRepository->find($info->food_id);
           return $food;
       }else{
           return 'false';
       }
    }
}
