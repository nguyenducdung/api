<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->userService->getAllUser();
        return view('backend.user.index',compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $avatar = $request->file('avatar');
        if ($avatar != null){

            $path = 'imgs';

            $ext = $avatar->getClientOriginalExtension();
            if (!in_array($ext,['png','jpg','jpeg'])){
                return back()->with('error','Ảnh phải thuộc định dạng: png , jpg , jpeg');
            }
            $avatar = $this->uploadFile($avatar,$path);
        }
        unset($params['avatar'],$params['_token']);
        $code = $request->get('code');
        $params['avatar'] = $avatar;
        $params['password'] = bcrypt('abcd1234');
        $params['code'] = $code != null ? $code : $this->userService->makeCode();
        $create = User::create($params);
        if ($create){
            return redirect()->route('user.index')->with('success','Tạo thành công');
        }else{
            return back()->with('error','Tạo thất bại');

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
        $info = User::findOrFail($id);
        return view('backend.user.view',compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = User::findOrFail($id);
        return view('backend.user.form',compact('info'));
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
        $info = User::findOrFail($id);
        $params = $request->all();
        $avatar = $request->file('avatar');
        if ($avatar != null){

            $path = 'imgs';

            $ext = $avatar->getClientOriginalExtension();
            if (!in_array($ext,['png','jpg','jpeg'])){
                return back()->with('error','Ảnh phải thuộc định dạng: png , jpg , jpeg');
            }
            $avatar = $this->uploadFile($avatar,$path);
        }else{
            $avatar = $info->avatar;
        }
        $code = $request->get('code');
        unset($params['avatar'],$params['_token']);
        $params['avatar'] = $avatar;
        $params['code'] = $code != null ? $code : $this->userService->makeCode();
        $update = $this->userService->updateUserInfo($id,$params);
        if ($update){
            return redirect()->route( 'user.index')->with('success','Sửa thành công');
        }else{
            return back()->with('error','Sửa thất bại');

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
        $info = User::findOrFail($id);
        if ($info->delete()){
            return redirect()->route('user.index')->with('success','Xóa thành công');
        }else{
            return back()->with('error','Xóa thất bại');
        }
    }

    public function changePass($id){
        $info = User::findOrFail($id);
        return view('user.change_pass',compact('info'));
    }
    public function updatePass( CheckPassRequest $request,$id){
        $info = User::findOrFail($id);
        $oldPass = $request->get('old_pass');
        if (auth()->user()->role_id != 0){
            if(!Hash::check($oldPass,$info->password)){
                return back()->with('error','Mật khẩu cũ không đúng !');
            };
        }
        $info->password = bcrypt($request->get('password'));
        if ($info->save()){
            return redirect()->route('user.index')->with('success','Đổi mật khẩu thành công');
        }else{
            return back()->with('error','Đổi mật khẩu thất bại');

        }
    }
}
