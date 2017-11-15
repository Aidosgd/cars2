@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Главная</a></li>
        <li><a href="#">Добавить автосервис</a></li>
    </ol>
    <h2>Добавить автосервис</h2>
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
                    @foreach($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Детали автосервиса</h3>
        </div>
        <div class="panel-body">
            <div class="form-group @if ($errors->has('title')) has-error @endif">
                <label>Название автосервиса: @if ($errors->has('title')){!!$errors->first('title')!!}@endif</label>
                {!! Form::text('title', '', ['class'=>'form-control', 'oninvalid' => 'this.setCustomValidity("Укажите заголовок объявления")']) !!}
            </div>
            <div class="form-group @if ($errors->has('description')) has-error @endif">
                <label>Подробное описание: @if ($errors->has('description')){!!$errors->first('description')!!}@endif</label>
                {!! Form::textarea('description', '', ['class'=>'form-control', 'id' => 'ckeditor', 'oninvalid' => 'this.setCustomValidity("Укажите описание объявления")' ]) !!}
            </div>
            <div class="form-group">
                <label>Сайт:</label>
                {!! Form::text('web_site', '', ['class'=>'form-control']) !!}
            </div>
            {{--<div class="form-lists defaults">--}}
                {{--<div class="hidden-block">--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label>Режим работы</label>--}}
                {{--<select class="form-control" name="mode_operation">--}}
                    {{--@foreach($modeOperation as $item)--}}
                        {{--<option value="{{ $item->id }}">{{ $item->title }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label>Типы мойки</label>--}}
                {{--<select class="form-control" name="washing_type">--}}
                    {{--@foreach($washingType as $item)--}}
                        {{--<option value="{{ $item->id }}">{{ $item->title }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Картинки автосервиса</h3>
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
            <h3 class="panel-title">Контакты автосервиса</h3>
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
                <select id="city" class="form-control" name="city" required>
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
                <label class="col-sm-2 control-label" for="map">Точка на карте</label>
                <div class="col-sm-10">
                    <div id="ya_map" style="width: 100%; height: 400px"></div>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="col-sm-2">{!! Form::hidden('map[latitude]', null, ['readonly ', 'class' => 'form-control latitude']) !!}</div>
                    <div class="col-sm-2">{!! Form::hidden('map[longitude]', null, ['readonly ', 'class' => 'form-control longitude']) !!}</div>
                    <div class="col-sm-2">{!! Form::hidden('map[center]', null, ['readonly ', 'class' => 'form-control map_center']) !!}</div>
                    <div class="col-sm-2">{!! Form::hidden('map[zoom]', null, ['readonly ', 'class' => 'form-control map_zoom']) !!}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="well">
        <p>Вы соглашаетесь с правилами использования сервиса, а также с передачей и обработкой выших данных в cars2.kz нажав кнопку сохранить.</p>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </div>
    {!! Form::close() !!}
    {{--<div class="form-lists hidden" style="display: none">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="form-group">--}}
                    {{--<label>Специализирующиеся на марке:</label>--}}
                    {{--<select class="form-control selectpicker" name="vehicleBrand" multiple>--}}
                        {{--@foreach($vehicleBrand as $item)--}}
                            {{--<option value="{{ $item->id }}">{{ $item->name }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
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
        var regionCenters = '{ ' +
                '"1": [43.237282, 76.884192],' +
                '"2": [51.128422, 71.430564],' +
                '"3": [43.635379, 51.169135],' +
                '"4": [50.300411, 57.154636],' +
                '"5": [47.106719, 51.90313],' +
                '"6": [45.622546, 63.317654],' +
                '"7": [47.800225, 67.713605],' +
                '"8": [49.806406, 73.085485],' +
                '"9": [53.284635, 69.377554],' +
                '"10": [53.214917, 63.631031],' +
                '"11": [44.83986, 65.50268],' +
                '"12": [52.285577, 76.940947],' +
                '"13": [54.865472, 69.135602],' +
                '"14": [52.964443, 63.133383],' +
                '"15": [50.416526, 80.25617],' +
                '"16": [45.017958, 78.383794],' +
                '"17": [42.901183, 71.378309],' +
                '"18": [50.058825, 72.959047],' +
                '"19": [51.212184, 51.367069],' +
                '"20": [42.317301, 69.589709],' +
                '"21": [51.729692, 75.32662]' +
                ' }';
        regionCenters = JSON.parse(regionCenters);
        $("#city")
            .change(function() {
                var str = $( this ).val();
                showMap('', str);
            });
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

        var myMap = null;
        var showMap = null;

        var cities = {!! json_encode($cities)!!};

        showMap = function(unknown, id, center_id){
            if(!myMap)
                myMap = new ymaps.Map("ya_map", {
                    center: [48.5600, 67.6266],
                    zoom: 15,
                });
            var $id = id || '{{ $cities ->first()->id }}';

            myMap.geoObjects.removeAll();

            var city = '';
            for(var index in cities)
            {
                if(cities[index].id == $id)
                    city = cities[index];
            }
            myMap.setCenter(regionCenters[$id], 10);

            searchControl = new ymaps.control.SearchControl({ provider: 'yandex#publicMap' });

            // добавляем панель на карту в нужную позицию
            myMap.controls.add(searchControl, { left: '40px', top: '10px' });

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
        };
        ymaps.ready(showMap);
    </script>
@endsection