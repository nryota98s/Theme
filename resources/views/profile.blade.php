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
    {{-- 現在開いているページ主の名前 --}}
    <h2 class='page-header'>{{$name->name}}</h2>
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>

    <div class="icon_f">
      <img class="icon" src="{{ asset('storage/icon/'. $name->image) }}" alt="プロフィール画像">
      {{-- このマイページがログインしているユーザーのidと一緒なら表示 --}}
@if(Auth::check() && $name->id === Auth::user()->id)
      @if($name->bio == null)
      <p>プロフィールの変更から自己紹介を追加しましょう！</p>
      @else
      <p>{{ $name->bio }}</p>
      @endif

    </div>
    <a class="p_update" href="{{ url($name->id . '/prof-update') }}">プロフィールの変更</a>
@endif

 {{-- このマイページがログインしているユーザーのidと一致しない時表示 --}}
@if(Auth::check() && $name->id != Auth::user()->id)
  <p>{{ $name->bio }}</p>
@endif
    <div class="f_info">
      @php
      $user_id =$name->id;
      @endphp
      <a href="/{{$user_id}}/profile/following" class="f_number">{{$followingCount}}フォロー中</a>
      <a href=""></a>
      <a href="/{{$user_id}}/profile/followed" class="f_number">{{$followerCount}}フォロワー</a>
    </div>
  </div>

  <table class='table table-hover tl'>
     {{-- このマイページがログインしているユーザーのidと一緒なら表示 --}}
@if(Auth::check() && $name->id === Auth::user()->id)
    @if($postcheck== 0)
    <p class="alert">投稿をしてみましょう!</p>
    <p class="pull-right p_btn"><a class="btn btn-success" href="/create-form">投稿する</a></p>
    @endif
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
       {{-- このマイページがログインしているユーザーのidと一緒なら表示 --}}
@if(Auth::check() && $name->id === Auth::user()->id)
      <td class="post_b"><a class="btn btn-primary" href="/post/{{ $posts->id }}/update-form">更新</a></td>

      <td><a class="btn btn-danger" href="/post/{{ $posts->id }}/delete" onclick="return confirm('[{{ $posts->contents }}]という投稿を削除してもよろしいでしょうか？')">削除</a></td>
      @endif
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
