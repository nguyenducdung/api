<?php

namespace App\Http\Controllers\Backend;

use App\Services\CustomerService;
use App\Services\VoucherService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    protected $voucherService;
    protected $customerService;

    public function __construct(
        VoucherService $voucherService,
        CustomerService $customerService
    )
    {
        $this->voucherService = $voucherService;
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->voucherService->getAll();
        return  view('backend.voucher.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = $this->customerService->getAllUser();
        return  view('backend.voucher.form',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $params = $request->only('discount_percent','expiration_date','note');
        if ($request->get('note') == null){
            $params['note'] = 'Giảm giá: '.$request->get('discount_percent').' %';
        }
        $customers = $request->get('customers');
        if (empty($customers)){
            $params['code'] = $request->get('code') != null ? $request->get('code') :  md5(Carbon::now()->timestamp);
            $this->voucherService->create($params);
        }
        if ($customers){
            foreach ($customers as  $customer){
                $params['code'] = md5($customer);
                $params['user_id'] = $customers;
                $this->voucherService->create($params);
            }
        }

        return redirect()->route('voucher.index')->with('success','Tạo voucher thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = $this->voucherService->findById($id);
        return view('backend.voucher.form',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $info = $this->voucherService->findById($id);
        $params = $request->only('status','note','expiration_date','discount_percent');
        $update = $this->voucherService->updateVoucher($id,$params);
        if ($update){
            return redirect()->route('voucher.index')->with('success','Sửa voucher thành công.');
        }
        return redirect()->route('voucher.index')->with('error','Sửa voucher thất bại.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info = $this->voucherService->findById($id);
        if ($info->delete()){
            return redirect()->route('voucher.index')->with('success','Xóa voucher thành công.');
        }
        return redirect()->route('voucher.index')->with('error','Xóa voucher thất bại.');
    }
}
