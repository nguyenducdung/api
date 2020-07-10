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
                    <h3 class="box-title">@if(isset($info)) Sửa @else Tạo @endif voucher</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form method="post" @if(isset($info)) action="{{route('voucher.update',$info->id)}}" @else action="{{route('voucher.store')}}" @endif>
                      @csrf
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Mã voucher</label>
                                  <input type="text" name="code" class="form-control" @if(isset($info->code)) value="{{$info->code}}" disabled @endif>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Giảm (%)</label>
                                  <input type="number" min="0" max="100" name="discount_percent" class="form-control" required @if(isset($info->discount_percent)) value="{{$info->discount_percent}}" @endif>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Ngày hết hạn</label>
                                  <input type="date"  name="expiration_date" class="form-control" required @if(isset($info->expiration_date)) value="{{$info->expiration_date}}" @endif>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Trạng thái</label>
                                  <select class="form-control" name="status">
                                      @foreach(VOUCHER_STATUS as $key => $item)
                                          <option value="{{$key}}" @if(isset($info->status) && $info->status == $key) selected @endif>{{$item}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label>Ghi chú</label>
                                  <textarea class="form-control" name="note">@if(isset($info->note)){!! $info->note !!}@endif</textarea>
                              </div>
                          </div>
                      </div>
{{--                      <div class="row">--}}
{{--                          <div class="col-md-12">--}}
{{--                              <div class="form-group">--}}
{{--                                  <label>Chọn khách hàng</label>--}}
{{--                                  <div style="height: 300px" class="row">--}}
{{--                                      @if(count($customers) > 0)--}}
{{--                                          @foreach($customers as $customer)--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                --}}
{{--                                                <input type="checkbox" name="customers[{{$customer->id}}]">{{$customer->name}}--}}
{{--                                            </div>--}}
{{--                                          @endforeach--}}
{{--                                       @endif--}}
{{--                                  </div>--}}
{{--                              </div>--}}
{{--                          </div>--}}
{{--                      </div>--}}
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


