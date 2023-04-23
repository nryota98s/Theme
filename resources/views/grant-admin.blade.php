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
          <li><a href="pass-admin">パスワード管理</a></li>
          <li><a href="/logs">log管理</a></li>
        </ul>
      </div>


    </div>



    <div class='admin_container'>

      <h1>管理者権限</h1>

      <table class='table table-hover tl'>

        <tr>

          <th>ユーザーネーム</th>
          <th>ステータス</th>
          <th></th>

        </tr>

        @foreach ($list as $list)

        <tr>

          <td class="post_i">{{ $list->name }}</td>
          @if((int)$list->is_admin === 0)
          <td class="post_i">
            <p>社員</p>
          </td>
          <td><a class="fb follow" href="/admin/{{ $list->id }}/grant" onclick="return confirm('[{{ $list->name }}]に権限付与しますか？')">付与</a></td>
          @else
          <td class="post_i">
            <p>管理者</p>
          </td>
          <td><a class="fb followed" href="/admin/{{ $list->id }}/grant" onclick="return confirm('[{{ $list->name }}]の権限を解除しますか？')">解除</a></td>
          @endif
          </td>


        </tr>

        @endforeach

      </table>


    </div>


    <footer>



    </footer>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>


</html>
