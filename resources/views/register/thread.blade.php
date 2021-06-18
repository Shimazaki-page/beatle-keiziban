@extends('layouts.app_layout')

@section('title')
    スレッド作成内容確認
@endsection

@section('content')
    <div style="width: 50%; margin: 0 auto;max-width: 700px;">
        <div class="mx-auto mt-5 text-center">
            <h1>投稿するスレッドの確認</h1>
            <p>以下のルールに注意して投稿してください。</p>
            <ul class="list-unstyled font-weight-bold">
                <li>誰かを傷つける内容を避ける</li>
                <li>誰かを不快にさせる内容を避ける</li>
            </ul>
        </div>
        <div class="card mx-auto mb-2">
            <div class="card-body">
                <p>タイトル：{{$input['title']}}</p>
                <p class="mb-0">コメント：{{$input['message']}}</p>
            </div>
            <div class="card-footer">
                <p class="mb-0">投稿者：{{$input['name']}}</p>
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data" action="{{route('register.thread')}}">
            @csrf
            <div class="mb-2">
                <label for="image">ファイル選択</label>
                @error('image')
                {{$message}}
                @enderror
                <span class="form-control-file">
                  <input type="file" name="image" id="image">
                </span>
            </div>
            <div class="d-flex">
                <input class="btn btn-primary d-block" type="submit" name="btn_submit" value="スレッド作成">
                <a class="btn btn-secondary d-block ml-2" href="{{url()->previous()}}" style="width: 100px;">戻る</a>
            </div>

            <input type="hidden" name="category_id" value="{{$input['category_id']}}">
            <input type="hidden" name="title" value="{{$input['title']}}">
            <input type="hidden" name="message" value="{{$input['message']}}">
            <input type="hidden" name="name" value="{{$input['name']}}">
        </form>
    </div>
@endsection
