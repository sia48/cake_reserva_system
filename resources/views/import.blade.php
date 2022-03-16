@extends('layouts.common')

@section('content')

<div class="nb-container">
    <div class="top">
        <h1>ケーキ予約管理システム</h1>
        <p class="auth" data-id="{{ $user->shop_id }}" data-shop="{{ $user->name }}">{{ $user->shop_id . ':' . $user->name }}</p>
    </div>

    <h2 class="text-center">ケーキの登録</h2>

    <div class="cake-all">
        <div class="card card-show">
            <div class="card-body">
                <p class="card-text">下図のようにエクセルファイルを作成すると一括で登録が出来ます</p>
            </div>
            <img src="{{ asset('img/cake-example.jpg') }}" class="cake-example">
        </div>

        <form method="post" action="{{ route('import') }}" enctype="multipart/form-data" class="text-center mt-4">
            @csrf
            <div class="custom-file row justify-content-between">
                <input type="file" class="custom-file-input col-md-9" id="customFile" name="excel_file">
                <label class="custom-file-label col-md-9" for="customFile">ファイルを選択して下さい</label>
                <button type="submit" class="btn btn-outline-success col-md-2">送信</button>
            </div>
        </form>
        <a href="#" id="prev-item-link" class="arrow-nav">
            <i class="fas fa-arrow-left"></i>
            <span class="prev">ホームへ<br>戻る</span>
        </a>
        <a href="#" id="next-item-link" class="arrow-nav">
            <i class="fas fa-arrow-right"></i>
            <span class="add">1件ずつ<br>登録する</span>
        </a>
        @if ($errors->any() || isset($message))
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ '登録に失敗しました。  ' . $error }}</li>
                    @endforeach
                    @if(isset($message))
                        <li>{{ $message }}</li>
                    @endif
                </ul>
            </div>
        @endif
        @if(isset($success))
            <div class="alert alert-primary mt-4">
                <li>{{ $success }}</li>
            </div>
        @endif
    </div>

    <div class="onebyone" style="display:none">
        <form action="{{ route('register') }}" method="post" id="register">
            @csrf
            <div class="row justify-content-between mt-5">
                <input name="number" class="form-control col-md-3" type="text" placeholder="ナンバー">
                <select name="maker" class="form-control col-md-3">
                    <option value="未選択" selected disabled>メーカー</option>
                    <option value="ヤマザキ">ヤマザキ</option>
                    <option value="シライシ">シライシ</option>
                    <option value="パスコ">パスコ</option>
                </select>
                <input name="name" class="form-control col-md-5" type="text" placeholder="ケーキ名">
            </div>
        </form>
        <div class="button_area">
            <button type="submit" class="nb-btn btn_select cake_register" form="register">登録</button>
            <button type="button" class="nb-btn btn_select nb-close close_register">戻る</button>
        </div>
    </div>

</div>

    <script>
        bsCustomFileInput.init();
    </script>

@endsection