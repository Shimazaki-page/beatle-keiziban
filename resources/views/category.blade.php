@extends('layouts.app_layout')

@section('title')
    カテゴリ別スレッド一覧
@endsection

@section('content')
    @if(session('add_thread'))
        <div class="alert alert-success text-center">
            {{session('add_thread')}}
        </div>
    @endif

    @if(session('delete_thread'))
        <div class="alert alert-success text-center">
            {{session('delete_thread')}}
        </div>
    @endif
    <h1 class="text-center my-5">カテゴリ別スレッド一覧：{{$category->name}}</h1>
    @if(!empty($threads))
        @foreach($threads as $thread)
            <div class="mb-4">
                <a class="card mx-auto mb-2 text-decoration-none" href="{{route('thread',[$category->id,$thread->id])}}"
                   style="max-width: 700px;">
                    <div class="card-body">
                        <h4 class="card-title">{{$thread->title}}</h4>
                        <p class="card-text">{{$thread->contents}}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-md-end">
                        <p class="mb-0">投稿者：{{$thread->name}}</p>
                        <p class="mb-0 ml-4">投稿日時：{{$thread->created_at->format('Y年m月d日　H:i:s')}}</p>
                    </div>
                </a>
                @auth
                    <div class="text-center">
                        <a href="{{route('delete.thread',[$category->id,$thread->id])}}">スレッド削除</a>
                    </div>
                @endauth
            </div>
        @endforeach
    @else
        <h4 class="my-5 text-center">このカテゴリーにはスレッドがありません。</h4>
    @endif

    @if(!empty($threads))
        <div class="d-flex justify-content-center">
            {{$threads->links()}}
        </div>
    @endif

    <form class="mx-auto my-5" method="get" action="{{route('register.thread')}}" style="max-width: 700px;">
        @csrf
        <div>
            @if(!empty($threads))
                <input type="hidden" name="category_id" value="{{$thread->category->id}}">
            @endif

            <div class="form-group">
                <label for="title">タイトル</label>
                <textarea class="form-control @error('title') is-invalid @enderror"
                          id="title" type="text" name="title">{{old('title')}}</textarea>
                @error('title')
                <div class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="message">コメント</label>
                <textarea class="form-control @error('title') is-invalid @enderror"
                          id="message" type="text" name="message">{{old('message')}}</textarea>
                @error('message')
                <div class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">お名前</label>
                <input class="form-control @error('title') is-invalid @enderror" id="name" type="text" name="name"
                       value="{{old('name')}}">
                @error('name')
                <div class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </div>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit" name="btn_submit">スレッド作成</button>
        </div>
    </form>
    <a class="btn btn-secondary d-block mb-5 mx-auto" href="{{route('top')}}" style="width: 200px;">TOPへ戻る</a>
@endsection
