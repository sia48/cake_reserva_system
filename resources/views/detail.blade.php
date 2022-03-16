@extends('layouts.common')

@section('content')

<div class="nb-container nb-container-detail">

    <div class="top">
        <h1>ケーキ予約管理システム</h1>
        <p class="auth" data-id="{{ $user->shop_id }}" data-shop="{{ $user->name }}">{{ $user->shop_id . ':' . $user->name }}</p>
    </div>

    <form method="POST" action="{{ route('logout') }}" id="logout">
        @csrf
        <button type="submit"><a>ログアウト</a></button>
    </form>

    <div class="change_area">
        <div class="text-center">
            <h2 class="text-center mb-4 d-inline-block">変更したい項目のみ変更して下さい</h2>
            <div class="alert alert-success text-center mt-3 d-inline-block ml-4" role="alert">
                <strong>データ登録日時</strong>
                <p>{{ $order->updated_at }}</p>
            </div>
        </div>
        <div class="card-deck">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="card-title mb-4">予約日</h4>
                    <?php 
                        $date = $order->reserva_date;
                        $date = mb_substr($date, -3, 2);
                    ?>
                    <div class="justify-content-between">
                        @for($i = 21; $i < 26; $i++)
                            @if($i == $date)
                                <button type="button" class="btn btn-outline-primary mt-3 col-md-6 focus">{{ $i . '日' }}</button>
                            @else
                                <button type="button" class="btn btn-outline-primary mt-3 col-md-6">{{ $i . '日' }}</button>
                            @endif
                        @endfor
                    </div>
                    <div class="form-group mt-3">
                        <label for="through_check">通し番号：</label>
                        <input type="text" class="form-control through_check" id="through_check" value="{{ $order->through }}">
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">ケーキ</h4>
                    <select class="custom-select mt-3">
                        <option selected disabled value="{{ $order->cake_maker }}">メーカーを選択して下さい</option>
                        <option value="ヤマザキ">ヤマザキ</option>
                        <option value="シライシ">シライシ</option>
                        <option value="パスコ">パスコ</option>
                    </select>

                    <h4 class="card-text mt-5 text-center">メーカーを選択後、<br>ケーキを選択して下さい</h4>
                    <select name="cake" class="custom-select mt-2">
                        <option class="default" selected value="{{ $order->id }}">変更する場合は選択</option>
                    </select>
                    <h5 class="change mt-4" style="color:blue">変更前</h5>
                    <h6 class="selected_name mt-1" data-cake-name="{{ $order->cake_name }}" data-cake-id="{{ $order->cake_number . ', ' .$order->cake_name }}">{{ $order->cake_maker . '： ' . $order->cake_number . ',' . $order->cake_name }}</h6>

                    <div class="form-group row mt-2 justify-content-end align-content-center">
                        <label for="quantity">個数：</label>
                        <select class="form-control col-md-3" id="quantity">
                            @for($i = 1; $i < 6; $i++)
                                @if($i == $order->quantity)
                                    <option value="{{ $order->quantity }}" selected>{{ $order->quantity }}</option>
                                @else
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">お客様情報</h4>
                    <div class="form-group">
                        <label for="check_name">氏名</label>
                        <input type="text" class="form-control" id="check_name" value="{{ $order->customer->name }}">
                    </div>
                    <div class="form-group">
                        <label for="check_phone">電話番号</label>
                        <input type="tel" class="form-control" id="check_phone" value="{{ $order->customer->phone }}" maxlength="11">
                    </div>
                    <div class="form-group">
                        <label for="check_time">来店予定時刻</label>
                        <input type="time" class="form-control" id="check_time" value="{{ $order->customer->time }}" min="9" max="21" value="09:00" step="600">
                    </div>
                    <button type="button" class="btn btn-outline-success" onClick="history.back()">キャンセル</button>
                    <button type="button" class="btn btn btn-outline-warning" id="confirm">確認する</button>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron confirm_area" style="display:none">
        <h1 class="display-3 text-center mb-5" style="color:red">内容を確認して下さい</h1>
        <table class="table mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>通番</th>
                    <th>予約日</th>
                    <th>メーカー</th>
                    <th>ケーキ</th>
                    <th>数量</th>
                    <th>お客様氏名</th>
                    <th>電話番号</th>
                    <th>来店時刻</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>変更前</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">{{ $order->through }}</th>
                    <td>{{ mb_substr($order->reserva_date, -3) }}</td>
                    <td>{{ $order->cake_maker }}</td>
                    <td>{{ $order->cake_number . ', ' . $order->cake_name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->customer->phone }}</td>
                    <td>{{ $order->customer->time }}</td>
                </tr>
                <tr>
                <th></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>変更後</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="table-info">
                    <th scope="row" id="u_through"></th>
                    <td id="u_date"></td>
                    <td id="u_cake_maker"></td>
                    <td id="u_cake_number_name"></td>
                    <td id="u_quantity"></td>
                    <td id="u_customer_name"></td>
                    <td id="u_customer_phone"></td>
                    <td id="u_customer_time"></td>
                </tr>
            </tbody>
        </table>
        <div class="button_area">
            <button type="button" class="btn btn-outline-secondary retry_update">やり直す</button>
            <button type="button" class="btn btn-outline-success update">更新する</button>
        </div>
    </div>

    <div class="update fadein">
        <h2>更新が完了しました</h2>
        <p>自動的にリダイレクトします</p>
        <form action="{{ route('update', ['id' => $order->id]) }}" method="post" id="update">
            @csrf
            <input type="hidden" name="through" class="u_through" value="{{ $order->through }}">
            <input type="hidden" name="date" class="u_date" value="{{ mb_substr($order->reserva_date, -3) }}">
            <input type="hidden" name="cake_maker" class="u_maker" value="{{ $order->cake_maker }}">
            <input type="hidden" name="cake_number" class="u_cake_number" value="{{ $order->cake_number }}">
            <input type="hidden" name="cake_name" class="u_cake_name" value="{{ $order->cake_name }}">
            <input type="hidden" name="quantity" class="u_quantity" value="{{ $order->quantity }}">
            <input type="hidden" name="customer_id" class="u_customer_id" value="{{ $order->customer_id }}">
            <input type="hidden" name="customer_name" class="u_customer_name" value="{{ $order->customer->name }}">
            <input type="hidden" name="customer_phone" class="u_customer_phone" value="{{ $order->customer->phone }}">
            <input type="hidden" name="customer_time" class="u_customer_time" value="{{ $order->customer->time }}">
        </form>
    </div>
</div>

@endsection