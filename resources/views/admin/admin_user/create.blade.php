@extends('partials.admin_nav')

@section('content')
<div class="container">
  <h2 class="page-header">管理者の作成</h2>
  {!! Form::open(['route' => 'admin.adminuser.store']) !!}
    {!! Form::label('last_name', '性'); !!}
    <div class="form-group {{ $errors->has('last_name')? 'has-error' : '' }}">
      {!! Form::input('text', 'last_name', old("name"), array('class' => 'form-control','placeholder' => '小松')) !!}
      <span class="help-block">{{ $errors->first('last_name') }}</span>
    </div>

    {!! Form::label('first_name', '名'); !!}
    <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}">
      {!! Form::input('text', 'first_name', old("name"), array('class' => 'form-control','placeholder' => '信之')) !!}
      <span class="help-block">{{ $errors->first('first_name') }}</span>
    </div>

    <div class="form-group {{ $errors->has('sex')? 'has-error' : '' }}">
      {!! Form::label('sex', '男性'); !!}
      {!! Form::radio('sex', '男', old("sex")) !!}
      {!! Form::label('sex', '女性'); !!}
      {!! Form::radio('sex', '女', old("sex")) !!}
      <span class="help-block">{{$errors->first('sex')}}</span>
    </div>

    <div class="form-group {{ $errors->has('birthday')? 'has-error' : '' }}">
      {!! Form::label('birthday', '生年月日'); !!}
      {!! Form::input('date', 'birthday', old("birthday"), array('class' => 'form-control')) !!}
      <span class="help-block">{{ $errors->first('birthday') }}</span>
    </div>

    <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
      {!! Form::label('email', 'メールアドレス'); !!}
      {!! Form::input('text', 'email', old("email"), array('class' => 'form-control','placeholder' => 'greenhorn@gizumo.com')) !!}
      <span class="help-block">{{$errors->first('email')}}</span>
    </div>

    <div class="form-group {{ $errors->has('tel')? 'has-error' : '' }}">
      {!! Form::label('tel', '電話番号'); !!}
      {!! Form::input('int', 'tel', old("tel"), array('class' => 'form-control','placeholder' => '03-3353-2720')) !!}
      <span class="help-block">{{$errors->first('tel')}}</span>
    </div>

    <div class="form-group {{ $errors->has('hire_date')? 'has-error' : '' }}">
      {!! Form::label('hire_date', '入社日'); !!}
      {!! Form::input('date', 'hire_date', old("hire_date"), array('class' => 'form-control')) !!}
      <span class="help-block">{{ $errors->first('hire_date') }}</span>
    </div>

    <div class="form-group">
      {!! Form::label('privileges', '管理者権限'); !!}
      <select name="privileges">
        <option value="1">SuperAdmin</option>
        <option value="2">Admin</option>
      </select>
    </div>

    <div class="form-group">
      {!! Form::label('privileges', 'アクセス権限'); !!}
      <label>
        ユーザー
      </label>
      {!! Form::checkbox('user_right') !!}
      <label>
        店舗
      </label>
      {!! Form::checkbox('store_right') !!}
    </div>

    <div class="form-group">
      <label>
        社員コード
      </label>
      {!! Form::text('position_code', '',
                      ['class' => 'form-control',
                      'placeholder' => '1から100の間の数字を記入してして下さい']) !!}
    </div>

    <div class="col-xs-12 col-md-offset-5">
      <a href="{{ route('admin.adminuser.index') }}" class="btn btn-primary">戻る</a>
      <button type="submit" class="btn btn-success pull-right">作成</button>
    </div>
  {!! Form::close() !!}
 </div>
@endsection
