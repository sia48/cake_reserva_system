@extends('layouts.common')

@section('content')

<div class="export_container">

    <div class="export_top">
        <h1 class="text-center mt-2">{{ $year }} 年クリスマスケーキ予約表{{ '【 ' . $user->name . ' 】'}}</h1>
    </div>

    <div class="cake_container d-flex flex-row justify-content-around">
        <div class="export_table">
            <table class="table table-striped table-bordered table_yamazaki">
                <thead class="thead-dark">
                    <tr>
                        <th>ヤマザキ</th>
                        <th>ケーキ名</th>
                        @for($i = 21; $i < 26; $i++)
                            <th>{{ $i . '日' }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($yamazaki_cakes as $yamazaki_cake)
                        <tr>
                            <th scope="row">{{ $yamazaki_cake->number }}</th>
                            <td>{{ $yamazaki_cake->name }}</td>
                            @for($i = 21; $i < 26; $i++)
                                <td class="td_num">
                                    <?php $quantity = 0; ?>
                                    @foreach($yamazaki_orders as $yamazaki_order)
                                        @if(mb_substr($yamazaki_order->reserva_date, -3, 2) == $i && $yamazaki_order->cake_name == $yamazaki_cake->name)
                                            <?php $quantity += $yamazaki_order->quantity ?>
                                        @endif
                                    @endforeach
                                    @if($quantity == 0)
                                        {{ '' }}
                                    @else
                                        {{ $quantity }}
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row">合計</th>
                        <td>-</td>
                        @for($i = 21; $i < 26; $i++)
                            <td class="td_num">
                                <?php $quantity = 0; ?>
                                @foreach($yamazaki_orders as $yamazaki_order)
                                    @if(mb_substr($yamazaki_order->reserva_date, -3, 2) == $i)
                                        <?php $quantity += $yamazaki_order->quantity ?>
                                    @endif
                                @endforeach
                                {{ $quantity }}
                            </td>       
                        @endfor
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="export_flex">
            <table class="table table-striped table-bordered mb-4 table_siraisi">
                <thead class="thead-dark">
                    <tr>
                        <th>シライシ</th>
                        <th>ケーキ名</th>
                        @for($i = 21; $i < 26; $i++)
                            <th>{{ $i . '日' }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($siraisi_cakes as $siraisi_cake)
                        <tr>
                            <th scope="row">{{ $siraisi_cake->number }}</th>
                            <td>{{ $siraisi_cake->name }}</td>
                            @for($i = 21; $i < 26; $i++)
                                <td class="td_num">
                                    <?php $quantity = 0; ?>
                                    @foreach($siraisi_orders as $siraisi_order)
                                        @if(mb_substr($siraisi_order->reserva_date, -3, 2) == $i && $siraisi_order->cake_name == $siraisi_cake->name)
                                            <?php $quantity += $siraisi_order->quantity ?>
                                        @endif
                                    @endforeach
                                    @if($quantity == 0)
                                        {{ '' }}
                                    @else
                                        {{ $quantity }}
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row">合計</th>
                        <td>-</td>
                        @for($i = 21; $i < 26; $i++)
                            <td class="td_num">
                                <?php $quantity = 0; ?>
                                @foreach($siraisi_orders as $siraisi_order)
                                    @if(mb_substr($siraisi_order->reserva_date, -3, 2) == $i)
                                        <?php $quantity += $siraisi_order->quantity ?>
                                    @endif
                                @endforeach
                                {{ $quantity }}
                            </td>       
                        @endfor
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped table-bordered mb-4 table_pasco">
                <thead class="thead-dark">
                    <tr>
                        <th>パスコ</th>
                        <th>ケーキ名</th>
                        @for($i = 21; $i < 26; $i++)
                            <th>{{ $i . '日' }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($pasco_cakes as $pasco_cake)
                        <tr>
                            <th scope="row">{{ $pasco_cake->number }}</th>
                            <td>{{ $pasco_cake->name }}</td>
                            @for($i = 21; $i < 26; $i++)
                                <td class="td_num">
                                    <?php $quantity = 0; ?>
                                    @foreach($pasco_orders as $pasco_order)
                                        @if(mb_substr($pasco_order->reserva_date, -3, 2) == $i && $pasco_order->cake_name == $pasco_cake->name)
                                            <?php $quantity += $pasco_order->quantity ?>
                                        @endif
                                    @endforeach
                                    @if($quantity == 0)
                                        {{ '' }}
                                    @else
                                        {{ $quantity }}
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row">合計</th>
                        <td>-</td>
                        @for($i = 21; $i < 26; $i++)
                            <td class="td_num">
                                <?php $quantity = 0; ?>
                                @foreach($pasco_orders as $pasco_order)
                                    @if(mb_substr($pasco_order->reserva_date, -3, 2) == $i)
                                        <?php $quantity += $pasco_order->quantity ?>
                                    @endif
                                @endforeach
                                {{ $quantity }}
                            </td>       
                        @endfor
                    </tr>
                </tbody>
            </table>

            <div class="results d-flex flex-row">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>ヤマザキ</td>
                            <td class="td_num">{{ $yamazaki_total }}</td>
                        </tr>
                        <tr>
                            <td>シライシ</td>
                            <td class="td_num">{{ $siraisi_total }}</td>
                        </tr>
                        <tr>
                            <td>パスコ</td>
                            <td class="td_num">{{ $pasco_total }}</td>
                        </tr>
                        <tr>
                            <td>計</td>
                            <td class="td_num">{{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table ml-5">
                    <tbody>
                        <tr>
                            <td>計画</td>
                            <td class="td_num"><strong>{{ $user->target_num }}</strong>個</td>
                        </tr>
                        <tr>
                            <td>実績</td>
                            <td class="td_num"><strong>{{ $total }}</strong>個</td>
                        </tr>
                        <tr>
                            <td>達成率</td>
                            <td class="td_num"><strong>{{ round(($total / $user->target_num) * 100, 1) }}</strong>％</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="export_button shadow-lg no-print">
        <button type="button" class="btn btn-primary btn-lg" onClick="window.print()"><strong>印刷する(A3横推奨)</strong><br>お使いの環境に応じて<br>ページ設定をして下さい</button>
    </div>

</div>

@endsection