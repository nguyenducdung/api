<?php

namespace App\Repositories;

use App\Model\Bill;
use App\Model\Food;
use App\Repositories\Base\BaseRepository;

class FoodRepository extends BaseRepository {

    public function __construct(Food $model)
    {
        $this->model = $model;
    }
    public function getAll(){
        return $this->model->orderBy('id','desc')->get();
    }
    public function findByTypeId($typeId){
        return $this->model->where('type_id',$typeId)->orderBy('like_of_level')->get();
    }
    public function findById($foodId){
        return $this->model->find($foodId);
    }
    public function findByName($foodName,$type_id){
        $data = $this->model->orderBy('name');
        if ($foodName != null){
            $data = $data->where('name','like','%'.$foodName.'%');
        }
        if ($type_id != null){
            $data = $data->where('type_id',$type_id);
        }
        $data = $data->get();
        return $data;
    }
    public function getHistory($billIds){
        return $this->model->with('order_history')->whereHas('bill_food',function ($q) use ($billIds){
            $q->whereIn('bill_id',$billIds);
        })->get();
    }
    public function getSuggest($limit,$billIds){
        return $this->model->with('order_history')->whereHas('bill_food',function ($q) use ($billIds){
            $q->whereIn('bill_id',$billIds);
        })->orderByRaw('RAND()')->limit($limit)->get();
    }
    public function getEndow($limit,$billIds){
        return $this->model->with('order_history')->whereHas('bill_food',function ($q) use ($billIds){
            $q->whereIn('bill_id',$billIds);
        })->orderBy('price','asc')->limit($limit)->get();
    }
    public function getByNumOfOrder($limit = false){
        if ($limit == false){
            $limit = 5;
        }
        return $this->model->orderBy('num_of_order','desc')->orderBy('like_of_level','desc')->limit($limit)->get();
    }
    public function getFoodHighRateRandom($rate,$limit){

        return $this->model->where('like_of_level',$rate)->orderByRaw('RAND()')->limit($limit)->get();
    }
}
