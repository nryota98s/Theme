@extends('layouts.admin-app')

@section('title','投稿一覧')

@section('content')
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
@endsection
