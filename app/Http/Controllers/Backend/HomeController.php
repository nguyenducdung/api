<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\BillFoodRepository;
use App\Repositories\FoodRepository;
use App\Services\BillService;
use App\Http\Controllers\Controller;
use App\Model\BillFood;

class HomeController extends Controller
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
   public function index(){
       $data = $this->billFoodRepository->getByStatus(BillFood::WAITING_STATUS);
       return view('backend.home.index',compact('data'));
   }
}
