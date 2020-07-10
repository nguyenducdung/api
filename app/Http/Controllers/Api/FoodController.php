<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Food\SearchRequest;
use App\Http\Requests\Food\VoteRequest;
use App\Repositories\FoodRepository;
use App\Services\ApiService;
use App\Services\BillService;
use App\Services\FoodService;
use App\Services\TypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    protected $apiService;
    protected $billService;
    protected $foodRepository;
    protected $typeService;
    protected $foodService;

    public function __construct(
        FoodRepository $foodRepository,
        BillService $billService,
        ApiService $apiService,
        TypeService $typeService,
        FoodService $foodService
    )
    {
        $this->billService    = $billService;
        $this->apiService     = $apiService;
        $this->typeService    = $typeService;
        $this->foodService    = $foodService;
        $this->foodRepository = $foodRepository;

    }
    public function getByType($id){
        $type_info = $this->typeService->findById($id);
        if (!$type_info){
            return $this->apiService->jsonResponse(400,'error','Type not found',400);
        }
        $data = $this->foodRepository->findByTypeId($id);
        if (!$data){
            return $this->apiService->jsonResponse(400,'error','Food not found',400);
        }
        return $this->apiService->jsonResponse(200,'food',$data,200);
    }
    public function getInfo($id){
        $info = $this->foodRepository->findById($id);
        if (!$info){
            return $this->apiService->jsonResponse(400,'error','Food not found',400);
        }
        return $this->apiService->jsonResponse(200,'food',$info,200);
    }
    public function search(SearchRequest $request){
        $keyword = $request->get('keyword');
        $type_id = $request->get('type_id');
        $foods = $this->foodService->findByName($keyword,$type_id);
        if (!$foods){
            return $this->apiService->jsonResponse(400,'error','Food not found',400);
        }
        return $this->apiService->jsonResponse(200,'foods',$foods,200);
    }
    public function history(Request $request){
        $user = $request->user;
        $foods = $this->foodService->getFoodHistory($user->id);
        if (!$foods){
            return $this->apiService->jsonResponse(400,'error','Food not found',400);
        }
        return $this->apiService->jsonResponse(200,'foods',$foods,200);
    }
    public function suggestion(Request $request){
        $user = $request->user;
        $foods = $this->foodService->getSuggestFood(false,$user->id);
        if (!$foods){
            return $this->apiService->jsonResponse(400,'error','Food not found',400);
        }
        if ($foods->isEmpty()){
            $foods = $this->foodService->getTopVote();
        }
        return $this->apiService->jsonResponse(200,'foods',$foods,200);
    }
    public function endow(Request $request){
        $user = $request->user;
        $foods = $this->foodService->getEndowFood(false,$user->id);
        if (!$foods){
            return $this->apiService->jsonResponse(400,'error','Food not found',400);
        }
        return $this->apiService->jsonResponse(200,'foods',$foods,200);
    }
    public function vote(VoteRequest $request){
        $user = $request->user;
        $star = $request->get('star');
        $food_id = $request->get('id');
        $vote = $this->foodService->foodVote($food_id,$user->id,$star);
        if (!$vote){
            return $this->apiService->jsonResponse(400,'error','Vote error',400);
        }
        return $this->apiService->jsonResponse(200,'vote',$vote,200);
    }
}
