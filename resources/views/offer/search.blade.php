@extends('layouts.app')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Главная</a></li>
        <li><a href="#">Поиск</a></li>
            <li><a href="#">{{ $query }}</a></li>
    </ol>
    <h2>Поиск </h2>
    @if (Session::has('message'))
        <p class="bg-info" style="padding: 10px">
            {{ Session::get('message') }}
        </p>
    @endif
    <hr>
    <div class="row classifieds-table">
        <div class="col-lg-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Объявление</th>
                    <th class="text-center">Цена</th>
                    <th class="text-center">Просмотры</th>
                </tr>
                </thead>
                <tbody>
                @if (count($articles) === 0)
                    Ничего нет
                    @elseif (count($articles) >= 1)
                    @foreach($articles as $offer)
                        <tr>
                            <td class="col-sm-8 col-md-6">
                                <div class="media">
                                    <a class="thumbnail pull-left" href="/offers/{{ $offer->id }}">
                                        <img class="media-object" src="/uploads/offers/small/{{ $offer->getImage($offer->id) }}" style="width: 72px; height: 72px;" alt="{{ $offer->title }}" >
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="/offers/{{ $offer->id }}">{{ $offer->title }}</a></h4>
                                        <p><small>{{ $offer->description }}</small></p>
                                    </div>
                                </div>
                            </td>
                            <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;"><strong>{{ $offer->formattedPrice() }} тг</strong></td>
                            <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">76x</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {!! $articles->links() !!}
        </div>
    </div>
@endsection