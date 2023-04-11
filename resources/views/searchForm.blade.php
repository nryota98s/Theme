<!DOCTYPE html>
<html lang="ja">
<head>

  <meta charset='utf-8"'>

  <link rel='stylesheet' href="{{ asset('/css/app.css') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

  <p><a href="/main">← mainへ</a></p>

  <h1>"{{ $keyword }}"の検索結果</h1>

  <table class='table table-hover tl'>

    <tr>

      <th>ユーザーネーム</th>

      <th></th>


    </tr>

    @if(!$items->isEmpty())
    @foreach ($items as $item)

    <tr>

      <td><a href="">{{ $item->name }}</a></td>

      <td>
        {{ $id }}
      </td>




    </tr>

    @endforeach
    @else
    <p>検索結果は０件です</p>
    @endif


  </table>


</body>
</html>
