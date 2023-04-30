@extends('layouts.admin-app')

@section('title','管理者権限')

@section('content')

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

@endsection
