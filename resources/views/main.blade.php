@extends('layouts.topapp')


@section('admin_error')
{{-- 権限がないページに入ろうとした場合 --}}
<p><a href="/admin">管理者ページ</a></p>

@if (session('admin_error'))
<script>
  alert('{{ session('admin_error') }}');
</script>
@endif
@endsection



@section('user_info')

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


@endsection



@section('container')

<p class="pull-right"><a class="btn btn-success" href="/create-form">投稿する</a></p>

<div class="saerch">
  <form action='/search-form'>
    @csrf
    <input class="search_box" type="text" name="keyword" placeholder="ユーザー検索">
    <button class="search_button" type="submit">検索</button>
  </form>
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

    <td class="post_i">{{ $list->updated_at }}</td>


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

      <p class="fing_i"><a href="{{ $users->id}}/profile">{{ $users->name }}</a></p>
      <p class="fing_i">{{ $users->bio }}</p>

      {{-- array_intersect() 関数は、2つ以上の配列の共通する値を返す（$id=現在フォロー中のユーザーid） --}}
      @if(count(array_intersect([$users->id],$id)) > 0)
      <p class="fb followed"><a href="/follow/{{ $users->id }}/delete" onclick="return confirm('[{{ $users->name }}]のフォローを外しますか？')">フォロー中</a></p>
      @else
      <p class="fb follow"><a href="/follow/{{ $users->id }}">フォローする</a></p>

      @endif
    </div>

  </div>

  @endforeach
</div>


@endsection
