<header>
  {{-- <div class="container mx-0 px-0"> --}}
    <nav class="navbar navbar-expand-sm navbar-dark bg-info">
      <a href="/" class="navbar-brand" style="font-size: 20px;">QAQAQ</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="menu" class="collapse navbar-collapse">
        <ul class="navbar-nav">
          @if (Auth::check())
            <li class="nav-item"><a href="/makeQ" class="nav-link">質問作成</a></li>
            <li class="nav-item"><a href="/mypage" class="nav-link">マイページ</a></li>
            <li class="nav-item"><a href="/logout" class="nav-link">ログアウト</a></li>
          @else
            <li class="nav-item"><a href="/register" class="nav-link">新規登録</a></li>
            <li class="nav-item"><a href="/login" class="nav-link">ログイン</a></li>
          @endif
        </ul>
      </div>
    </nav>
  {{-- </div> --}}
</header>
