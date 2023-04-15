<!DOCTYPE html>

<html>


<head>

  <meta charset='utf-8"'>

  <link rel='stylesheet' href="{{ asset('/css/app.css') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<body>


  <header>
<a href="/main"> <img class="logo" src="{{ asset('storage/icon/logo.png') }}" alt="プロフィール画像"></a>
  </header>
  <div class="user_info">
    <img class="icon" src="{{ asset('storage/icon/'. Auth::user()->image) }}" alt="プロフィール画像">
    <li class="nav-item dropdown user_name">
      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ Auth::user()->id}}/profile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }}
      </a>

      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">{{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </div>
    </li>
  </div>




  <div class='container'>


    <p class="pull-right"><a class="btn btn-success" href="/create-form">投稿する</a></p>

    <div class="saerch">
      {!! Form::open(['url'=>'/search-form']) !!}
      {!! Form::text('keyword',null,['placeholder'=>'ユーザー検索','class'=>'search_box']) !!}
      {!! Form::submit('検索',['class'=>'search_button']) !!}
      {!! Form::close() !!}
    </div>




    <table class='table table-hover tl'>

      <tr>

        <th>ユーザーネーム</th>

        <th>投稿内容</th>

        <th>投稿日時</th>

      </tr>

      @foreach ($list as $list)

      <tr>

        <td class="post_i">{{ $list->user_name }}</td>

        <td class="post_i">{{ $list->contents }}</td>

        <td class="post_i">{{ $list->created_at }}</td>




      </tr>

      @endforeach

    </table>
    {{--現在サービスを利用しているユーザー一覧--}}
    <div class="user_list">
      <h2>現在サービスを利用しているユーザー一覧</h2>

      @foreach ($users as $users)


<div class="fing_info">

  <img class="icon" src="{{ asset('storage/icon/'.$users->image) }}" alt="プロフィール画像">
<div class="fing_nb">

<p class="fing_i">{{ $users->name }}</p>
<p class="fing_i">{{ $users->bio }}</p>

   @if(count(array_intersect([$users->id],$id)) > 0)
        <p class="followed">フォロー中</p>
        @else
        <p class="follow">フォローする</p>

        @endif
</div>

</div>

@endforeach
    </div>


  </div>

  <footer>



  </footer>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>


</html>
