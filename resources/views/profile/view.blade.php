@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Главная</a></li>
        <li><a href="#">Мои объявления</a></li>
    </ol>
    <h2>Мои объявления</h2>
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
                    <th class="text-center">Цена</th>
                    <th class="text-center">Просмотры</th>
                </tr>
                </thead>
                <tbody>
                @forelse($offers as $offer)
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left" href="/offers/category/{{ $offer->category->getSlug() }}/{{ $offer->category->id }}/offer/{{ $offer->getSlug() }}/{{ $offer->id }}">
                                    <img class="media-object" src="/uploads/offers/small/{{ $offer->getImage($offer->id) }}" style="width: 72px; height: 72px;" alt="{{ $offer->title }}">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/offers/category/{{ $offer->category->getSlug() }}/{{ $offer->category->id }}/offer/{{ $offer->getSlug() }}/{{ $offer->id }}">{{ $offer->title }}</a>
                                    </h4>
                                    <br>
{{--                                    <p><small>{{ $offer->description }}</small></p>--}}
                                    <a class="btn btn btn-info btn-xs" href="/profile/editoffer/{{ $offer->id }}">Редактировать</a>
                                    @if($offer->active != 1)
                                        <a class="btn btn btn-success btn-xs" href="/profile/onoffer/{{ $offer->id }}">Включить</a>
                                    @else
                                        <a class="btn btn btn-warning btn-xs" href="/profile/offoffer/{{ $offer->id }}">Выключить</a>
                                    @endif
                                    <button data-toggle="modal" data-target="#deleteOffer{{ $offer->id }}" class="btn btn btn-primary btn-xs">Удалить</button>
                                </div>
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">{{ $offer->created_at->format('d.m.Y G:i') }}</td>
                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">{{ $offer->formattedPrice() }} тг</td>
                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">{{ $offer->offerViews->views_count }}</td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteOffer{{ $offer->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                                    <h4 class="modal-title" id="myModalLabel">Удалить {{ $offer->title }}</h4>
                                </div>
                                <div class="modal-body">
                                    Вы уверены что хотите удалить это объявление
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Нет</button>
                                    <a type="button" class="btn btn-primary" href="/profile/deleteoffer/{{ $offer->id }}">Да</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    Пока у вас нет объявлении
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {!! $offers->links() !!}
        </div>
    </div>
@endsection