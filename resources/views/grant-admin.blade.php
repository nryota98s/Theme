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

      <form action="/admin/{id}/grant" method="post">
        <select name="userid">
          @foreach ($list as $list)
          <option value="{{ $list->id }}">{{ $list->name }}</option>
          @endforeach
        </select>

        <?php  echo('<pre>');
var_dump($list->id);
echo('</pre>');?>

        @if ($list->is_idmin === 0)
        <p class="p-grant">を新たに管理者に追加する</p>
        <button type="submit" name="grant" value="true">権限付与</button>
        @else
        <p class="p-grant">を管理者から外す</p>
        <button type="submit" name="grant" value="false">権限解除</button>
        @endif

      </form>


      </table>

    </div>


    <footer>



    </footer>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>


</html>
