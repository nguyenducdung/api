<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Food\CreateRequest;
use App\Services\FoodService;
use App\Services\ImageService;
use App\Services\TypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    protected $foodService;
    protected $typeService;
    protected $imageService;
    public function __construct(
        FoodService $foodService,
        TypeService $typeService,
        ImageService $imageService
    )
    {
        $this->foodService = $foodService;
        $this->typeService = $typeService;
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->foodService->getAllFood();
        return view('backend.food.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = $this->typeService->getAll();
//        dd($types);
        return view('backend.food.form',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $file = $request->file('image');
        $name = $request->get('name');
        $params = $request->only('name','time','info','price','type_id','status','num_of_order','like_of_level');
        $slug_name = str_slug($name, '_');//tạo tên slug để gán vào tên ảnh sp
        $image = null;
        if ($file){
            $image = $this->imageService->uploadImage($file,$slug_name);
            $params['image'] = $image;
        }
        DB::beginTransaction();
        try {
            $this->foodService->create($params);
            DB::commit();
            return redirect()->route('food.index')->with('','Tạo món ăn thành công');
        } catch (\Exception $e) {
            if ($image != null){
                $this->imageService->deleteImages($image);
            }
            DB::rollback();
            return redirect()->route('food.index')->with('','Tạo món ăn thất bại');
        }

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
        $types = $this->typeService->getAll();
        $info = $this->foodService->findById($id);
        return view('backend.food.form',compact('types','info'));
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

        $file = $request->file('image');
        $name = $request->get('name');
        $params = $request->only('name','time','info','price','type_id','status','num_of_order','like_of_level');
        $slug_name = str_slug($name, '_');//tạo tên slug để gán vào tên ảnh sp
        $info = $this->foodService->findById($id);
        $old_image = $info->image;
        $image = null;
        DB::beginTransaction();
        try {
            if($file != null){
                $image = $this->imageService->uploadImage($file,$slug_name);
                $this->imageService->deleteImages($old_image);
                $params['image'] = $image;
            }
            $this->foodService->update($id,$params);
            DB::commit();

            return redirect()->route('food.index')->with('','Tạo món ăn thành công');
        } catch (\Exception $e) {
            if ($image != null){
                $this->imageService->deleteImages($image);
            }
            DB::rollback();
            return redirect()->route('food.index')->with('','Tạo món ăn thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->foodService->delete($id);
        if ($delete){
            return redirect()->route('food.index')->with('success','Xóa món ăn thành công.');
        }
        return redirect()->route('food.index')->with('error','Xóa món ăn thất bại.');
    }
}
