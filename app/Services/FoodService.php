<?php

namespace App\Services;


use App\Repositories\BillFoodRepository;
use App\Repositories\BillRepository;
use App\Repositories\FoodRepository;
use App\Repositories\FoodVoteRepository;

class FoodService {


    protected $foodRepository;
    protected $billRepository;
    protected $billFoodRepository;
    protected $foodVoteRepository;
    public function __construct(
        FoodRepository $foodRepository,
        BillRepository $billRepository,
        BillFoodRepository $billFoodRepository,
        FoodVoteRepository $foodVoteRepository
    )
    {
        $this->foodRepository = $foodRepository;
        $this->billRepository = $billRepository;
        $this->billFoodRepository = $billFoodRepository;
        $this->foodVoteRepository = $foodVoteRepository;
    }

    public function getAllFood(){
        return $this->foodRepository->getAll();
    }
    public function getByTypeId($typeId){
        return $this->foodRepository->findByTypeId($typeId);
    }
    public function findById($id){
        return $this->foodRepository->findById($id);
    }
    public function findByName($name,$type_id){
        return $this->foodRepository->findByName($name,$type_id);
    }
    public function getFoodHistory($userId){
        $bill_ids = $this->getBillIdsByCustomer($userId);
        $data = $this->foodRepository->getHistory($bill_ids);
        return $data;
    }
    public function getSuggestFood($limit,$userId){
        if ($limit === false){
            $limit = 5;
        }
        $bill_ids = $this->getBillIdsByCustomer($userId);
        return $this->foodRepository->getSuggest($limit,$bill_ids);
    }
    public function getEndowFood($limit,$userId){
        if ($limit === false){
            $limit = 5;
        }
        $bill_ids = $this->getBillIdsByCustomer($userId);
        $foods = $this->foodRepository->getEndow($limit,$bill_ids);
        if ($foods->isEmpty()){
            $foods = $this->foodRepository->getFoodHighRateRandom(5,$limit);
        }
        return $foods;
    }
    public function getBillIdsByCustomer($userId){
        $bill_ids = [];
        $bills = $this->billRepository->getByCustomerId($userId);
        if (count($bills) > 0){
            foreach ($bills as $bill){
                $bill_ids[] = $bill->id;
            }
        }
        return $bill_ids;
    }
    public function delete($id){
        return $this->foodRepository->delete($id);
    }
    public function create($params){
        return $this->foodRepository->create($params);
    }
    public function getNumOfOrderAllFood(){
        return $this->billFoodRepository->getNumOfOrderAllFood();
    }
    public function getLikeOfFood($foodId){
        return $this->foodVoteRepository->getLikeOfFoodById($foodId);
    }
    public function update($id,$params){
        return $this->foodRepository->updateById($id,$params);
    }
    public function foodVote($foodId,$customerId,$star){
        return $this->foodVoteRepository->updateOrCreate($foodId,$customerId,$star);
    }
    public function getTopVote(){
        return $this->foodRepository->getByNumOfOrder();
    }
}
