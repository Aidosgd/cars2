<?php
$currentRegion = null;
$id = $app['request']->cookie('region-selected');
if(isset($id)){
    $currentRegion = \App\Models\City::where('id', $id)->first();
}
?>
<div class="logo">
    <a href="{{ url('/') }}">
        <img src="/css/images/logo1.svg" alt="CZSale" title="CZSale" />
    </a>
</div>

<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#czsale-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="czsale-navbar">

        <a href="{{ url('/profile/addoffer') }}" class="btn btn-success navbar-btn navbar-left add-classified-btn" role="button">Добавить объявление</a>
        <a href="{{ url('/profile/add_auto_service') }}" class="btn btn-danger navbar-btn navbar-left" style="margin-left: 20px;" role="button">Добавить автосервис</a>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $currentRegion ? $currentRegion->name : 'Выбор города' }}  <b class="caret"></b></a>
                <ul id="cityCheck" class="dropdown-menu">
                    @foreach($regions as $city)
                        <li><a href="?region={{ $city->id }}">{{ $city->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ url('/register') }}">Регистрация</a></li>
                <li class="dropdown">
                    <a href="{{ url('/login') }}" class="dropdown-toggle" data-toggle="dropdown">Вход <b class="caret"></b></a>
                    <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form" role="form" method="POST" action="{{ url('/login') }}" accept-charset="UTF-8" id="login-nav">
                                        {!! csrf_field() !!}
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="sr-only" for="exampleInputEmail2">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label class="sr-only" for="exampleInputPassword2">Пароль</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Запомнить
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Забыли пароль?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="form-group">
                                <button onclick="location.href='/socialite/facebook'" class="btn btn-default btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i> Войти через Facebook</button>
                                {{--<button onclick="location.href='#'" class="btn btn-default btn-block btn-social btn-twitter"><i class="fa fa-twitter"></i> Sign in with Twitter</button>--}}
                                <button onclick="location.href='/socialite/vkontakte'" class="btn btn-default btn-block btn-social btn-vk"><i class="fa fa-vk"></i> Войти через VK</button>
                            </div>
                        </li>
                    </ul>
                </li>
            @else
            <li class="dropdown">
                <a href="{{ url('/profile') }}" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <b class="caret"></b></a>
                <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                    <li><a href="{{ url('/profile') }}"><i class="fa fa-btn"></i>Личный кабинет</a></li>
                    <li><a href="{{ url('/profile/addoffer') }}"><i class="fa fa-btn"></i>Добавить объявление</a></li>
                    <li><a href="{{ url('/profile/viewoffer') }}"><i class="fa fa-btn"></i>Мои объявление <span class="badge">{{ $offerCount }}</span></a></li>
                    <li><a href="{{ url('/profile/view_auto_service') }}"><i class="fa fa-btn"></i>Мои автосервисы <span class="badge">{{ $autoServiceCount }}</span></a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Выход</a></li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</nav>
<div class="bottom-nav">
    <ul>
        <li>
            <a href="/all_offers">
                Все объявлений <span class="label label-success">{{ $allOfferCount }}<span>
            </a>
        </li>
        <li>
            <a href="/all_auto_service">
                Все автосервисы <span class="label label-success">{{ $allAutoServiceCount }}<span>
            </a>
        </li>
    </ul>
</div>