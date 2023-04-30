<!DOCTYPE html>

<html>


<head>

  <meta charset='utf-8"'>

  <link rel='stylesheet' href="{{ asset('/css/app.css') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<header>
  <a href="/main"> <img class="logo" src="{{ asset('storage/icon/logo.png') }}" alt="プロフィール画像"></a>

  <h3>＜＜管理者＞＞</h3>
  {{-- 権限がないページに入ろうとした場合の処理 --}}
  @if (session('USer_error'))
  <script>
    alert('{{ session('USer_error') }}');
  </script>
  @endif

</header>

<body>
  <div id="admin_main">

    <div class="menu">

      <img class="icon" src="{{ asset('storage/icon/'. Auth::user()->image) }}" alt="プロフィール画像">
      <p>管理者：{{ Auth::user()->name }}</p>

      <div>
        <ul>
          <li><a href="/admin">投稿一覧</a></li>
          <li><a href="/grant-admin">管理者権限</a></li>
          <li><a href="/pass-admin">パスワード管理</a></li>
          <li><a href="/logs">log管理</a></li>
          <li><a href="/telescope/requests">サーバー管理</a></li>
        </ul>
      </div>

    </div>



    <div class='admin_container'>

      <h1>@yield('title')</h1>


      @yield('content')

    </div>

  </div>



  <footer>



  </footer>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>


</html>
