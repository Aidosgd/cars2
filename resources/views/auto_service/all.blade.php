@extends('layouts.app')
@section('head')
    <style>
        h1{
            font-size: 24px;
        }
    </style>
@endsection
@section('content') 
<h1>Все автосервисы</h1>
<ul class="auto_service_category">
    <li><a href="/auto_services/sto/1">СТО</a></li>
    <li><a href="/auto_services/azs/2">АЗС</a></li>
    <li><a href="/auto_services/avtomoyki/3">Автомойки</a></li>
    <li><a href="/auto_services/shinomontazhi/4">Шиномонтажи</a></li>
    <li><a href="/auto_services/prokat-avto/5">Прокат авто</a></li>
    <li><a href="/auto_services/avtostrakhovanie/6">Автострахование</a></li>
    <li><a href="/auto_services/avtosalony/7">Автосалоны</a></li>
    <li><a href="/auto_services/avtorazborki/8">Авторазборки</a></li>
</ul>
<div class="row selected-classifieds">
    <div class="col-md-12">
        <div id="ya_map" style="width: 100%; height: 400px; margin-bottom: 20px;"></div>
    </div>
    @foreach($result as $item)
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail" style="height: 240px;">
                <a href="/auto_services/{{ $item->autoServicesCategory->slug }}/{{ $item->autoServicesCategory->id }}/{{ $item->slug }}/{{ $item->id }}">
                    <img style="height: 179px;" src="/uploads/offers/small/{{ $item->getImage($item->id) }}" alt="{{ $item->title }}" />
                </a>
                <div class="caption" style="padding: 5px 0">
                    <h5><a href="/auto_services/{{ $item->autoServicesCategory->slug }}/{{ $item->autoServicesCategory->id }}/{{ $item->slug }}/{{ $item->id }}">{{ str_limit($item->title, 40)}}</a></h5>
                    <h5>{{ $item->reviewCount($item->id) }} <i class="fa fa-star"></i></h5>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-md-12">
        {{ $result->links() }}
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script>
        <?php
            $id = $app['request']->cookie('region-selected');
            if(!$id)
                $id = 1;
        ?>
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

        var autoServiceColor = '{ ' +
                '"1": "#37ae00",' +
                '"2": "#d60000",' +
                '"3": "#007ebd",' +
                '"4": "#767676",' +
                '"5": "#293991",' +
                '"6": "#009b6f",' +
                '"7": "#f64335",' +
                '"8": "#906090"' +
                ' }';
        autoServiceColor = JSON.parse(autoServiceColor);

        ymaps.ready(init);
        function init () {
            var myMap = new ymaps.Map("ya_map", {
                    center: regionCenters[{{ $id }}],
                    zoom: 12,
                    controls: ['zoomControl']
                });

            myMap.geoObjects
                    @foreach($maps as $item)
                    <?php $map = json_decode($item->map)  ?>
                        .add(new ymaps.Placemark([{{ $map->latitude }}, {{ $map->longitude }}], {
                            balloonContent: '<b><a href="/auto_services/{{ $item->autoServicesCategory->slug }}/{{ $item->autoServicesCategory->id }}/{{ $item->slug }}/{{ $item->id }}">{{ $item->title }}</a></b><br> \
                                {{ $item->reviewCount($item->id) }} <i class="fa fa-star"></i> <br>\
                                {{ $item->address }} <br>\
                                @foreach(json_decode($item->phone) as $phone)
                                    {{ $phone }} <br>\
                                @endforeach
                                '
                        },{
                            preset: "islands#dotCircleIcon",
                            // Задаем цвет метки (в формате RGB).
                            iconColor: autoServiceColor[{{  $item->auto_services_category_id }}]
                        }))
                    @endforeach
            ;
        }
    </script>
@endsection
