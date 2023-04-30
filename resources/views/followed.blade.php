@extends('layouts.prof-app')

@section('container')

<h2>フォロー中のユーザー</h2>
@foreach ($list as $list)


<div class="fing_info">

  <img class="icon" src="{{ asset('storage/icon/'.$list->image) }}" alt="プロフィール画像">
  <div class="fing_nb">

    <p class="fing_i">{{ $list->name }}</p>

    <p class="fing_i">{{ $list->bio }}</p>
    <p>フォローする</p>
  </div>

</div>


@endforeach
@if(empty($list))
<p>フォロワーはいません</p>
@endif
{{--フォロワーの投稿一覧 --}}
<table class='table table-hover tl'>
  <h2>フォロワーの投稿一覧</h2>
  <tr>

    <th>ユーザーネーム</th>

    <th>投稿内容</th>

    <th>投稿日時</th>

  </tr>

  @foreach ($post as $post)

  <tr>

    <td class="post_i">{{ $post->user_name }}</td>

    <td class="post_i">{{ $post->contents }}</td>

    <td class="post_i">{{ $post->created_at }}</td>


  </tr>

  @endforeach

</table>

@endsection
