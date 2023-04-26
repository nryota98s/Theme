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
        </ul>
      </div>


    </div>



    <div class='admin_container'>
      {{-- パスワードのエラーがあった際にエラーを表示 --}}
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      {{-- パスワードのエラーがあった際にエラーを表示 --}}
      <div class='container'>
        @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
        @endif

        @if (session('USer_error'))

        <h2 class="page-header">{{ session('USer_error') }}</h2>


        @endif
        {{-- 処理が成功した際に表示 --}}

        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
        <h2 class='page-header'>パスワードを変更する</h2>

        <p>ユーザー名</p>
        <p>{{ $post->name}}</p>

        <form action="/pass/reset" method="post">
          @csrf
          <div class="form-group">

            <input type="hidden" name="id" id="{{ $post->id }}">

            <div class="icon_f">
              <p>新しいパスワード</p>
              <input type="password" class="i-control" name="new_password" required>
              <p>新しいパスワード 再入力</p>
              <input type="password" class="i-control" name="new_password_confirmation" required>
            </div>

          </div>

          <button type="submit" class="btn btn-primary pull-right">変更</button>

        </form>

      </div>

    </div>

  </div>

  <footer>



  </footer>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>
