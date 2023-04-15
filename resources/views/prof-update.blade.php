<!DOCTYPE html>


<html>


<head>

<meta charset='utf-8"'>

<link rel='stylesheet' href='/css/app.css'>

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<header>
  <a href="/main"> <img class="logo" src="{{ asset('storage/icon/logo.png') }}" alt="プロフィール画像"></a>
</header>

<body>


<header>



</header>

<div class='container'>

<h2 class='page-header'>ユーザー情報を変更する</h2>
{{-- パスワードのエラーがあった際にエラーを表示 --}}
@if (session('error'))


{{ session('error') }}

@endif
{{--'enctype':ファイルを含むフォームデータをサーバーに送信するために使用されるもの。 --}}
{!! Form::open(['url' => '/profile/update', 'enctype' => 'multipart/form-data']) !!}

<div class="form-group">

{!! Form::hidden('id', $post->id) !!}
<p>ユーザー名</p>
{!! Form::input('text', 'upName', $post->name, ['required', 'class' => 'form-control']) !!}

<p>自己紹介文</p>
{!! Form::input('text', 'upBio', $post->bio, ['required', 'class' => 'form-control']) !!}
<div class="icon_f">
  <p>アイコン画像</p>
  <img class="old_icon" src="{{ asset('storage/icon/'. Auth::user()->image) }}" alt="プロフィール画像">
  {{ Form::file('image', ['class' => 'i-control']) }}
  <p>パスワード</p>
{{Form::password('password', ['class' => 'i-control'])}}
</div>

</div>

<button type="submit" class="btn btn-primary pull-right">更新</button>

{!! Form::close() !!}

</div>

<footer>



</footer>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>


</html>
