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
{{-- パスワードのエラーがあった際にエラーを表示 --}}
  	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
  {{-- パスワードのエラーがあった際にエラーを表示 --}}
<div class='container'>
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('USer_error'))

<h2 class="page-header">{{ session('USer_error') }}</h2>


@endif
{{-- 処理が成功した際に表示 --}}

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h2 class='page-header'>パスワードを変更する</h2>

<p>ユーザー名</p>
<p>{{ $post->name}}</p>
{!! Form::open(['url' => '/pass/update']) !!}
@csrf
<div class="form-group">

{!! Form::hidden('id', $post->id) !!}

<div class="icon_f">
  <p>新しいパスワード</p>
   {!! Form::password('new_password', ['required' => 'required', 'class' => 'i-control']) !!}
   <p>新しいパスワード 再入力</p>
   {!! Form::password('new_password_confirmation', ['required' => 'required', 'class' => 'i-control']) !!}

  <p>古いパスワード</p>
{{Form::password('password', ['required','class' => 'i-control'])}}
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
