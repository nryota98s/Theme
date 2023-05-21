@extends('layouts.topapp')

@section('container')
<h1 class="s_results">"{{ $keyword }}"の検索結果</h1>

<table class='table table-hover tl'>

  @if(preg_match($pattern, $keyword)||$items->count() === 0)
  <h2 class="s_results">検索結果は０件です</h2>

  @elseif($items->count()>0)
  @foreach ($items as $item)

  <tr>

    <td><img class="icon" src="{{ asset('storage/icon/'.$item->image) }}" alt="プロフィール画像"></td>

    <td>
      <p><a href="{{ $item->id}}/profile">{{ $item->name }}</a></p>
    </td>


    <td>
      @if(count(array_intersect([$item->id],$id)) > 0)
      <p class="fb followed"><a href="/follow/{{ $item->id }}/delete" onclick="return confirm('[{{ $item->name }}]のフォローを外しますか？')">フォロー中</a></p>
      @else
      <p class="fb follow"><a href="/follow/{{ $item->id }}">フォローする</a></p>
      @endif
    </td>

  </tr>

  @endforeach

  @endif


</table>
@endsection
