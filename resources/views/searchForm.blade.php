<!DOCTYPE html>
<html lang="ja">
<head>

  <meta charset='utf-8"'>

  <link rel='stylesheet' href="{{ asset('/css/app.css') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

  <p><a href="/main">← mainへ</a></p>

  <h1 class="s_results">"{{ $keyword }}"の検索結果</h1>

  <table class='table table-hover tl'>


    @if(!$items->isEmpty())
    @foreach ($items as $item)

    <tr>

      <td><img class="icon" src="{{ asset('storage/icon/'.$item->image) }}" alt="プロフィール画像"></td>

      <td>
        <p>{{ $item->name }}</p>
      </td>


      <td>
        @if(count(array_intersect([$item->id],$id)) > 0)
        <button class="fb followed"><a href="/follow/{{ $item->id }}/delete" onclick="return confirm('[{{ $item->name }}]のフォローを外しますか？')">フォロー中</a></button>
        @else
        <button class="fb follow"><a href="/follow/{{ $item->id }}">フォローする</a></button>
        @endif
      </td>

    </tr>

    @endforeach
    @else
    <p class="s_results">検索結果は０件です</p>
    @endif


  </table>


</body>
</html>
