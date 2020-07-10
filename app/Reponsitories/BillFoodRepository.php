<?php

namespace App\Repositories;

use App\Model\Bill;
use App\Model\BillFood;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\DB;

class BillFoodRepository extends BaseRepository {

    public function __construct(BillFood $model)
    {
        $this->model = $model;
    }
    public function createMany($params){
        return $this->model->insert($params);
    }
    public function getFoodByBill($billId){
        return $this->model->with('food')->where('bill_id',$billId)->get();
    }
    public function getNumOfOrderAllFood(){
        return  $this->model->select('food_id',
            DB::raw('Count(food_id) as total_order')
            )->groupBy('food_id')->get();
    }
    public function getByStatus($status){
        return $this->model->with(['food','bill.table'])->where('status',$status)->get();
    }
    public function getWaitingFoodOfBill($billId){
        return $this->model->with('food')->where('bill_id',$billId)->where('status',BillFood::WAITING_STATUS)->get();

    }
    public function updateAllFoodOfBill($billId,$params){
        return $this->model->with('food')->where('bill_id',$billId)->update($params);

    }
}
