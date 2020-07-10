<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Table\UpdateTableRequest;
use App\Services\ApiService;
use App\Services\TableService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableController extends Controller
{
    protected $apiService;
    protected $tableService;
    public function __construct(
        ApiService $apiService,
        TableService $tableService
    )
    {
        $this->apiService   = $apiService;
        $this->tableService = $tableService;
    }

    public function getAll(){
        $data = $this->tableService->getAllTable();
        if (!$data){
            return $this->apiService->jsonResponse(400,'error','Table not found',400);
        }
        return $this->apiService->jsonResponse(200,'table',$data,200);
    }

    public function getInfo($id){
        $info = $this->tableService->find($id);
        if (!$info){
            return $this->apiService->jsonResponse(400,'error','Table not found',400);
        }
        return $this->apiService->jsonResponse(200,'table',$info,200);
    }
    public function update(UpdateTableRequest $request){
        $params = $request->only('status');
        $id = $request->get('id');
        $update = $this->tableService->update($id,$params);
        if ($update){
            return $this->apiService->jsonResponse(200,'table',$update,200);
        }
        return $this->apiService->jsonResponse(400,'error','Update table false',400);
    }
}
