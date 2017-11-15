@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Главная</a></li>
        <li><a href="#">{{ isset($category) ? $category->title : 'Все'}}</a></li>
    </ol>
    <h1>{{ isset($category) ? $category->title : 'Все' }}</h1>
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
    @if (Session::has('message'))
        <p class="bg-info" style="padding: 10px">
            {{ Session::get('message') }}
        </p>
    @endif
    <hr>
    <div class="row classifieds-table">
        <div class="col-md-12">
            <div id="ya_map" style="width: 100%; height: 400px; margin-bottom: 20px;"></div>
        </div>
        <div class="col-lg-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Объявление</th>
                    <th class="text-center">Опубликовано</th>
                </tr>
                </thead>
                <tbody>
                @forelse($result as $offer)
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="/auto_services/{{$category_name}}/{{ $category->id }}/{{ $offer->slug }}/{{ $offer->id }}">
                                    <img class="media-object" src="/uploads/offers/small/{{ $offer->getImage($offer->id) }}" style="width: 72px; height: 72px;" alt="{{ $offer->title }}">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="/auto_services/{{$category_name}}/{{ $category->id }}/{{ $offer->slug }}/{{ $offer->id }}">{{ $offer->title }} {{ $offer->reviewCount($offer->id) }} <i class="fa fa-star"></i></a></h4>
                                    <p><small>{{ strip_tags(str_limit($offer->description, 120)) }}</small></p>
                                    <p><small>{{ $offer->city->name }}</small></p>
                                </div>
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">{{ $offer->created_at->format('d.m.Y G:i') }}</td>
                    </tr>
                @empty
                    Пока у нас нет объявлении
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {!! $result->links() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script>
        <?php
        $id = $app['request']->cookie('region-selected');
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

        ymaps.ready(init);
        function init () {
            var myMap = new ymaps.Map("ya_map", {
                center: regionCenters[{{ $id }}],
                zoom: 12,
                controls: ['zoomControl']
            });

            myMap.geoObjects
            @foreach($maps as $item)
            <?php  $map = json_decode($item->map)  ?>
                .add(new ymaps.Placemark([{{ $map->latitude }}, {{ $map->longitude }}], {
                balloonContent: '<b><a href="/auto_services/{{ $item->autoServicesCategory->slug }}/{{ $item->autoServicesCategory->id }}/{{ $item->slug }}/{{ $item->id }}">{{ $item->title }}</a></b><br> \
                                {{ $item->reviewCount($item->id) }} <i class="fa fa-star"></i> <br>\
                                {{ $item->address }} <br>\
                                @foreach(json_decode($item->phone) as $item)
                        {{ $item }} <br>\
                                @endforeach
                        '
            }))
            @endforeach
            ;
        }
    </script>
@endsection