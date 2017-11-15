@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Главная</a></li>
        <li><a href="#">Вход</a></li>
    </ol>
    <h2>Вход</h2>
    @if(Session::has('alert-danger'))
        <p class="alert alert-danger">{{ Session::get('alert-danger') }}</p>
    @endif
    {!! Form::model(['method'=>'POST', 'action' => '/login', 'role'=>'form']) !!}
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Введите email и пароль</h3>
        </div>
        <div class="panel-body">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label>E-Mail</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label>Пароль</label>
                <input type="password" class="form-control" name="password">

                @if ($errors->has('password'))
                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Запомнить
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="well">
        {!! Form::submit('Вход', ['class' => 'btn btn-success']) !!}
        <a class="btn btn-link" href="{{ url('/password/reset') }}">Забыли пароль?</a>
        <a class="btn btn-link" href="{{ url('/register') }}">Регистрация</a>
    </div>
    {!! Form::close() !!}
@endsection
