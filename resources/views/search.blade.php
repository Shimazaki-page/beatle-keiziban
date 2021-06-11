@extends('layouts.app_layout')

@section('title')
    カテゴリ別スレッド一覧
@endsection

@section('content')
    <h1 class="text-center my-5">スレッドキーワード検索結果："{{$keyword}}"</h1>
    @foreach($threads as $thread)
        <div class="mb-4">
            <a class="card mx-auto mb-2 text-decoration-none"
               href="{{route('thread',[$thread->category_id,$thread->id])}}"
               style="max-width: 700px;">
                <div class="card-body">
                    <h4 class="card-title">{{$thread->title}}</h4>
                    <p class="card-text">{{$thread->contents}}</p>
                </div>
                <div class="card-footer d-flex justify-content-md-end">
                    <p class="mb-0">カテゴリー：{{$thread->category->name}}</p>
                    <p class="mb-0 ml-4">投稿者：{{$thread->name}}</p>
                    <p class="mb-0 ml-4">投稿日時：{{$thread->created_at->format('Y年m月d日　H:i:s')}}</p>
                </div>
            </a>
            @auth
                <a class="d-block text-center mb-3"
                   href="{{route('delete.thread',[$thread->category_id,$thread->id])}}">スレッド削除</a>
            @endauth
        </div>
    @endforeach

    @if(!empty($threads))
    <div class="d-flex justify-content-center">
        {{$threads->links()}}
    </div>
    @endif

    <a class="btn btn-secondary d-block mb-5 mx-auto" href="{{route('top')}}" style="width: 200px;">TOPへ戻る</a>
@endsection
