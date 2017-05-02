@extends('partials.user_nav')

@section('content')
    <h2 class="page-header header-gradient">勤務表アップロード</h2>
  <div class="panel-body">
    {!! Form::open(['url' => 'schedule', 'method' => 'post', 'files' => 'true']) !!}
      <div class="form-group {{ Session::has('flash_message') ? 'has-error' :'' }}">
        <div class="col-xs-2">
          {!! Form::selectRange('year', date('Y')-10, date('Y')+10, old('year'), ['class' => 'form-control', 'placeholder'=>'年']) !!}
        </div>
        <span class="help-block">{{ $errors->first('year') }}</span>
      </div>
      <div class="form-group {{ Session::has('flash_message') ? 'has-error' :'' }}">
        <div class="col-xs-2">
          {!! Form::selectRange('month', 1, 12, old('month'), ['class' => 'form-control', 'placeholder'=>'月']) !!}
        </div>
        <span class="help-block">{{ $errors->first('month') }}</span>
      </div>
      <span class="help-block">※ファイルを選択ボタンを押して勤務表をアップロードして下さい！</span>
      @if (Session::has('flash_message'))
        <div class="has-error">
          <span class="help-block">{{ Session('flash_message') }}</span>
        </div>
      @endif
      <div class="form-group {{ $errors->has('schedule') ? 'has-error' :'' }}">
        {!! Form::file('schedule', ['required' => 'required']) !!}
        <span class="help-block">{{ $errors->first('schedule') }}</span>
      </div>
      <div class="button-wrapper">
      <button type="submit" class="btn btn-success">アップロード</button>
      </div>
    {!! Form::close() !!}
  </div>
  </div>
</div>
<div class="button-wrapper">
    <a href="{{ route('schedule.index') }}" class="bottom-button">勤務表一覧画面へ</a>
</div>
@endsection
