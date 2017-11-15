@extends('layouts.app')
@section('head')
    <style>
        .carousel-inner>.active:hover > .image_js{
            opacity: 1;
        }
        .image_js{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%)translateY(-50%);
            font-size: 50px;
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 20px;
            color: rgba(255, 255, 255, 0.8) !important;
            opacity: 0;
            transition: 0.2s;
        }
        .image_js:hover{
            color: #fff
        }
        .child_comment{
            margin-left:20px;
        }
        .error{
            font-weight: bold;
            color: red;
        }
    </style>
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Главная</a></li>
        <li><a href="/offers/category/{{ $category->getSlug() }}/{{ $category->id }}">{{ $catGroup->name }}</a></li>
        <li><a href="/offers/category/{{ $category->getSlug() }}/{{ $category->id }}">{{ $category->name }}</a></li>
        <li><a href="#">{{ $offer->title }}</a></li>
    </ol>
    <h2>{{ $offer->title }}</h2>
    @if (Session::has('message'))
        <p class="bg-info" style="padding: 10px">
            {{ Session::get('message') }}
        </p>
    @endif
    <div class="row">
        <div class="col-md-8">
            @if(!$offer->images->count())
                <img src="/css/images/logo2.svg" alt="logo">
            @else
                <div class="row">
                    <div class="col-md-12">
                        <div id="carousel-detail-classified" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($offer->images as $index => $image)
                                    <li data-target="#carousel-detail-classified" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($offer->images as $index => $image)
                                    <div class="item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="/uploads/offers/{{ $image->name }}" class="img-responsive" alt="{{ $offer->title }}">
                                        <a class="image_js" href="/uploads/offers/original/{{ $image->name }}"><i class="fa fa-search-plus"></i></a>
                                    </div>
                                @endforeach
                            </div>
                            @if($offer->images->count() > 1)
                                <a class="left carousel-control" href="#carousel-detail-classified" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-detail-classified" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row hidden-xs">
                    <div class="col-md-12">
                        <div id="thumbs-detail-classified">
                            <ul class="list-inline">
                                @if($offer->images->count() > 1)
                                    @foreach($offer->images as $index => $image)
                                        <li data-target="#carousel-detail-classified" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}">
                                            <img src="/uploads/offers/small/{{ $image->name }}" class="img-responsive" alt="{{ $offer->title }}">
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <h4>Описание</h4>
                    <p style="text-align: justify;">{{ $offer->description }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <table class="table table-condensed table-hover">
                <thead>
                <tr><th colspan="2">Детали объявления:</th>
                </tr></thead>
                <tbody style="font-size: 12px;">
                <tr>
                    <td>Номер объявления</td>
                    <td>{{ $offer->id }}</td>
                </tr>
                <tr>
                    <td>Цена</td>
                    <td>{{ $offer->formattedPrice() }} тг</td>
                </tr>
                @if($category->id !== 82 && $category->id !== 80 && $category->id !== 81 && !empty($offer->manufacturer))
                    <tr>
                        <td>Производитель</td>
                        <td>{{ $offer->manufacturer }}</td>
                    </tr>
                @endif
                @if(!empty($offer->partnumber))
                    <tr>
                        <td>Код запчасти</td>
                        <td>{{ $offer->partnumber  }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Подходит к машинам</td>
                    <td>{{ $offer->vehicleBrand->name }}</td>
                </tr>
                <tr>
                    <td>Состояние</td>
                    <td>{{ $offer->condition->name }}</td>
                </tr>
                </tbody>
            </table>
            @if($category->id == 80)
                <table class="table table-condensed table-hover">
                    <thead>
                    <tr><th colspan="2">Детали шины:</th>
                    </tr></thead>
                    <tbody style="font-size: 12px;">
                    <tr>
                        <td>Ширина профиля</td>
                        <td>{{ $offer->tireWidth->name }}</td>
                    </tr>
                    <tr>
                        <td>Высота профиля</td>
                        <td>{{ $offer->tireHeight->name  }}</td>
                    </tr>
                    <tr>
                        <td>Диаметр</td>
                        <td>{{ $offer->diameter->name }}</td>
                    </tr>
                    <tr>
                        <td>Сезонность шин</td>
                        <td>{{ $offer->tireSeason->name  }}</td>
                    </tr>
                    <tr>
                        <td>Производитель</td>
                        <td>{{ $offer->manufacturer }}</td>
                    </tr>
                    </tbody>
                </table>
            @endif
            @if($category->id == 81)
                <table class="table table-condensed table-hover">
                    <thead>
                    <tr><th colspan="2">Детали диска:</th>
                    </tr></thead>
                    <tbody style="font-size: 12px;">
                    <tr>
                        <td>Диаметр</td>
                        <td>{{ $offer->diameter->name }}</td>
                    </tr>
                    <tr>
                        <td>Тип дисков</td>
                        <td>{{ $offer->rimType->name  }}</td>
                    </tr>
                    {{--<tr>--}}
                        {{--<td>Ширина обода (J)</td>--}}
                        {{--<td>{{ $offer->rimWidth->name }}</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <td>Крепёжные отверстия (PCD)</td>
                        <td>{{ $offer->rimPcd->name  }}</td>
                    </tr>
                    {{--<tr>--}}
                        {{--<td>Вылет (ЕТ)</td>--}}
                        {{--<td>{{ $offer->rimEt->name }}</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>Диаметр ступицы (DIA)</td>--}}
                        {{--<td>{{ $offer->rimDia->name }}</td>--}}
                    {{--</tr>--}}
                    @if(!empty($offer->manufacturer))
                        <tr>
                            <td>Производитель</td>
                            <td>{{ $offer->manufacturer }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            @endif
            @if($category->id == 82)
                <table class="table table-condensed table-hover">
                    <thead>
                    <tr><th colspan="2">Детали колес:</th>
                    </tr></thead>
                    <tbody style="font-size: 12px;">
                    <tr>
                        <td>Ширина профиля</td>
                        <td>{{ $offer->tireWidth->name }}</td>
                    </tr>
                    <tr>
                        <td>Высота профиля</td>
                        <td>{{ $offer->tireHeight->name  }}</td>
                    </tr>
                    <tr>
                        <td>Диаметр</td>
                        <td>{{ $offer->diameter->name }}</td>
                    </tr>
                    <tr>
                        <td>Сезонность шин</td>
                        <td>{{ $offer->tireSeason->name  }}</td>
                    </tr>
                    <tr>
                        <td>Производитель шин</td>
                        <td>{{ $offer->tireBrand->name }}</td>
                    </tr>
                    <tr>
                        <td>Тип дисков</td>
                        <td>{{ $offer->rimType->name  }}</td>
                    </tr>
                    {{--<tr>--}}
                        {{--<td>Ширина обода (J)</td>--}}
                        {{--<td>{{ $offer->rimWidth->name }}</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <td>Крепёжные отверстия (PCD)</td>
                        <td>{{ $offer->rimPcd->name  }}</td>
                    </tr>
                    {{--<tr>--}}
                        {{--<td>Вылет (ЕТ)</td>--}}
                        {{--<td>{{ $offer->rimEt->name }}</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>Диаметр ступицы (DIA)</td>--}}
                        {{--<td>{{ $offer->rimDia->name }}</td>--}}
                    {{--</tr>--}}
                    @if(!empty($offer->manufacturer))
                        <tr>
                            <td>Производитель</td>
                            <td>{{ $offer->manufacturer }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div style="padding: 5px; font-weight: bold;">Продавец:</div>
                    <div class="well">
                        <div class="row">
                            <div class="col-sm-12">
                               <div class="row">
                                   <div class="col-md-8">
                                       <h5 style="margin-bottom: 0;">{{ $offer->user->name }}</h5>
                                   </div>
                                   <div class="col-md-4">
                                       <img style="width: 50px; height: 50px;border-radius: 5px; border: 1px solid #e7e7e7" src="{{ $offer->user->getAvatar($offer->user->id) }}" alt="{{ $offer->title }}">
                                   </div>
                               </div>
                                @if($offer->address)
                                    <span class="glyphicon glyphicon-map-marker" title="Location"></span> г.{{ $offer->city->name }}, {{ $offer->address }}<br>
                                @endif
                                @if($offer->user->social_type == null)
                                    <span class="glyphicon glyphicon-envelope" title="E-mail"></span> {{ $offer->user->email }}<br>
                                @endif
                                @foreach(json_decode($offer->phone) as $item)
                                    <span class="glyphicon glyphicon-phone-alt" title="Telephone"></span> {{ $item }}<br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <p>Просмотры: {{ $offer->offerViews->views_count }}</p>
    <div class="row">
        <div class="col-md-12">
            <h4>Комментарий</h4>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="comments">
                        @forelse($offer->comments as $comment)
                            <div class="comment one-comment">
                                <hr>
                                <div class="author">
                                    <b>{{ $comment->name }}</b>
                                </div>
                                <div class="text">
                                    {{ $comment->text }}
                                </div>
                                <div class="date">{{ $comment->created_at }}</div>
                                <a href="#" data-comment-id="{{ $comment->id }}" class="btn btn-info btn-xs reply-с">ответить</a>

                                @if($comment->children->count())
                                    {{-- recursively include this view, passing in the new collection of comments to iterate --}}
                                    @include('offer_comments.comment', ['offer_comments' => $comment->children])
                                @endif
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <h2 class="commentDesc">Добавить комментарий</h2>
                    <div id="errors-block"></div>
                    <form id="comment-form" action="/offers/addcomment/{{ $offer->id }}" method="POST">
                        {!! csrf_field() !!}
                        <input class="hidden-input" type="hidden" name="parent_id" value="">
                        <div class="form-group">
                            <label for="InputName">
                                Имя
                                <span class="error" v-show="!validation.name">*</span>
                            </label>
                            <input v-model="newComments.name" name="name" type="text" {{ Auth::guest() ? '' : 'disabled' }} value="{{ Auth::guest() ? '' : Auth::user()->name }}" class="form-control InputName">
                        </div>
                        <?php
                            $user_auth = isset($user) ? $user->social_type : null;
                        ?>
                        @if($user_auth === null)
                            <div class="form-group">
                                <label for="InputEmail">
                                    Email
                                    <span class="error" v-show="!validation.email">*</span>
                                </label>
                                <input  v-model="newComments.email"  name="email" type="email" {{ Auth::guest() ? '' : 'disabled' }} value="{{ Auth::guest() ? '' : Auth::user()->email }}" class="form-control">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="InputText">
                                Комментарий 
                                <span class="error" v-show="!validation.text">*</span>
                            </label>
                            <div class="textMessage"></div>
                            <textarea v-model="newComments.text" id="text" name="text" class="form-control required" placeholder="Текст комментария" rows="5" style="margin-bottom:10px;"></textarea>
                        </div>
                        <button class="btn btn-info submitComment" type="submit" :disabled="!isValid">отправить</button>
                    </form> 
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script> 
        var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/


        new Vue({
            el: '#comment-form',
            data: {
                newComments:{
                    name: '',
                    email: '',
                    text: ''
                },
            },
            computed: {
                validation : function () {
                    return {
                        name: !!this.newComments.name.trim(),
                        email: emailRE.test(this.newComments.email),
                        text: !!this.newComments.text.trim()
                    }
                },
                isValid: function () {
                    var validation = this.validation
                    return Object.keys(validation).every(function (key) {
                        return validation[key]
                    })
                }
            },
        })

        $(".image_js").colorbox({rel:'image_js'});

        var buttonClicked = null;
        $(document).on('click', '.reply-с', function(e){
            e.preventDefault();
            buttonClicked = $(this);
            var authorName = $(this).siblings('.author').text();
            $('.commentDesc').html('Ответить пользователю '+authorName);
            $('.hidden-input').val(buttonClicked.data('comment-id'));
            $('html, body').animate({
                scrollTop: $("#comment-form").offset().top
            }, 500);
        });

        $('.submitComment').on('click', function(e){
            e.preventDefault();
            var form = $(this).closest('form')
            var data = form.serializeArray();
            @if(Auth::user())
                data.push({ name: 'name', value: "{{ Auth::user()->name }}"});
                data.push({ name: 'email', value: "{{ Auth::user()->email }}"});
            @endif
            $.post("/offers/addcomment/{{ $offer->id }}",data,function(data,status){ 
                if( status=='success' ){
                    $('#errors-block').find('p').remove();
                    if(buttonClicked){ 
                        buttonClicked.closest('.one-comment').append('<div class="child_comment one-comment">\
                        <hr>\
                        <div class="author">\
                        <b>'+ data['name'] +'</b>\
                        </div>\
                        <div class="text">\
                        '+ data['text'] +'\
                        </div>\
                        <div class="date">\
                        '+ data['created_at'] +'\
                        </div>\
                        <a href="#" data-comment-id="'+ data['id'] +'" class="btn btn-info btn-xs reply-с">ответить</a>\
                        </div>');                        
                        @if(Auth::user())
                            $('#comment-form').find("textarea").val("");
                        @else
                            $('#comment-form').find("input[type=text], input.hidden-input, textarea, input[type=email]").val("");
                        @endif
                        $('.commentDesc').html('Добавить комментарий');
                        buttonClicked = null;

                    }else{
                        $('.comments').append('<div class="comment one-comment">\
                        <hr>\
                        <div class="author">\
                        <b>'+ data['name'] +'</b>\
                        </div>\
                        <div class="text">\
                       '+ data['text'] +'\
                       </div>\
                       <div class="date">\
                        '+ data['created_at'] +'\
                        </div>\
                        <a href="#" data-comment-id="'+ data['id'] +'" class="btn btn-info btn-xs reply-с">ответить</a>\
                        </div>');
                        @if(Auth::user())
                            $('#comment-form').find("textarea").val("");
                        @else
                            $('#comment-form').find("input[type=text], input.hidden-input, textarea, input[type=email]").val("");
                        @endif
                        $('.commentDesc').html('Добавить комментарий');
                        buttonClicked = null;
                    }
                }else{
                    alert('В процессе отправки произошла ошибка :(')
                }
            }).error(function(data) { // the data parameter here is a jqXHR instance
                var errors = data.responseJSON;
                $('#errors-block').find('p').remove();
                if(errors){
                    $.each(errors, function(index, value){
                        // console.log(index, value);
                        $('#errors-block').append('<p class="alert bg-danger">' + value + '</p>');
                    });
                }
            });
        });
    </script>
@endsection