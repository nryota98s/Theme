<!DOCTYPE html>

<html>


<head>

  <meta charset='utf-8"'>

  <link rel='stylesheet' href="{{ asset('/css/app.css') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<header>
  <a href="/main"> <img class="logo" src="{{ asset('storage/icon/logo.png') }}" alt="プロフィール画像"></a>

  @if(Auth::user()->isAdmin())
  <h3>＜＜管理者＞＞</h3>

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
        </ul>
      </div>


    </div>



    <div class='admin_container'>

      <h1>管理者権限管理</h1>


      <table class='table table-hover tl'>
        <tr>

          <th>ユーザーネーム</th>
          <th></th>

        </tr>

        @foreach ($list as $list)

        <tr>

          <td class="post_i">{{ $list->name }}</td>

          <td>
            <select name="" id="">
              <option value="">権限なし</option>
              <option value="">権限あり</option>
            </select>
          </td>

        </tr>

        @endforeach

      </table>

    </div>

    @else
    <h3>＜＜管理者権限がありません＞＞</h3>
    @endif


    <footer>



    </footer>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>


</html>
