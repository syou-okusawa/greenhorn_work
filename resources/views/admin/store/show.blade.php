@extends('partials.admin_nav')

@section('content')
<div class="container">
<h2 class="page-header">{{ $store->name }}</h2>
<p class="pull-right"><a href="./">一覧に戻る</a></p>
<table class="table table-hover todo-table">
  <thead>
  <tr>
    <th>研修生一覧</th>
    <th></th>
  </tr>
</thead>
  <tbody>
    @foreach($userList as $user)
    <tr>
      <td>{{ $user->first_name }}{{ $user->last_name }}</td>
      <td><a class="btn btn-primary" href="{{ route('user.edit', $user->id) }}">詳細</a></td>
    </tr>
    @endforeach()
  </tbody>
</table>
</div>
@endsection
