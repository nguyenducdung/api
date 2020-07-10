@extends('layouts.admin')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    <div class="row">
        <div class="col-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@if(isset($info)) Sửa @else Tạo @endif tài khoản</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form method="post" @if(isset($info->id)) action="{{route('user.update',$info->id)}}" @else action="{{route('user.store')}}" @endif enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Quyền</label>
                                  <select name="role_id" class="form-control" id="role_id" @if(isset($info)) @endif>
                                      <option value="0" @if(isset($info->role_id) && $info->role_id == '0') selected @elseif(request('role_id')== 0) selected @endif>Nhân viên</option>
                                      <option value="1" @if(isset($info->role_id) && $info->role_id == '1') selected @elseif(request('role_id')== 1) selected @endif>Admin</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Mã nhân viên</label>
                                  <input type="text" name="code" class="form-control" placeholder="Để trống mã sẽ tự sinh" @if(isset($info->code)) value="{{$info->code}}" @endif>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Tên tài khoản</label>
                                  <input type="text" name="name" class="form-control" required @if(isset($info->name)) value="{{$info->name}}" @endif>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Avatar</label>
                                  @if(isset($info->avatar) && $info->avatar != null)
                                    <img src="{{asset($info->avatar)}}" width="60px">
                                  @endif
                                  <input type="file" name="avatar" class="form-control">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Điện thoại</label>
                                  <input type="text" name="phone" class="form-control"  @if(isset($info->phone)) value="{{$info->phone}}" @endif>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Email</label>
                                  <input type="email" name="email" class="form-control" required @if(isset($info->email)) value="{{$info->email}}" disabled @endif>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Ngày sinh</label>
                                  <input type="date" name="birthday" class="form-control"  @if(isset($info->birthday)) value="{{$info->birthday}}" @endif>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Giới tính</label>
                                  <select class="form-control" name="gender">
                                      <option value="0" @if(isset($info->gender) && $info->gender == 0) selected @endif>Nữ</option>
                                      <option value="1" @if(isset($info->gender) && $info->gender == 1) selected @endif>Nam</option>
                                  </select>
                              </div>
                          </div>
                      </div>

                      {{--<div class="row">--}}

                          {{--<div class="col-md-12">--}}
                              {{--<div class="form-group">--}}
                                  {{--<label>Ghi chú</label>--}}
                                  {{--<input type="text" class="form-control" name="note" @if(isset($info->note)) value="{{$info->note}}" @endif>--}}
                              {{--</div>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      <div class="row">
                          <div class="col-md-12 text-right">
                              <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Lưu</button>
                          </div>
                      </div>
                  </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection


