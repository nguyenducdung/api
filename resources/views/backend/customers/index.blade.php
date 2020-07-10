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
                    <h3 class="box-title">Danh sách tài khoản</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="{{route('user.create')}}" class="btn btn-primary mb-2"><i class="mdi mdi-plus-box"></i> Tạo mới</a>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($data) && count($data) > 0)
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                @if($item->avatar != null)
                                                    <img src="{{asset($item->avatar)}}" width="60px" >
                                                @endif
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{ACC_STATUS[$item->role_id]}}</td>
                                            <td>
{{--                                                <a href="{{route('user.show',$item->id)}}" class="btn btn-warning"><i class="mdi mdi-information"></i></a>--}}
                                                <a href="{{route('user.edit',$item->id)}}" class="btn btn-success"><i class="mdi mdi-settings"></i></a>
                                                <a href="{{route('user.destroy',$item->id)}}" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa ?');"><i class="mdi mdi-delete-forever"></i></a>
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


