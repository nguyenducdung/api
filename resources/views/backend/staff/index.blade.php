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
                    <h3 class="box-title">Danh sách món ăn chờ làm</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID hóa đơn</th>
                                <th></th>
                                <th>Tên món ăn</th>
                                <th>Thời gian chuẩn bị</th>
                                <th>Thời gian còn lại</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($data) && count($data) > 0)
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                <img src="{{isset($item->food->image) ? asset($item->food->image) : ''}}" width="40px">
                                            </td>
                                            <td>
                                                {{isset($item->food->name) ? $item->food->name : ''}}
                                            </td>
                                            <td>{{isset($item->food->time) ? $item->food->time : ''}}</td>
                                            <td>
                                                <p id="time-{{$item->id}}"></p>
                                            </td>
                                            <td>
                                                @if(in_array($item->status,FOOD_COOKING_STATUS))
                                                    {{FOOD_COOKING_STATUS[$item->status]}}
                                                @endif
                                            </td>
                                            <td>
                                                <form method="post" action="{{route('staff.updateStatus')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                    <input type="hidden" name="status" value="1">
                                                    <button class="btn btn-success" type="submit">Hoàn thành</button>
                                                </form>
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


