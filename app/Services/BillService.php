<?php

namespace App\Services;

use App\Model\Bill;
use App\Repositories\BillFoodRepository;
use App\Repositories\BillRepository;

class BillService {


    protected $billRepository;
    protected $billFoodRepository;
    public function __construct(
        BillRepository $billRepository,
        BillFoodRepository $billFoodRepository
    )
    {
        $this->billRepository = $billRepository;
        $this->billFoodRepository = $billFoodRepository;
    }

    public function getAllBill(){
        return $this->billRepository->getAll();
    }

    public function getBillByCustomer($customerId){
        return $this->billRepository->getByCustomerId($customerId);
    }
    public function findByBillId($billId){
        $info = $this->billRepository->findById($billId);
        $foods = $this->billFoodRepository->getFoodByBill($billId);
        $info->foods = $foods;
        return $info;
    }
    public function create($params){
        return $this->billRepository->create($params);
    }
    public function createBillFood($params){
        return $this->billFoodRepository->createMany($params);
    }
    public function updateBillFood($foodId,$params){
         $this->billFoodRepository->updateById($foodId,$params);
         return $this->billFoodRepository->find($foodId);
    }
    public function delete($id){
        $this->billRepository->delete($id);
        $this->billFoodRepository->where('bill_id',$id)->delete();
        return true;
    }
    public function getByDate($params){

        $data = $this->billRepository->getByDate($params);
        if (count($data) > 0) {
            foreach ($data as $item){

            }
        }
        return $data;
    }
    public function updateBillStatusByFood($billFoodId){
        $billFoodInfo = $this->billFoodRepository->find($billFoodId);
        $billId = $billFoodInfo->bill_id;
        $waitingFoodList = $this->billFoodRepository->getWaitingFoodOfBill($billId);
        if (count($waitingFoodList) <= 0){
            $this->billRepository->updateById($billId,['status' => Bill::DONE_STATUS]);
        }
        return true;
    }
    public function groupByStatus($params){
        $data =  $this->billRepository->groupByStatus($params);
        $result = [];
        if (count($data) > 0){
            foreach ($data as $key => $item){
                $result['total'][$item->status] = $item->count_bill;
                $result['price'][$item->status] = $item->sum_bill;
            }
        }
        return $result;
    }
}
