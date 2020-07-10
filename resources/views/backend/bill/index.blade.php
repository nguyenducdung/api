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
                    <h3 class="box-title">Danh sách hóa đơn</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
{{--                    <a href="{{route('table.create')}}" class="btn btn-primary mb-2"><i class="mdi mdi-plus-box"></i> Tạo mới</a>--}}
                    <div>
                        <a class="btn btn-primary mr-2 mb-2" href="{{route('bill.index')}}">Tất cả đơn hàng</a>

                        <a class="btn btn-warning mr-2 mb-2" href="{{route('bill.index',['status' => \App\Model\Bill::WAITING_STATUS])}}">Đơn hàng chờ chế biến</a>

                        <a class="btn btn-danger mr-2 mb-2" href="{{route('bill.index',['status' => \App\Model\Bill::DONE_STATUS])}}">Đơn hàng chờ thanh toán</a>

                        <a class="btn btn-success mr-2 mb-2" href="{{route('bill.index',['status' => \App\Model\Bill::PAID_STATUS])}}">Đơn hàng đã thanh toán</a>

                        <a class="btn btn-dark mr-2 mb-2" href="{{route('bill.index',['status' => \App\Model\Bill::CANCEL_STATUS])}}">Đơn hàng đã hủy</a>

                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bàn ăn</th>
                                <th>Khách hàng</th>
                                <th>Trạng thái</th>
                                <th>Số món đặt</th>
                                <th>Voucher</th>
                                <th>Tổng tiền</th>
                                <th>Giá cuối</th>
                                <th>Tạo lúc</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($data) && count($data) > 0)
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                               @if(isset($item->table))
                                                    <p>{{$item->table->code}}</p>
                                                    <p> {{$item->table->name}}</p>
                                               @endif
                                            </td>
                                            <td>
                                                @if(isset($item->customer))
                                                    <p>{{$item->customer->phone}}</p>
                                                    <p> {{$item->customer->name}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset(BILL_STATUS[$item->status]))
                                                    {{BILL_STATUS[$item->status]}}
                                                @endif
                                            </td>
                                            <td>{{$item->num_of_food}}</td>
                                            <td>
                                                @if(isset($item->voucher))
                                                    <p>{{$item->voucher->code}}</p>
                                                    <p>{{$item->voucher->discount_percent}}
                                                    <p>{{$item->voucher->expiration_date}}</p>
                                                    <p>{{in_array($item->voucher->status,VOUCHER_STATUS) ? VOUCHER_STATUS[$item->voucher->status] : '' }}</p>
                                                @else
                                                    <span class="text-danger">X</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->price_total != null ? number_format($item->price_total) : 0 }} VND
                                            </td>
                                            <td>
                                                {{ $item->price_discount != null ? number_format($item->price_discount) : 0 }} VND
                                            </td>
                                            <td>
                                                {{$item->created_at != null ? date('d/m/Y',strtotime($item->created_at)) : ''}}
                                            </td>
                                            <td>
                                                <a href="{{route('bill.edit',$item->id)}}" class="btn btn-primary"><i class="mdi mdi-settings"></i></a>
                                                <a href="{{route('bill.destroy',$item->id)}}" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa ?');"><i class="mdi mdi-delete-forever"></i></a>
                                                @if( in_array($item->status,[0,1]))
                                                    <a href="{{route('bill.paid',$item->id)}}" class="btn btn-success">Thanh toán</a>
                                                @endif
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


