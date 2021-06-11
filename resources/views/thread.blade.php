@extends('layouts.app_layout')

@section('title')
    カテゴリ別スレッド一覧
@endsection

@section('content')
    @if(session('add_comment'))
        <div class="alert alert-success text-center">
            {{session('add_comment')}}
        </div>
    @endif

    @if(session('delete_comment'))
        <div class="alert alert-success text-center">
            {{session('delete_comment')}}
        </div>
    @endif

    <div class="card mx-auto text-decoration-none mt-4 mb-5" style="max-width: 700px;">
        <div class="card-body">
            <h2>{{$thread->title}}</h2>
            <h4>{{$thread->contents}}</h4>
            @if($thread->thread_file_path)
                <img class="w-100" src="{{asset('storage/'.$thread->thread_file_path)}}" alt="">
            @endif
        </div>
        <div class="card-footer d-flex justify-content-md-end">
            <p class="mb-0">カテゴリー：{{$category->name}}</p>
            <p class="mb-0 ml-4">投稿者：{{$thread->name}}</p>
            <p class="mb-0 ml-4">投稿日時：{{$thread->created_at->format('Y年m月d日 H:i:s')}}</p>
        </div>
    </div>

    @if(!empty($comments))
        @foreach($comments as $comment)
            <div class="card mx-auto mb-4" style="max-width: 700px;">
                <div class="card-body">
                    <h5 class="mb-2">{{$comment->contents}}</h5>
                    @if($comment->comment_file_path)
                            <img class="w-100" src="{{asset('storage/'.$comment->comment_file_path)}}" alt="">
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-md-end">
                    <p class="mb-0">投稿者：{{$comment->name}}</p>
                    <p class="mb-0 ml-4">投稿日時：{{$comment->created_at->format('Y年m月d日 H:i:s')}}</p>
                    @auth
                        <a class="ml-2" href="{{route('delete.comment',[$thread->id,$comment->id])}}">削除</a>
                    @endauth
                </div>
            </div>
        @endforeach
    @endif

    @if(!empty($comments))
        <div class="d-flex justify-content-center">
            {{$comments->links()}}
        </div>
    @endif

    <form class="mx-auto my-5" method="get" action="{{route('register.comment')}}"
          style="max-width: 700px;">
        @csrf
        <input type="hidden" name="thread_id" value="{{$thread->id}}">
        <input type="hidden" name="category_id" value="{{$thread->category_id}}">

        <div class="form-group">
            <label for="name">お名前</label>
            <input class="form-control @error('message') is-invalid @enderror" id="name" type="text" name="name"
                   value="{{old('name')}}">
            @error('name')
            <div class="invalid-feedback">
                <strong>{{$message}}</strong>
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="message">コメント</label>
            <textarea class="form-control @error('message') is-invalid @enderror" id="message" type="text"
                      name="message">{{old('message')}}</textarea>
            @error('message')
            <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>

        <div class="d-flex">
            <input class="btn btn-primary" type="submit" name="btn_submit" value="コメント投稿">
            <button class="btn btn-secondary d-block ml-2" type="button" onclick="history.back()" style="width: 100px;">
                戻る
            </button>
        </div>
    </form>
@endsection
