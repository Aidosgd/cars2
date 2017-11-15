@extends('layouts.app')
@section('head')
    <style>
        .not-necessary{
            color: grey;
        }
    </style>
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Главная</a></li>
        <li><a href="#">Добавить объявление</a></li>
    </ol>
    <h2>Добавить объявление</h2>
    <p></p>
    @if (!empty($success))
        {{ $success }} {{ $name }}
    @endif
    <hr>
    {!! Form::open(['method'=>'POST', 'files'=>true, 'role'=>'form']) !!}
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Выбор категории</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <select class="form-control" name="category" id="category">
                        @foreach($categoriesGroup as $itemGroup)
                            <optgroup label="{{ $itemGroup->name }}">
                                @foreach($categories as $item)
                                    @if($item->category_group_id == $itemGroup->id)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Детали объявления</h3>
            </div>
            <div class="panel-body">
                <div class="form-group @if ($errors->has('title')) has-error @endif">
                    <label>Название товара: @if ($errors->has('title')){!!$errors->first('title')!!}@endif</label>
                    {!! Form::text('title', '', ['class'=>'form-control', 'oninvalid' => 'this.setCustomValidity("Укажите заголовок объявления")']) !!}
                </div>
                <div class="form-group @if ($errors->has('description')) has-error @endif">
                    <label>Подробное описание: @if ($errors->has('description')){!!$errors->first('description')!!}@endif</label>
                    {!! Form::textarea('description', '', ['class'=>'form-control', 'oninvalid' => 'this.setCustomValidity("Укажите описание объявления")' ]) !!}
                </div>
                <div class="form-group @if ($errors->has('price')) has-error @endif">
                    <label>Цена: @if ($errors->has('price')){!!$errors->first('price')!!}@endif</label>
                    {!! Form::text('price', '', ['class'=>'form-control price']) !!}
                </div>
                <div class="form-lists defaults">
                    <div class="hidden-block">

                    </div>
                </div>
                <div class="form-group">
                    <label>Подходит к машинам:</label>
                    <select class="form-control" name="vehicleBrand">
                        @foreach($vehicleBrand as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Состояние:</label>
                    <select class="form-control" name="condition">
                        @foreach($condition as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Картинки объявления</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Фото:</label>
                    Вы можете загрузить несколько фото выбрав кнопкой Ctrl
                    {{ Form::file('images[]', ['class'=>'form-control', 'id' => 'files', 'multiple']) }}
                    <output id="result" />
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Ваши персональные детали</h3>
            </div>
            <div class="panel-body">
                <div id="app" class="form-group @if ($errors->has('phone')) has-error @endif">
                    <label>Телефон: @if ($errors->has('phone')){!!$errors->first('phone')!!}@endif</label>
                    <div  v-for="phone in phones" style="margin-bottom: 5px;">
                        <input type="text" name="phone[@{{ $index + 1 }}]" data-mask="phone" class="form-control phone">
                        <a  class="close" style="margin-top: -28px; margin-right: 10px;" v-if="$index != 0" v-on:click="removePhone($index)"><i class="fa fa-close"></i></a>
                    </div>
                    <a v-on:click="addPhone($index)" style="cursor:pointer">Добавить номер</a>
                </div>
                <div class="form-group">
                    <label>Город:</label>
                    <select class="form-control" name="city" required>
                        @foreach($cities as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Адрес:</label>
                    {!! Form::text('address', '', ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>Доставка и отправка:</label>
                    <select class="form-control" name="delivery">
                        @foreach($delivery as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="well">
            <p>Вы соглашаетесь с правилами использования сервиса, а также с передачей и обработкой выших данных в cars2.kz нажав кнопку сохранить.</p>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    {!! Form::close() !!}
<div class="form-lists hidden" style="display: none">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="not-necessary">Производитель</label>
                {!! Form::text('manufacturer', '', ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="not-necessary">Код запчасти:</label>
                {!! Form::text('partnumber', '', ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>
<div class="form-lists" id="form80" style="display: none">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="not-necessary">Ширина профиля:</label>
                <select class="form-control" name="tireWidth">
                    @foreach($tireWidths as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="not-necessary">Высота профиля:</label>
                <select class="form-control" name="tireHeight">
                    @foreach($tireHeights as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="not-necessary">Диаметр:</label>
                <select class="form-control" name="diameter">
                    @foreach($diameters as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="not-necessary">Сезонность шин:</label>
                <select class="form-control" name="tireSeason">
                    @foreach($tireSeasons as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="not-necessary">Производитель:</label>
                <select class="form-control" name="tireBrand">
                    @foreach($tireBrands as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="form-lists" id="form81" style="display: none">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Диаметр:</label>
                <select class="form-control" name="diameter">
                    @foreach($diameters as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Тип дисков:</label>
                <select class="form-control" name="rimType">
                    @foreach($rimTypes as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Производитель:</label>
                {!! Form::text('manufacturer', '', ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Крепёжка (PCD):</label>
                <select class="form-control" name="rimPcd">
                    @foreach($rimPcds as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        {{--<div class="col-md-3">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Ширина обода (J):</label>--}}
                {{--<select class="form-control" name="rimWidth">--}}
                    {{--@foreach($rimWidths as $item)--}}
                     {{--<option value="{{ $item->id }}">{{ $item->name }}</option>--}}
                    {{--@endforeach--}}
                 {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Вылет (ЕТ):</label>--}}
                {{--<select class="form-control" name="rimEt">--}}
                    {{--@foreach($rimEts as $item)--}}
                        {{--<option value="{{ $item->id }}">{{ $item->name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Диаметр ступицы (DIA):</label>--}}
                {{--<select class="form-control" name="rimDia">--}}
                    {{--@foreach($rimDias as $item)--}}
                        {{--<option value="{{ $item->id }}">{{ $item->name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}

    </div>
</div>
<div class="form-lists" id="form82" style="display: none">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Ширина профиля:</label>
                <select class="form-control" name="tireWidth">
                    @foreach($tireWidths as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Высота профиля:</label>
                <select class="form-control" name="tireHeight">
                    @foreach($tireHeights as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Диаметр:</label>
                <select class="form-control" name="diameter">
                    @foreach($diameters as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Сезонность шин:</label>
                <select class="form-control" name="tireSeason">
                    @foreach($tireSeasons as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Производитель:</label>
                <select class="form-control" name="tireBrand">
                    @foreach($tireBrands as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Тип дисков:</label>
                <select class="form-control" name="rimType">
                    @foreach($rimTypes as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{--<div class="col-md-3">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Ширина обода (J):</label>--}}
                {{--<select class="form-control" name="rimWidth">--}}
                    {{--@foreach($rimWidths as $item)--}}
                        {{--<option value="{{ $item->id }}">{{ $item->name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Крепёжка (PCD):</label>
                <select class="form-control" name="rimPcd">
                    @foreach($rimPcds as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Производитель дисков:</label>
                {!! Form::text('manufacturer', '', ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        {{--<div class="col-md-4">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Вылет (ЕТ):</label>--}}
                {{--<select class="form-control" name="rimEt">--}}
                    {{--@foreach($rimEts as $item)--}}
                        {{--<option value="{{ $item->id }}">{{ $item->name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Диаметр ступицы (DIA):</label>--}}
                {{--<select class="form-control" name="rimDia">--}}
                    {{--@foreach($rimDias as $item)--}}
                        {{--<option value="{{ $item->id }}">{{ $item->name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>
@endsection
@section('scripts')
    <script>
        function setMask() {
            $('[data-mask="phone"]').inputmask({
                mask: '+7 (799) 999-99-99'
            });
        }
        new Vue({
            el: '#app',
            data: {
               phones: [
                   {}
               ]
           },
            methods: {
                addPhone: function () {
                    this.phones.push({});
                    setTimeout(setMask, 0);
                },
                removePhone: function(index){
                    this.phones.splice(index, 1);
                }
            }
        });
        setMask();
        $('.price').maskMoney({thousands:'', allowZero:false, precision:0,});
//        $('.phone').inputmask("+7 (799) 999-99-99");
        $("#category")
            .change(function() {
                var str = "";
                $( "#category option:selected" ).each(function() {
                    str += $( this ).val() + " ";
                });
                var hiddenForm = $('#form'+str).html();
                $('form .form-lists.defaults .hidden-block *').remove();
                if (hiddenForm){
                    var formPlace = $('.hidden-block');
                    formPlace.html(hiddenForm);
                } else {
                    hiddenForm = $('.form-lists.hidden').html();
                    var formPlace = $('.hidden-block');
                    formPlace.html(hiddenForm);
                }
            })
        .trigger( "change" );
    </script>
@endsection