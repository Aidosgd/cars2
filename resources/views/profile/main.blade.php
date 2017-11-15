@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="http://landata.dev">Главная</a></li>
        <li><a href="#">Добавить объявление</a></li>
    </ol>
    <h2>Настройки профиля</h2>
    @if (!empty($success))
        Пароль успешно поменяли!
    @endif

    @if (!empty($message))
        {{ $message }}
    @endif
    <hr>
    {!! Form::open(['method'=>'POST', 'files'=>true, 'role'=>'form']) !!}
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Информация профиля</h3>
        </div>
        <div class="panel-body">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label>Имя</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            </div>
            @if($user->social_type == null)
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>E-Mail</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email  }}">
                </div>
            @endif
        </div>
    </div>
    @if($user->social_type == null)
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Пароль</h3>
            </div>
            <div class="panel-body">
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>Old Password</label>
                    <input type="password" class="form-control" name="old_password">
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Аватар профиля</h3>
            </div>
            <div class="panel-body">
                @if($user->default_avatar)
                    <div class="img-preview">
                        <img class="thumbnail" src="/uploads/img/{{ $user->default_avatar }}" alt="ava">
                    </div>
                @endif
                <div class="form-group">
                    <label>Фото:</label>
                    {{ Form::file('default_avatar', ['class'=>'form-control', 'id' => 'files']) }}
                    <output id="result" />
                </div>
            </div>
        </div>
    @endif

    <div class="well">
        <p>Вы соглашаетесь с правилами использования сервиса, а также с передачей и обработкой выших данных в cars2.kz нажав кнопку сохранить.</p>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
    {!! Form::close() !!}
@endsection
