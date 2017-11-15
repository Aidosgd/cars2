@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Главная</a></li>
        <li><a href="#">Обратная связь</a></li>
    </ol>
    <h2>Обратная связь</h2>
    @if (Session::has('message'))
        <p class="bg-info" style="padding: 10px">
            {{ Session::get('message') }}
        </p>
    @endif
    {!! Form::model(['method'=>'POST', 'action' => '/feedback', 'role'=>'form']) !!}
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Вы можете написать нам если у вас есть предложения или просьбы мы вам обязательно ответим!</h3>
        </div>
        <div class="panel-body">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label>Имя</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label>E-Mail</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                <label>Сообщение</label>
                <textarea class="form-control"  name="message" id="" cols="30" rows="10"></textarea>
                @if ($errors->has('message'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                @endif
            </div>
        </div>
    </div>
    <div class="well">
        {!! Form::submit('Отправить', ['class' => 'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
@endsection
