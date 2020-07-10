<?php
use App\Model\Bill;
?>
@extends('layouts.admin')
@section('js')
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <script>
        function makeBarchart(id,labels,data,label,text) {
            // Bar chart
            new Chart(document.getElementById(id), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: label,
                            backgroundColor: ["#689f38", "#38649f","#389f99","#ee1044","#ff8f00"],
                            data: data
                        }
                    ]
                },
                options: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: text
                    }
                }
            });
        }
        makeBarchart('bar-chart1',JSON.parse('<?php echo json_encode($arrClass['labels'])?>'),JSON.parse('<?php echo json_encode($arrClass['data'])?>'),'Món ăn','');
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Báo Cáo - Thống Kê</h3>
                    <div class="container-fluid">
                        <form method="get" class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Từ ngày</label>
                                    <input type="date" name="from"  class="form-control" value="{{$from}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Đến ngày</label>
                                    <input type="date" name="to"  class="form-control" value="{{$to}}">
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button class="btn btn-danger">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <!-- col -->
                        <?php
                            $total = $arrStatus['total'];
                        ?>

                        <div class="col-md-12">
                            <a class="btn btn-primary mr-2 mb-2" href="{{route('bill.index')}}">Tất cả đơn hàng ({{array_sum($total)}})</a>

                            <a class="btn btn-warning mr-2 mb-2" href="{{route('bill.index',['status' => Bill::WAITING_STATUS])}}">Đơn hàng chờ chế biến ({{ isset($total[Bill::WAITING_STATUS]) ? $total[Bill::WAITING_STATUS] : 0 }})</a>

                            <a class="btn btn-danger mr-2 mb-2" href="{{route('bill.index',['status' => Bill::DONE_STATUS])}}">Đơn hàng chờ thanh toán ({{ isset($total[Bill::DONE_STATUS]) ? $total[Bill::DONE_STATUS] : 0 }})</a>

                            <a class="btn btn-success mr-2 mb-2" href="{{route('bill.index',['status' => Bill::PAID_STATUS])}}">Đơn hàng đã thanh toán ({{ isset($total[Bill::PAID_STATUS]) ? $total[Bill::PAID_STATUS] : 0 }})</a>

                            <a class="btn btn-dark mr-2 mb-2" href="{{route('bill.index',['status' => Bill::CANCEL_STATUS])}}">Đơn hàng đã hủy ({{ isset($total[Bill::CANCEL_STATUS]) ? $total[Bill::CANCEL_STATUS] : 0 }})</a>
                        </div>
                        <div class="col-xl-12 col-12">
                            <div class="box">
                                <div class="box-body">
                                    <h4 class="box-title">Biểu đồ thống kê lượt đặt theo món</h4>
                                    <div>
                                        <canvas id="bar-chart1" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /col -->
                        <!-- col -->
{{--                        <div class="col-xl-6 col-12">--}}
{{--                            <div class="box">--}}
{{--                                <div class="box-body">--}}
{{--                                    <h4 class="box-title">Biểu đồ giáo viên dạy lớp</h4>--}}
{{--                                    <div>--}}
{{--                                        <canvas id="bar-chart2" height="200"></canvas>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
