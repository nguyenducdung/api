@if(isset($data) && count($data) > 0)
    @foreach($data as $item)
        @if($item->food)
            @if($item->created_at != null)
                <?php
                $number = $item->num_of_food != null ? $item->num_of_food : 1;
                $time = isset($item->food->time) && $item->food->time > 0 ? $item->food->time : 10;
                $time = $number * $time;
                $time_off = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->created_at)->addMinutes($time);
                $now = \Carbon\Carbon::now();
                $diff_in_minutes = $time_off->diff($now)->format('%H:%I:%S');
                ?>

            <tr>
                <td>{{$item->id}}</td>
                <td>
                    @if(isset($item->food->image) && $item->food->image != null)
                        <img src="{{asset($item->food->image)}}" width="150px">
                    @endif
                </td>
                <td>{{$item->food->name}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->num_of_food}}</td>
                <td>{{isset($item->bill->table->name) ? $item->bill->table->name : '-'}}</td>
                <td>
                    @if($time_off < $now)
                        <span class="text-danger"><strong>Quá hạn</strong></span>
                    @else
                        {{$diff_in_minutes}}
                    @endif
                </td>
                <td class="text-center">
                    <button class="btn btn-danger" onclick="doneFood('{{$item->id}}')">Hoàn thành</button>
                </td>
            </tr>
            @endif
        @endif
    @endforeach
@endif