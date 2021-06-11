@extends('layouts.app_layout')

@section('title')
    コメント削除確認
@endsection

@section('content')
    <x-header></x-header>
    <div class="mt-5" style="width: 50%; margin: 0 auto; max-width: 700px;">
        <p>タイトル：{{$thread->title}}</p>
        <p>コメント：{{$thread->contents}}</p>
        <p>投稿者：{{$thread->name}}</p>
        <p>削除しますか？</p>
        <form method="post" action="{{route('delete.thread',[$category_id,$thread->id])}}">
            @csrf
            <div class="d-flex">
                <input class="btn btn-danger d-block" type="submit" value="削除" style="width: 100px">
                <button class="btn btn-secondary d-block ml-2" type="button" onclick="history.back()" style="width: 100px">戻る</button>
            </div>
        </form>
    </div>
@endsection
