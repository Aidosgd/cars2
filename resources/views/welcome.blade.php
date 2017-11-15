@extends('layouts.app')
@section('head')
    <style>
        h1{
            font-size: 24px;
        }
    </style>
@endsection
@section('content') 
<h1>Cars2.kz - это новая бесплатная доска объявлений для авто запчастей</h1>
<a href="{{ url('/feedback') }}">Если у вас есть пожелание вы можете нам написать</a>
<h4>Новые объявления</h4>
<div class="row selected-classifieds">
    @foreach($offersWelcome as $item)
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail">
                <a href="/offers/category/{{ $item->category->getSlug() }}/{{ $item->category->id }}/offer/{{ $item->getSlug() }}/{{ $item->id }}"><img style="height: 179px;" src="/uploads/offers/small/{{ $item->getImage($item->id) }}" alt="{{ $item->title }}" /></a>
                <div class="caption" style="padding: 5px 0">
                    <h5><a href="/offers/category/{{ $item->category->getSlug() }}/{{ $item->category->id }}/offer/{{ $item->getSlug() }}/{{ $item->id }}">{{ str_limit($item->title, 25)}}</a></h5>
                    <p class="price">{{ $item->formattedPrice() }} тг</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection 
