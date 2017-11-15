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
        <li><a href="#">Редактировать объявление</a></li>
    </ol>
    <h2>Редактировать объявление</h2>
    <p></p>
    @if (!empty($success))
        {{ $success }} {{ $name }}
    @endif
    <hr>
    {!! Form::model($offer, ['method'=>'POST', 'files'=>true, 'role'=>'form']) !!}
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Выбор категории</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                {!! Form::select('category', $categories->lists('title', 'id'), $offer->autoServicesCategory->id, ['required' => 'required', 'class' => 'form-control', 'id' => 'category']) !!}
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
                {!! Form::text('title', $offer->title, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group @if ($errors->has('description')) has-error @endif">
                <label>Подробное описание: @if ($errors->has('description')){!!$errors->first('description')!!}@endif</label>
                {!! Form::textarea('description', $offer->description, ['class'=>'form-control', 'id' => 'ckeditor']) !!}
            </div>
            <div class="form-group">
                <label>Сайт:</label>
                {!! Form::text('web_site', $offer->price, ['class'=>'form-control price']) !!}
            </div>
            <div class="form-lists defaults">
                <div class="hidden-block">

                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Картинки объявления</h3>
        </div>
        <div class="panel-body">
            @foreach($offer->images as $image)
                <div class="img-preview">
                    <img class="thumbnail" data-id="{{ $image->id }}" src="/uploads/offers/{{ $image->name }}" alt="thumbnail">
                    <button type="button" class="deleteImage">Удалить</button>
                    {{ Form::hidden('offer_images[]', $image->id, ['class'=>'form-control']) }}
                </div>
            @endforeach
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
                    <input type="text" name="phone[@{{ $index + 1 }}]" data-mask="phone" class="form-control phone" value="@{{ phone.value }}">
                    <a  class="close" style="margin-top: -28px; margin-right: 10px;" v-if="$index != 0" v-on:click="removePhone($index)"><i class="fa fa-close"></i></a>
                </div>
                <a v-on:click="addPhone($index)" style="cursor:pointer">Добавить номер</a>
            </div>

            <div class="form-group">
                <label>Город:</label>
                {!! Form::select('city', $cities->lists('name', 'id'), $offer->city->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Адрес:</label>
                {!! Form::text('address', $offer->address, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="map">Точка на карте</label>
                <div class="col-sm-10">
                    <div id="ya_map" style="width: 100%; height: 400px"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="col-sm-2">{!! Form::text('map[latitude]', $map->latitude, ['readonly ', 'class' => 'form-control latitude']) !!}</div>
                    <div class="col-sm-2">{!! Form::text('map[longitude]', $map->longitude, ['readonly ', 'class' => 'form-control longitude']) !!}</div>
                    <div class="col-sm-2">{!! Form::text('map[center]', $map->center, ['readonly ', 'class' => 'form-control map_center']) !!}</div>
                    <div class="col-sm-2">{!! Form::text('map[zoom]', $map->zoom, ['readonly ', 'class' => 'form-control map_zoom']) !!}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="well">
        {!! Form::submit('Сохранить', ['class' => 'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
@endsection
@section('scripts')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('#ckeditor').ckeditor(function () {

        },{
            toolbar:
                [
                    [ 'Font', 'FontSize', 'TextColor' ],
                    [ 'Bold', 'Italic', 'Underline', 'Strike' ],
                    [ 'JustifyLeft', 'JustifyCenter' ],
                    [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent' ],
                    [ 'PasteText', 'PasteFromWord' ]
                ]
        });
    </script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
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
                    @foreach(json_decode($offer->phone) as $phone)
                        <?php
                            $phone = preg_replace('/\s+/', '', $phone);
                            $phone = str_replace(['(', ')', '-', '+'], '', $phone);
                        ?>
                        {  value: {{ $phone }} },
                    @endforeach
                ],
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
        $('.deleteImage').on('click', function(){
            $(this).closest('.img-preview').remove();
        });

        ymaps.ready(init);
        var myMap;
        var myPlacemark = {};
        function init(){

            myMap = new ymaps.Map("ya_map", {
                center: {{ $map->center }},
                zoom: {{ $map->zoom }},
                controls: [ 'typeSelector','fullscreenControl']
            });

            searchControl = new ymaps.control.SearchControl({ provider: 'yandex#publicMap' });

            // добавляем панель на карту в нужную позицию
            myMap.controls.add(searchControl, { left: '40px', top: '10px' });

            myPlacemark = new ymaps.Placemark([{{ $map->latitude }}, {{ $map->longitude }}], { balloonContent: '{{ $offer->title }}' });

            myMap.geoObjects
                    .add(myPlacemark);

            myMap.setZoom({{ $map->zoom }});

            @if($target == 'update')
                    myPlacemark = new ymaps.Placemark({{ '['.$coords[0].','.$coords[1].']' }}, {

            });

            myMap.geoObjects
                    .add(myPlacemark);
            @endif


            searchControl.events.add('resultselect', function(){

                    myMap.geoObjects.removeAll();

                    var placemark = searchControl.getResultsArray()[searchControl.getSelectedIndex()];
                    var coords = placemark.geometry.getCoordinates();

                    $('.latitude').val(coords[0].toPrecision(6));
                    $('.longitude').val(coords[1].toPrecision(6));
                    $('.map_center').val('['+coords[0].toPrecision(6)+','+coords[1].toPrecision(6)+']');
                    $('.map_zoom').val(myMap.getZoom());
                }

            );




            myMap.events.add(['click'], function (e) {
                searchControl.hideResult();
                myMap.geoObjects.removeAll();

                var coords = e.get('coords');

                myPlacemark = new ymaps.Placemark(coords, {

                });

                myMap.geoObjects
                        .add(myPlacemark);

                $('.latitude').val(coords[0].toPrecision(6));
                $('.longitude').val(coords[1].toPrecision(6));
                $('.map_center').val('['+coords[0].toPrecision(6)+','+coords[1].toPrecision(6)+']');
                $('.map_zoom').val(myMap.getZoom());
            });

            myMap.events.add(['wheel'], function (e) {
                setTimeout( function(){$('.map_zoom').val(myMap.getZoom())}, 1000)
            });
        }
    </script>
@endsection