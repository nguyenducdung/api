<?php

namespace App\Http\Controllers\Backend;

use App\Services\TableService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableController extends Controller
{
    protected $tableService;
    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->tableService->getAllTable();
        return view('backend.table.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.table.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->only('name','status','customer_limit');
        $params['code'] = $request->get('code') != null ? $request->get('code') : md5(Carbon::now()->timestamp);
        $create = $this->tableService->create($params);
        if ($create){
            return redirect()->route('table.index')->with('success','Tạo bàn thành công');
        }
        return redirect()->route('table.index')->with('error','Tạo bàn thất bại');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $info = $this->tableService->find($id);
       return view('backend.table.form',compact('info'));
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
        $params = $request->only('name','status','customer_limit');
        $update = $this->tableService->update($id,$params);

        if ($update){
            return redirect()->route('table.index')->with('success','Cập nhật bàn thành công');
        }
        return redirect()->route('table.index')->with('error','Cập nhật bàn thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->tableService->delete($id);
        if ($delete){
            return redirect()->route('table.index')->with('success','Xóa bàn thành công');
        }
        return redirect()->route('table.index')->with('error','Xóa bàn thất bại');
    }
}
