@extends('layouts.admin-app')

@section('title','パスワード管理')

@section('content')

<form action="/passup-admin">
  @csrf
  <label for="user_id">ユーザーを選択してください：</label>
  <select name="user_id" id="user_id">
    @foreach ($list as $list)
    <option value="{{ $list->id }}">{{ $list->name }}</option>
    @endforeach
  </select>
  <br><br>
  <button type="submit">パスワード変更</button>
</form>

@endsection
