@extends('layouts.admin')
@section('css')

@endsection
@section('js')
    <script src="{{asset('theme/main/js')}}/datatables.min.js"></script>
    <script src="{{asset('theme/main/js')}}/pages/data-table.js"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách món ăn</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="{{route('food.create')}}" class="btn btn-primary mb-2"><i class="mdi mdi-plus-box"></i> Tạo mới</a>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Tên món ăn</th>
                                <th>Loại món ăn</th>
                                <th>Thời gian chuẩn bị</th>
                                <th>Giá tiền</th>
                                <th>Trạng thái</th>
                                <th>Số lượt gọi</th>
                                <th>Mức độ yêu thích</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($data) && count($data) > 0)
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                <img src="{{asset($item->image)}}" width="40px">
                                            </td>
                                            <td>
                                                {{$item->name}}
                                            </td>
                                            <td>{{isset($item->type->name) ? $item->type->name : ''}}</td>
                                            <td>{{$item->time}}</td>
                                            <td>{{number_format($item->price)}}</td>
                                            <td>
                                                @if(in_array($item->status,FOOD_STATUS))
                                                    {{FOOD_STATUS[$item->status]}}
                                                @endif
                                            </td>
                                            <td>{{number_format($item->num_of_order)}}</td>
                                            <td>{{number_format($item->like_of_level)}}</td>
                                            <td>
                                                <a href="{{route('food.edit',$item->id)}}" class="btn btn-success"><i class="mdi mdi-settings"></i></a>
                                                <a href="{{route('food.destroy',$item->id)}}" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa ?');"><i class="mdi mdi-delete-forever"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection


