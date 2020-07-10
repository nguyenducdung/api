@extends('layouts.admin')
@section('js')
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/firebase-app.js')}}"></script>
    <script src="{{asset('js/firebase-messaging.js')}}"></script>
    <script src="{{asset('js/firebase-messaging-sw.js')}}"></script>
    <script>
        function getWaitingFood() {
            $.ajax({
                type: 'get',
                url: '{{route('staff.index')}}',
                success: function(response){

                  // var list =  makeFoodList(response);
                    $('#tbl-list').html(response);
                },
                error: function(jqXHR, exception) {
                    console.log('error')
                }

            });
        }
        function makeFoodList(data){
            var list = '';
            if (data && data.length > 0){
                for (var i = 0; i < data.length;i++){
                    var food = data[i];
                    if (food){
                        list += makeFoodItem(food);
                    }
                }
            }
            return list;
        }
        function makeFoodItem(data){
            var table = data.bill.table.name ? data.bill.table.name : '';
            var food_info = data.food;
            var item = '';
            if(food_info){
                var food_name = food_info.name ? food_info.name : '';
                var time = data.created_at ? data.created_at : '';

                item = '<tr id="list'+data.id+'"><td>'+data.id+'</td>' +
                    // '<td></td>'+
                    '<td><img width="150px" src="'+food_info.image+'"/> </td>' +
                    '<td>'+food_name+'</td>' +
                    '<td>'+time+'</td>' +
                    '<td>'+data.num_of_food+'</td>' +
                    '<td>'+table+'</td>' +
                    '<td><p id="food'+data.id+'">'+food_info.time * data.num_of_food+'</p></td>' +
                    '<td class="text-center"><button class="btn btn-danger" onclick="doneFood('+data.id+')">Hoàn thành</button></td>' +
                    '</tr>';
            }
            return item;
        }
        function doneFood(id){
            $.ajax({
                type: 'post',
                url: '{{route('staff.updateStatus')}}',
                data:{
                    id:id,
                    _token:'{{csrf_token()}}'
                },
                success: function(response){
                    console.log(response);
                    if (response === 'false'){
                        alert('Đổi trạng thái món ăn thất bại')

                    } else {
                        alert('Đổi trạng thái món ăn thành công');
                        pushNotification(response.name);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log('error')
                }

            });
        }
        setInterval(getWaitingFood,1000);
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Món ăn đang chờ</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Tên món ăn</th>
                                <th>Đặt lúc</th>
                                <th>Số lượng</th>
                                <th>Bàn</th>
                                <th>Thời gian làm</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tbl-list">
                                @include('backend.home.food-list')
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
