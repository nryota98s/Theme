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

    <tr>

      <th>ユーザーネーム</th>

      <th></th>


    </tr>

    @if(!$items->isEmpty())
    @foreach ($items as $item)

    <tr>

      <td><a href="f_name">{{ $item->name }}</a></td>

      <td>
        @if(count(array_intersect([$item->id],$id)) > 0)
        <p class="followed">フォロー中</p>
        @else
        <p class="follow">フォローする</p>
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
