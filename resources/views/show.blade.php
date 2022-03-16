@extends('layouts.common')

@section('content')

<div id="page_top"><a href="#"></a></div>
<div id="page_back"><a href="#">戻る</a></div>

<div class="nb-container nb-container-show">
    <div class="top">
        <h1>ケーキ予約管理システム</h1>
        <p class="auth" data-id="{{ $user->shop_id }}" data-shop="{{ $user->name }}">{{ $user->shop_id . ':' . $user->name }}</p>
    </div>

    <form method="POST" action="{{ route('logout') }}" id="logout">
        @csrf
        <button type="submit"><a>ログアウト</a></button>
    </form>


    <h2 class="text-center mb-4">詳細確認画面</h2>
    <nav class="navbar navbar-light bg-light mb-4 justify-content-center">
        <form class="form-inline justify-content-between" action="{{ route('search') }}" method='post'>
            @csrf
            <select class="custom-select select_date" name="date">
                <option selected value="">予約日</option>
                @for($i = 21; $i < 26; $i++)
                    <option value ="{{ $i . '日' }}">{{ $i . '日' }}</option>
                @endfor
            </select>
            <select class="custom-select select_maker ml-4" name="maker">
                <option selected value="">メーカー</option>
                <option value ="ヤマザキ">ヤマザキ</option>
                <option value ="シライシ">シライシ</option>
                <option value ="パスコ">パスコ</option>
            </select>
            <input class="form-control mr-sm-2 ml-4" type="text" name="name" placeholder="ケーキ名">
            <button class="btn btn-outline-success my-2 my-sm-0 ml-4" type="submit">検索</button>
            <button class="btn btn-outline-warning my-2 my-sm-0 ml-4" type="button">全件</button>
        </form>
    </nav>

    <div class="table-area">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>通番</th>
                    <th>予約日</th>
                    <th>メーカー</th>
                    <th>ケーキ</th>
                    <th>数量</th>
                    <th>お客様氏名</th>
                    <th>詳細</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @if(!$contents->isEmpty())
                    @foreach($contents as $content)
                        <tr>
                            <th scope="row">{{ $content->through }}</th>
                            <td>{{ $content->reserva_date }}</td>
                            <td>{{ $content->cake_maker }}</td>
                            <td>{{ $content->cake_number . ', ' . $content->cake_name }}</td>
                            <td>{{ $content->quantity}}</td>
                            <td>{{ $content->customer->name }}</td>
                            <td>
                                <a class="stretched-link" href="{{ route('detail', ['id' => $content->id]) }}">詳細</a>
                            </td>
                            <td>
                                <a class="stretched-link"><span class="badge badge-danger" data-delete-id="{{ $content->id }}">削除</span></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

</div>

<div class="delete fadein">

    <div class="top">
        <h1>ケーキ予約管理システム</h1>
        <p class="auth" data-id="{{ $user->shop_id }}" data-shop="{{ $user->name }}">{{ $user->shop_id . ':' . $user->name }}</p>
    </div>

    <h2>削除が完了しました</h2>
    <p>自動的にリダイレクトします</p>
    <form action="" method="post" id="delete">
        @csrf
        @method('delete')
        <input type="hidden" class="d_id">
    </form>
</div>

<div class="jumbotron delete_area fadein">

    <div class="top">
        <h1>ケーキ予約管理システム</h1>
        <p class="auth" data-id="{{ $user->shop_id }}" data-shop="{{ $user->name }}">{{ $user->shop_id . ':' . $user->name }}</p>
    </div>

    <div class="style-center-center">
        <h1 class="display-3 text-center mb-5" style="color:red">本当に削除してよろしいですか？</h1>
        <table class="table mt-4">
            <thead class="table-danger">
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
                    <th scope="row" class="d_through"></th>
                    <td class="d_date"></td>
                    <td class="d_cake_maker"></td>
                    <td class="d_cake_name">読み込み中</td>
                    <td class="d_quantity"></td>
                    <td class="d_customer_name"></td>
                    <td class="d_customer_phone"></td>
                    <td class="d_customer_time"></td>
                </tr>
            </tbody>
        </table>
        <div class="button_area mt-5">
            <button type="button" class="btn btn-outline-secondary retry">やり直す</button>
            <button type="button" class="btn btn-outline-danger delete">削除する</button>
        </div>
    </div>
</div>

<table class="table achievement mt-2">
    <tr class="table-primary text-center">
        <th>予約目標： {{ $user->target_num }} 個</th>
        @if(isset($search_total))
            <th>検索条件実績： {{ $search_total }} 個</th>
        @else
            <th>検索条件実績： {{ $total }} 個</th>
        @endif
        <th>予約実績： {{ $total }} 個</th>
        <th>達成率： {{ round(($total / $user->target_num) * 100, 1) }} ％ </th>
    </tr>
</table>

@endsection