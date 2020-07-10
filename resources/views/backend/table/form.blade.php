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
                    <h3 class="box-title">@if(isset($info)) Sửa @else Tạo @endif bàn ăn</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form method="post" @if(isset($info)) action="{{route('table.update',$info->id)}}" @else action="{{route('table.store')}}" @endif>
                      @csrf
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Mã bàn ăn</label>
                                  <input type="text" name="code" class="form-control" required @if(isset($info->code)) value="{{$info->code}}" disabled @endif>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Tên bàn ăn</label>
                                  <input type="text" name="name" class="form-control" required @if(isset($info->name)) value="{{$info->name}}" @endif>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Khách tối đa</label>
                                  <input type="number" min="0" name="customer_limit" class="form-control" required @if(isset($info->customer_limit)) value="{{$info->customer_limit}}" @endif>
                              </div>
                          </div>

                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Trạng thái</label>
                                  <select class="form-control" name="status">
                                    @foreach(TABLE_STATUS as $key => $item)
                                          <option value="{{$key}}" @if(isset($info->status) && $info->status == $key) selected @endif>{{$item}}</option>
                                    @endforeach
                                  </select>
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


