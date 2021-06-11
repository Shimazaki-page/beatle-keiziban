@extends('layouts.app_layout')

@section('title')
    TOP
@endsection

@section('content')
    <div class="mx-auto" style="max-width: 700px; width: 100%">
        <div class="text-center m-5">
            <h1 class="mb-3">かぶとむし掲示板</h1>
            <form class="mb-5" method="get" action="{{route('search')}}">
                @csrf
                <div class="input-group" style="margin: 0 auto; max-width: 500px">
                    <input class="form-control" type="text" name="keyword">
                    <span class="input-group-append">
                          <button class="btn btn-secondary" type="submit">検索</button>
                    </span>
                </div>
            </form>
            <p class="h4">カテゴリー</p>
            <ul class="list-unstyled d-inline-flex ">
                @foreach($categories as $category)
                    <li class="mr-3">
                        <a href="{{route('category',[$category->id])}}">{{$category->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
