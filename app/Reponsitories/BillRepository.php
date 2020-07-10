<?php

namespace App\Repositories;

use App\Model\Bill;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\DB;

class BillRepository extends BaseRepository {

    public function __construct(Bill $model)
    {
        $this->model = $model;
    }
    public function getByStatus($status){
        return $this->model->orderBy('id','desc')->with(['customer','table','voucher'])->where('status',$status)->get();
    }
    public function getAll(){
        return $this->model->orderBy('id','desc')->with(['customer','table','voucher'])->get();
    }
    public function getByCustomerId($customerId){
        return $this->model->with(['customer','table','voucher'])->where('customer_id',$customerId)->get();
    }
    public function findById($id){
        return $this->model->with(['customer','table','voucher'])->where('id',$id)->first();
    }
    public function getByDate($params){
        $data = $this->model->whereBetween('created_at',$params['dates'])
            ->select(
                DB::raw('Count(id) as count_bill'),
                DB::raw('Sum(price_total) as sum_bill'),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date")
            )
            ->groupBy('date')
            ->get();
        return $data;
    }
    public function groupByStatus($params){
        $data = $this->model->whereBetween('created_at',$params['dates'])
            ->select(
                DB::raw('Count(id) as count_bill'),
                DB::raw('Sum(price_total) as sum_bill'),
                'status'
            )->groupBy('status')
            ->get();
        return $data;
    }
}
