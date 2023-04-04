<!DOCTYPE html>

<html>


<head>

<meta charset='utf-8"'>

<link rel='stylesheet' href='/css/app.css'>

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<body>


<header>

<h1 class='page-header'>Laravelを使った投稿機能の実装</h1>

</header>

<div class='container'>

<h2 class='page-header'>新しく投稿をする</h2>
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>

{!! Form::open(['url' => 'post/create']) !!}

<div class="form-group">

{!! Form::input('text', 'name',Auth::user()->name, ['required', 'class' => 'form-control', 'placeholder' => 'ユーザーネーム']) !!}
{!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}

</div>

<button type="submit" class="btn btn-success pull-right">追加</button>

{!! Form::close() !!}

</div>

<footer>



</footer>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>


</html>
