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
                    <h3 class="box-title">Danh sách voucher</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <a href="{{route('voucher.create')}}" class="btn btn-primary mb-2"><i class="mdi mdi-plus-box"></i> Tạo mới</a>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mã voucher</th>
                                <th>Giảm (%)</th>
                                <th>Ngày hết hạn</th>
                                <th>Trạng thái</th>
                                <th>Áp dụng cho khách hàng</th>
                                <th>Ghi chú</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($data) && count($data) > 0)
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                {{$item->code}}
                                            </td>
                                            <td>{{$item->discount_percent}}</td>
                                            <td>{{date('d/m/Y',strtotime($item->expiration_date))}}</td>
                                            <td>
                                                @if(in_array($item->status,VOUCHER_STATUS))
                                                    {{VOUCHER_STATUS[$item->status]}}
                                                @endif
                                            </td>
                                            <td>{{isset($item->customer_info->name) ? $item->customer_info->name : 'Tất cả'}}</td>
                                            <td>{{$item->note}}</td>
                                            <td>
                                                <a href="{{route('voucher.edit',$item->id)}}" class="btn btn-success"><i class="mdi mdi-settings"></i></a>
                                                <a href="{{route('voucher.destroy',$item->id)}}" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa ?');"><i class="mdi mdi-delete-forever"></i></a>
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


