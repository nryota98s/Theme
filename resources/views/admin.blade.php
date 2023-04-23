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

      <h1>投稿一覧</h1>

      <table class='admin-table'>

        <tr>

          <th>ユーザーネーム</th>

          <th>投稿内容</th>

          <th>投稿日時</th>

          <th></th>

          <th></th>

        </tr>

        @foreach ($list as $list)

        <tr>

          <td class="post_i">{{ $list->user_name }}</td>

          <td class="post_i">{{ $list->contents }}</td>

          <td class="post_i">{{ $list->created_at }}</td>

          <td><a class="fb follow" href="/admin/{{ $list->id }}/delete" onclick="return confirm('[{{ $list->contents }}]という投稿を削除してもよろしいでしょうか？')">削除</a></td>


        </tr>

        @endforeach

      </table>

    </div>

  </div>



  <footer>



  </footer>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>


</html>
