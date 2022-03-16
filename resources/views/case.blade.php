@extends('layouts.common')

@section('content')

<div class="export_detail">

    <div class="card-group">
        @foreach($orders as $order)
            @if(array_search($order->id, $id) !== false)
                @continue
            @else
                <?php $total = 0; ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">{{ mb_substr($order->reserva_date, -3, 2) . ' - ' . $order->through }}</h4>
                        <p class="card-text mt-4 text-center"><strong>{{ $order->customer->name }}</strong></p>
                        <div class="cake_area">
                            <div class="no_wrap_area">
                                <p class="card-text d-inline-block">{{ $order->cake_maker . '：' . $order->cake_name }}</p>
                                <p class="card-text d-inline-block end">{{ $order->quantity . '個'}}</p>
                            </div>
                            <?php $total += $order->quantity; ?>
                            @foreach($orders as $val)
                                @if($order->id == $val->id)
                                    @continue
                                @else
                                    @if($val->reserva_date == $order->reserva_date && $val->customer_id == $order->customer_id && $val->id != $order->id)
                                    <div class="no_wrap_area">
                                        <p class="card-text d-inline-block">{{ $val->cake_maker . '：' . $val->cake_name }}</p>
                                        <p class="card-text d-inline-block end">{{ $val->quantity . '個' }}</p>
                                        <?php 
                                            $id[] = $val->id;
                                            $total += $val->quantity;
                                        ?>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <div class="info_area">
                            <p class="card-text d-inline-block">{{ '来店予定時刻' . '：' . $order->customer->time }}</p>
                            <p class="card-text d-inline-block end">合計<strong style="color:red">{{ $total }}</strong>個</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="export_button shadow-lg no-print">
        <button type="button" class="btn btn-primary btn-lg" onClick="window.print()"><strong>印刷する</button>
    </div>

</div>

@endsection