@extends('layouts.topapp')

@section('container')
<h2 class='page-header'>新しく投稿をする</h2>
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>

{!! Form::open(['url' => 'post/create']) !!}
@csrf
<div class="form-group">
  {!! Form::hidden('hidden', 'user_id',Auth::user()->user_id, ) !!}

  {!! Form :: input ( ' text ' , ' name ' ,Auth :: user () -> name , [ ' required ' , ' class ' => [ ' form-control ' , ' form_n ' ], ' placeholder ' => 'ユーザー名' ]) !!}

  {!! Form::input('text', 'newPost', null, ['required', 'class' => ['form-control','form_p'], 'placeholder' => '投稿内容']) !!}

</div>

<button type="submit" class="btn btn-success pull-right s_btn">追加</button>

{!! Form::close() !!}
@endsection
