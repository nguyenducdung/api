<?php

namespace App\Http\Controllers\Backend;

use App\Model\BillFood;
use App\Services\BillService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    protected $billService;
    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    public function index(){
        $from = request('from') != null ? request('from') : Carbon::now()->subMonth()->format('Y-m-d');
        $to = request('to') != null ? request('to') : Carbon::now()->format('Y-m-d');

        if ($from > $to){
            return back()->with('error','Ngày bắt đầu phải nhỏ hơn ngày kết thúc');
        }

        $params = [
            'dates'=>[$from,$to]
        ];

        $foods = $this->getFoodBill($params);

        $bill_date = $this->billService->getByDate($params);
        $arrBill = $this->getBillChart($bill_date);
        $arrClass  = [
          'labels'  => array_keys($foods),
            'data'  => array_values($foods),
        ];
        $arrStatus = $this->billService->groupByStatus($params);
//        dd($arrStatus);
        return view('backend.report.index',compact('arrClass','bill_date','from','to','arrBill','arrStatus'));
    }

    public function getFoodBill($params){

        $data = [];
        $foods = BillFood::with(['food']);

        if (isset($params['dates'])){
            $foods = $foods->whereBetween('created_at',$params['dates']);
        }
        if (isset($params['status'])){
            $foods = $foods->where('status',$params['status']);
        }
        $foods = $foods->groupBy('food_id')
            ->select('food_id',DB::raw('Count(food_id) as total'))
            ->get();
        if (count($foods) <= 0){
            return $data;
        }
        foreach ($foods as $item){
           if (isset($item->food)){
               $food = $item->food;
               $data[$food->name] = $item->total;
           }
        }
      return $data;
    }
    function getBillChart($data){
        $labels = [];
        $bill = [];
        $money = [];
        if (count($data) > 0){
            foreach ($data as $key => $item){
                $labels[$key] = $item->date;
                $bill[$key] = $item->count_bill;
                $money[$key] = $item->sum_bill;
            }
        }
        return [
          'labels'  => $labels,
            'bill'  => $bill,
            'money' => $money
        ];
    }

}
