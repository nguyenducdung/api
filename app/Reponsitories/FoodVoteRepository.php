<?php

namespace App\Repositories;

use App\Model\Bill;
use App\Model\BillFood;
use App\Model\FoodVote;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\DB;

class FoodVoteRepository extends BaseRepository {

    public function __construct(FoodVote $model)
    {
        $this->model = $model;
    }
    public function getLikeOfFoodById($foodId){
        return $this->model->where('food_id',$foodId)->count();
    }
    public function getById($id){
        return $this->model->with(['customer','food'])->where('id',$id)->first();
    }
    public function updateOrCreate($foodId,$customerId,$star){
        $info = $this->model->where('food_id',$foodId)->where('customer_id',$customerId)->first();
        if ($info){
            $info->vote = $star;
            $info->save();
        }else{
            $info = $this->model->create([
                'food_id'     => $foodId,
                'customer_id' => $customerId,
                'vote'        => $star
            ]);
        }
        return $this->getById($info->id);
    }
}
