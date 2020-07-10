<?php

namespace App\Http\Controllers\Backend;

use App\Services\ApiService;
use App\Services\BillService;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    protected $customerService;
    protected $billService;
    public function __construct(
        CustomerService $customerService,
        BillService $billService
    )
    {
        $this->billService = $billService;
        $this->customerService = $customerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->customerService->getAllUser();
        return view('backend.customers.abc',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customer.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = $this->customerService->findUserById($id);
        $bills = $this->billService->getBillByCustomer($id);
        return  view('backend.customer.view',compact('info','bills'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->customerService->delete($id);
            DB::commit();
            return redirect()->route('customer.index')->with('success','Xóa người dùng thành công.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('customer.index')->with('error','Xóa người dùng thất bại.');
            // something went wrong
        }
    }
}
