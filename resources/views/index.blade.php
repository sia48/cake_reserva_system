@extends('layouts.common')

@section('content')
    <div class="nb-container">
        <div class="top">
            <h1>ケーキ予約管理システム</h1>
            <p class="auth" data-id="{{ $user->shop_id }}" data-shop="{{ $user->name }}">{{ $user->shop_id . ':' . $user->name }}</p>
        </div>

        <form method="POST" action="{{ route('logout') }}" id="logout">
            @csrf
            <button type="submit"><a>ログアウト</a></button>
        </form>


        <div class="select fadein_first">
            <h2>選択して下さい</h2>
            <div class="button_area">
                <button type="button" class="nb-btn btn_select register">入力する</button>
                <button type="button" class="nb-btn btn_select confirmation">確認する</button>
                <button type="button" class="nb-btn btn_select export">出力する</button>
                <button type="button" class="nb-btn btn_select select_config">設定する</button>
            </div>
        </div>
        <div class="which_config fadein">
            <h2>選択してください</h2>
            <div class="button_area">
                <button type="button" class="nb-btn btn_select config">マスタ管理（店舗での操作は非推奨）</button>
                <button type="button" class="nb-btn btn_select shop_config">店舗設定</button>
                <button type="button" class="nb-btn btn_select nb-close close_config">戻る</button>
            </div>
        </div>
        <div class="which_data fadein">
            <h2>選択してください</h2>
            <div class="button_area">
                <button type="button" class="nb-btn btn_select select_all" onClick="location.href='{{ route('export') }}'">一覧</button>
                <button type="button" class="nb-btn btn_select select_case" onClick="location.href='{{ route('case') }}'">詳細</button>
                <button type="button" class="nb-btn btn_select nb-close close_data">戻る</button>
            </div>
        </div>
        <div class="date fadein">
            <h2>予約日を選択して下さい</h2>
            <div class="button_area">
                @for($i = 0; $i < 5; $i++)
                    <?php $day_of_week = date('w', strtotime($start + $i)); ?>
                    <button type="button" class="nb-btn btn_select date_select" data-date-id="{{ $date + $i }}">{{ $date + $i }}<span class="day_of_week">{{ '（' . $week[$day_of_week] . '）' }}</span></button>
                @endfor
                <button type="button" class="nb-btn btn_select nb-close close_date">戻る</button>
            </div>
        </div>
        <div class="through fadein">
            <h2>通し番号を入力して下さい</h2>
            <div class="form-group form_through">
                <label class="mt-4" for="through">番号の他に任意の文字列の登録も可能です</label>
                <input type="text" class="form-control" id="through" autofocus>
            </div>
            <div class="button_area">
                <button type="button" class="nb-btn btn_select nb-close close_through">戻る</button>
                <button type="button" class="nb-btn btn_select through_select">決定</button>
            </div>
        </div>
        <div class="maker fadein">
            <h2>メーカーを選択して下さい</h2>
            <div class="button_area">
                <button type="button" class="nb-btn btn_select maker_select" data-maker-id="yamazaki">ヤマザキ</button>
                <button type="button" class="nb-btn btn_select maker_select" data-maker-id="siraisi">シライシ</button>
                <button type="button" class="nb-btn btn_select maker_select" data-maker-id="pasco">パスコ</button>
                <button type="button" class="nb-btn btn_select nb-close close_maker">戻る</button>
            </div>
        </div>
        <div class="cakes fadein">
            <h2>ケーキを選択して下さい</h2>
            <div class="cakes_select mb-4 mt-4">
                <select name="yamazaki" id="yamazaki" style="display:none">
                    <?php $i = 0; ?>
                    @foreach($yamazaki_cakes as $yamazaki)
                        @if($i == 0)
                            <option class="form-control" value="0" selected>選択して下さい</option>
                            <option class="form-control" value="{{ $yamazaki->number. '.' . $yamazaki->name }}">{{ $yamazaki->number . '.' . $yamazaki->name }}</option>
                        @else
                            <option class="form-control" value="{{ $yamazaki->number. '.' . $yamazaki->name }}">{{ $yamazaki->number . '.' . $yamazaki->name }}</option>
                        @endif
                        <?php $i++ ?>
                    @endforeach
                </select>
                <select name="siraisi" id="siraisi" style="display:none"> 
                    <?php $i = 0; ?>
                    @foreach($siraisi_cakes as $siraisi)
                        @if($i == 0)
                            <option class="form-control" value="0" selected>選択して下さい</option>
                            <option class="form-control" value="{{ $siraisi->number . '.' . $siraisi->name }}">{{ $siraisi->number . '.' . $siraisi->name }}</option>
                        @else
                            <option class="form-control" value="{{ $siraisi->number . '.' . $siraisi->name }}">{{ $siraisi->number . '.' . $siraisi->name }}</option>
                        @endif
                        <?php $i++ ?>
                    @endforeach
                </select>
                <select name="pasco" id="pasco" style="display:none">
                    <?php $i = 0; ?>
                    @foreach($pasco_cakes as $pasco)
                        @if($i == 0)
                            <option class="form-control" value="0" selected>選択して下さい</option>
                            <option class="form-control" value="{{ $pasco->number . '.' . $pasco->name }}">{{ $pasco->number . '.' . $pasco->name }}</option>
                        @else
                            <option class="form-control" value="{{ $pasco->number . '.' . $pasco->name }}">{{ $pasco->number . '.' . $pasco->name }}</option>
                        @endif
                        <?php $i++ ?>
                    @endforeach
                </select>
                <select name="quantity" id="quantity">
                    @for($i = 0; $i < 5; $i++)
                        @if($i == 0)
                            <option class="form-control" value="{{ $i }}">個数</option>
                        @else
                            <option class="form-control" value="{{ $i }}">{{ $i }}</option>
                        @endif
                    @endfor
                </select>
            </div>
            <div class="button_area">
                <button type="button" class="nb-btn btn_select nb-close close_cake">戻る</button>
                <button type="button" class="nb-btn btn_select cake_select">決定</button>
            </div>
        </div>
        <div class="customer fadein">
            <h2>お客様情報を入力して下さい</h2>
            <div class="customer_area">
                <div class="form-group mt-4">
                    <label for="customer_name">お客様氏名</label>
                    <input class="form-control" type="text" name="customer_name" id="customer_name" required placeholder="例：山田太郎">
                </div>
                <div class="form-group phone">
                    <label for="customer_phone">電話番号(ハイフンなし)</label>
                    <input class="form-control" type="tel" name="customer_phone" id="customer_phone" placeholder="例：08012345678" maxlength="11">
                </div>
                <div class="form-group time">
                    <label for="customer_time">来店予定時刻</label>
                    <input class="form-control" type="time" name="customer_time" id="customer_time" min="9" max="21" value="09:00" step="600">
                </div>
            </div>
            <div class="button_area">
                <button type="button" class="nb-btn btn_select nb-close close_customer">戻る</button>
                <button type="button" class="nb-btn btn_select customer_select">決定</button>
            </div>
        </div>
        <div class="confirm fadein">
            <h2>予約内容はお間違いないですか？</h2>
            <div class="card text-white bg-primary mb-3 d-inline-block">
                <div class="card-header">お客様情報</div>
                <div class="card-body">
                    <h3 class="js_customer_name card-title"></h3>
                    <p class="card-text js_customer_phone mt-4"></p>
                    <p class="card-text js_customer_time"></p>
                </div>
            </div>
            <div class="card text-white bg-dark mb-3 d-inline-block">
                <div class="card-header">ケーキ詳細</div>
                <div class="card-body">
                    <h3 class="card-title js_date"></h3>
                    <p class="js_through"></p>
                    <p class="card-text js_maker"></p>
                    <p class="card-text js_number_name"></p>
                    <p class="card-text js_quantity"></p>
                    <h3 class="js_cake_number" style="display:none"></h3>
                    <h3 class="js_cake_name" style="display:none"></h3>
                </div>
            </div>
            <div class="button_area">
                <button type="button" class="nb-btn btn_select nb-close close_confirm">やり直す</button>
                <button type="button" class="nb-btn btn_select confirm_select" form="submit">登録する</button>
            </div>
        </div>
        <div class="success fadein">
            <h2>登録が完了しました</h2>
            <p>自動的にリダイレクトします</p>
            <form action="{{ route('store') }}" method="post" id="submit">
                @csrf
                <input type="hidden" name="shop_id" class="c_shop_id">
                <input type="hidden" name="shop_name" class="c_shop_name">
                <input type="hidden" name="date" class="c_date">
                <input type="hidden" name="through" class="c_through">
                <input type="hidden" name="cake_maker" class="c_maker">
                <input type="hidden" name="cake_number" class="c_cake_number">
                <input type="hidden" name="cake_name" class="c_cake_name">
                <input type="hidden" name="quantity" class="c_quantity">
                <input type="hidden" name="customer_name" class="c_customer_name">
                <input type="hidden" name="customer_phone" class="c_customer_phone">
                <input type="hidden" name="customer_time" class="c_customer_time">
            </form>
        </div>
    </div>
@endsection