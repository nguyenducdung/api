<?php

namespace App\Http\Middleware;

use App\Services\BillService;
use App\Services\FoodService;
use Closure;

class UpdateNumOfOrderFood
{
    protected $foodService;
    protected $billService;

    public function __construct(
        FoodService $foodService,
        BillService $billService
    )
    {
        $this->foodService = $foodService;
        $this->billService = $billService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data = $this->foodService->getNumOfOrderAllFood();
        if (count($data) > 0){
            foreach ($data as $item){
                $input = [
                    'num_of_order' => $item->total_order,
                    'like_of_level' => $this->foodService->getLikeOfFood($item->food_id)
                ];
                $this->foodService->update($item->food_id,$input);
            }
        }
        return $next($request);
    }
}
