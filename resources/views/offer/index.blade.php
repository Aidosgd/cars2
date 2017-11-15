@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Главная</a></li>
        @if(isset($catGroup))
            <li><a href="#">{{ $catGroup->name}}</a></li>
        @endif
        <li><a href="#">{{ isset($category) ? $category->name : 'Все'}}</a></li>
    </ol>
    <h1>{{ isset($category) ? $category->name : 'Все' }}</h1>
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
                    <th class="text-center">Опубликовано</th>
                    <th class="text-center"> Цена </th>
                    <th class="text-center">Просмотры</th>
                </tr>
                </thead>
                <tbody>
                @forelse($result as $offer)
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="/offers/category/{{$category_name}}/{{ $category->id }}/offer/{{ $offer->getSlug() }}/{{ $offer->id }}">
                                    <img class="media-object" src="/uploads/offers/small/{{ $offer->getImage($offer->id) }}" style="width: 72px; height: 72px;" alt="{{ $offer->title }}">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="/offers/category/{{$category_name}}/{{ $category->id }}/offer/{{ $offer->getSlug() }}/{{ $offer->id }}">{{ $offer->title }}</a></h4>
                                    <p><small>{{ str_limit($offer->description, 120) }}</small></p>
                                    <p><small>{{ $offer->city->name }}</small></p>
                                </div>
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">{{ $offer->created_at->format('d.m.Y G:i') }}</td>
                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle; width: 11%">{{ $offer->formattedPrice() }} тг</td>
                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">{{ $offer->offerViews->views_count }}</td>
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