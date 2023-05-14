@extends('layouts.admin-app')

@section('title','パスワードを変更する')

@section('content')

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

  <p>ユーザー名</p>
  <p>{{ $post->name}}</p>

  <form action="/pass/reset" method="post">
    @csrf
    <div class="form-group">

      <input type="hidden" name="id" value="{{ $post->id }}">

      <div class="icon_f">
        <p>新しいパスワード</p>
        <input type="password" class="i-control" name="new_password" required>
        <p>新しいパスワード 再入力</p>
        <input type="password" class="i-control" name="new_password_confirmation" required>
      </div>

    </div>

    <button type="submit" class="btn btn-primary pull-right">変更</button>

  </form>

</div>

@endsection
