<?php

namespace App\Repositories;

use App\Model\Bill;
use App\Model\Food;
use App\Model\Type;
use App\Model\Voucher;
use App\Repositories\Base\BaseRepository;

class VoucherRepository extends BaseRepository {

    public function __construct(Voucher $model)
    {
        $this->model = $model;
    }
    public function getAll(){
        return $this->model->orderBy('id','desc')->get();
    }
    public function getByCustomer($customerId){
        return $this->model->where(function ($q) use ($customerId){
            $q->whereNull('user_id')
                ->orWhere('user_id',$customerId);
            })
            ->with('customer_info')
            ->orderBy('expiration_date','desc')
            ->orderBy('status',1)
            ->get();
    }
    public function findById($typeId){
        return $this->model->find($typeId);
    }
}
