@extends('layouts.app_layout')

@section('title')
    コメント削除確認
@endsection

@section('content')
    <x-header></x-header>
    <div class="mt-5" style="width: 50%; margin: 0 auto; max-width: 700px;">
        <p>コメント：{{$comment->contents}}</p>
        <p>投稿者：{{$comment->name}}</p>
        <p>削除しますか？</p>
        <form method="post" action="{{route('delete.comment',[$thread_id,$comment->id])}}">
            @csrf
            <div class="d-flex">
                <input class="btn btn-danger" type="submit" value="削除" style="width: 100px">
                <button class="btn btn-secondary d-block ml-2" type="button" onclick="history.back()" style="width: 100px">戻る</button>
            </div>
        </form>
    </div>
@endsection
