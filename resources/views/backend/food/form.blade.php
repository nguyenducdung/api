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
                    <h3 class="box-title">@if(isset($info)) Sửa @else Tạo @endif món ăn</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form method="post" @if(isset($info)) action="{{route('food.update',$info->id)}}" @else action="{{route('food.store')}}" @endif enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Tên món ăn</label>
                                  <input type="text" name="name" class="form-control" required @if(isset($info->name)) value="{{$info->name}}" @endif>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Ảnh món ăn</label>
                                  <input type="file" name="image">
                                  @if(isset($info->image) && $info->image != null)
                                    <img src="{{asset($info->image)}}" width="400px">
                                  @endif
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Thời gian chuẩn bị món ăn</label>
                                  <input type="text" name="time" class="form-control" required @if(isset($info->time)) value="{{$info->time}}" @endif>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Giá</label>
                                  <input type="number" min="0" name="price" class="form-control" required @if(isset($info->price)) value="{{$info->price}}" @endif>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Số lượt gọi</label>
                                  <input type="number" min="0" name="num_of_order" class="form-control" required @if(isset($info->num_of_order)) value="{{$info->num_of_order}}" @endif>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Mức độ yêu thích</label>
                                  <input type="number" min="0" name="like_of_level" class="form-control" required @if(isset($info->like_of_level)) value="{{$info->like_of_level}}" @endif>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Trạng thái</label>
                                  <select class="form-control" name="status">
                                    @foreach(FOOD_STATUS as $key => $item)
                                          <option value="{{$key}}" @if(isset($info->status) && $info->status == $key) selected @endif>{{$item}}</option>
                                    @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Loại món ăn</label>
                                  <select class="form-control" name="type_id">
                                      @foreach($types as $key => $item)
                                          <option value="{{$item->id}}" @if(isset($info->type_id) && $info->type_id == $item->id) selected @endif>{{$item->name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Giới thiệu</label>
                                  <textarea class="form-control" name="info">@if(isset($info->info)){!! $info->info !!}@endif</textarea>
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


