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
                    <h3 class="box-title">@if(isset($info)) Sửa @else Tạo @endif quyền</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form method="post" @if(isset($info)) action="{{route('role.update',$info->id)}}" @else action="{{route('role.store')}}" @endif>
                      @csrf

                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Tên quyền</label>
                                  <input type="text" name="name" class="form-control" required @if(isset($info->name)) value="{{$info->name}}" @endif>
                              </div>
                          </div>

                      </div>
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


