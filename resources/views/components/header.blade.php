<header class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{route('top')}}">かぶとむし掲示板</a>
        <form method="get" action="{{route('search')}}">
            <div class="input-group">
                <input class="form-control" type="text" name="keyword">
                <span class="input-group-append">
                  <button class="btn btn-secondary" type="submit">検索</button>
                </span>
            </div>
        </form>
        @auth
            <div class="navbar-nav">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
                    {{ __('ログアウト') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @endauth
    </div>
</header>
