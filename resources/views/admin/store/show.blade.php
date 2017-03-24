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
    @foreach($userList as $userlist)
    <tr>
      <td>{{ $userlist->first_name }}{{ $userlist->last_name }}</td>
      <td><a class="btn btn-primary" href="">詳細</a></td>
    </tr>
    @endforeach()
  </tbody>
</table>
</div>
@endsection