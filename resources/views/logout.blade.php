@extends('layouts.common')

@section('content')

<div class="nb-container">
    <div class="top">
        <h1>ケーキ予約管理システム</h1>
        <p class="auth" data-id="{{ $user->shop_id }}" data-shop="{{ $user->name }}">{{ $user->shop_id . ':' . $user->name }}</p>
    </div>
    <div class="alert alert-success text-center" role="alert">
        更新のため<strong class="countdown"></strong>後にログアウトします。
    </div>

    <form method="post" action="{{ route('logout') }}" style="display:none" class="logout">
        @csrf
    </form>

</div>

@endsection