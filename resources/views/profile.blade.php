<!DOCTYPE html>


<html>


<head>

  <meta charset='utf-8"'>

  <link rel='stylesheet' href='/css/app.css'>

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<body>




  <div class='container'>
    <a href="http://127.0.0.1:8000/main"></a>
    <h2 class='page-header'>{{Auth::user()->name}}</h2>
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>

    <div class="icon_f">
      <img class="icon" src="{{ asset('storage/icon/'. Auth::user()->image) }}" alt="プロフィール画像">

      @if(Auth::user()->bio == null)
      <p>プロフィールの変更から自己紹介を追加しましょう！</p>
      @else
      <p>{{ Auth::user()->bio }}</p>
      @endif

    </div>
    <a class="p_update" href="{{ url(auth()->user()->id . '/prof-update') }}">プロフィールの変更</a>


    <div class="f_info">
      @php
      $user_id =Auth::user()->id;
      @endphp
      <a href="/{{$user_id}}/profile/following" class="f_number">{{$followingCount}}フォロー中</a>
      <a href=""></a>
      <a href="/{{$user_id}}/profile/followed" class="f_number">{{$followerCount}}フォロワー</a>
    </div>
  </div>

  <table class='table table-hover tl'>

    @if($postcheck== 0)
    <p class="alert">投稿をしてみましょう!</p>
    <p class="pull-right p_btn"><a class="btn btn-success" href="/create-form">投稿する</a></p>
    @endif

    <a class="top_btn" href="/main">mainへ戻る</a>

    <tr>

      <th>ユーザーネーム</th>

      <th>投稿内容</th>

      <th>投稿日時</th>
      <th></th>
      <th></th>
    </tr>


    @foreach ($posts as $posts)

    <tr>

      <td class="post_i">{{ $posts->user_name }}</td>

      <td class="post_i">{{ $posts->contents }}</td>

      <td class="post_i">{{ $posts->created_at }}</td>

      <td class="post_b"><a class="btn btn-primary" href="/post/{{ $posts->id }}/update-form">更新</a></td>

      <td><a class="btn btn-danger" href="/post/{{ $posts->id }}/delete" onclick="return confirm('[{{ $posts->contents }}]とゆう投稿を削除してもよろしいでしょうか？')">削除</a></td>
    </tr>

    @endforeach

  </table>

  </div>



  <footer>



  </footer>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>


</html>
