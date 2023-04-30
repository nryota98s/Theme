@extends('layouts.topapp')


@section('container')

<h2 class='page-header'>投稿内容を変更する</h2>
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>

{!! Form::open(['url' => '/post/update']) !!}
@csrf
<div class="form-group">

  {!! Form::hidden('id', $post->id) !!}

  {!! Form::input('text', 'upPost', $post->contents, ['required', 'class' => 'form-control']) !!}

</div>

<button type="submit" class="btn btn-primary pull-right">更新</button>

{!! Form::close() !!}

@endsection
