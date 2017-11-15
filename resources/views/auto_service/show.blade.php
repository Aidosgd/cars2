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
        .success-transition {
            transition: all .5s ease-in-out;
        }
        .success-enter, .success-leave{
            opacity: 0;
        }
    </style>
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Главная</a></li>
        <li><a href="/auto_service/{{ $category->slug }}/{{ $category->id }}">{{ $category->title }}</a></li>
        <li><a href="#">{{ $offer->title }}</a></li>
    </ol>
    <h2>{{ $offer->title }}</h2>
    <p>Рейтинг {{ $offer->reviewCount($offer->id) }} <i class="fa fa-star"></i></p>
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
                    <p>{!! $offer->description !!}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div style="padding: 5px; font-weight: bold;">Карта:</div>
            <div id="ya_map" style="width: 100%; height: 400px"></div>
            <div class="row">
                <div class="col-md-12">
                    <div style="padding: 5px; font-weight: bold;">Контакты:</div>
                    <div class="well">
                        <div class="row">
                            <div class="col-sm-12">
                                @if($offer->address)
                                    <span class="glyphicon glyphicon-map-marker" title="Location"></span> {{ $offer->address }}<br>
                                @endif
                                @if($offer->web_site)
                                    <i class="fa fa-link"></i> <a href="{{ $offer->web_site }}" target="_blank">{{ $offer->web_site }}</a><br>
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
    <div class="row" id="ReviewController">
        <div class="col-md-12">
            <h4>Комментарий</h4>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="comments" >
                        <div class="comment one-comment" v-for="review in reviews">
                            <hr>
                            <div class="author">
                                <label>автор</label>
                                <b>@{{ review.name }}</b>
                            </div>
                            <div class="text">
                                <label>отзыв</label>
                                @{{ review.text }}
                            </div>
                            <div class="points">
                                <label>Оценка компании</label>
                                <div>
                                    <i class="fa fa-star" v-if="review.points >= 1"></i>
                                    <i class="fa fa-star-o" v-else></i>
                                    <i class="fa fa-star" v-show="review.points >= 2"></i>
                                    <i class="fa fa-star-o" v-else></i>
                                    <i class="fa fa-star" v-show="review.points >= 3"></i>
                                    <i class="fa fa-star-o" v-else></i>
                                    <i class="fa fa-star" v-show="review.points >= 4"></i>
                                    <i class="fa fa-star-o" v-else></i>
                                    <i class="fa fa-star" v-show="review.points >= 5"></i>
                                    <i class="fa fa-star-o" v-else></i>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <h2 class="commentDesc">Добавить отзыв</h2>
                    <div class="alert alert-success" transition="success" v-if="success">Отзыв добавлен</div>
                    <div id="errors-block"></div>
                    <form @submit.prevent="AddNewReview" action="#" method="POST">
                        <div class="form-group">
                            <label for="InputName">Имя<span class="error" v-show="!validation.name">*</span></label>
                            <input v-model="newReview.name"
                                   name="name"
                                   type="text"
                                   {{ Auth::guest() ? '' : 'disabled' }}
                                   value="{{ Auth::guest() ? '' : Auth::user()->name }}"
                                   class="form-control InputName">
                        </div>
                        <?php
                        $user_auth = isset($user) ? $user->social_type : null;
                        ?>
                        @if($user_auth === null)
                            <div class="form-group">
                                <label for="InputEmail">Email<span class="error" v-show="!validation.email">*</span></label>
                                <input  v-model="newReview.email"
                                        name="email"
                                        type="email"
                                        {{ Auth::guest() ? '' : 'disabled' }}
                                        value="{{ Auth::guest() ? '' : Auth::user()->email }}"
                                        class="form-control">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="InputText">Комментарий<span class="error" v-show="!validation.text">*</span></label>
                            <div class="textMessage"></div>
                            <textarea v-model="newReview.text"
                                    id="text"
                                    name="text"
                                    class="form-control required"
                                    placeholder="Текст комментария"
                                    rows="5"
                                    style="margin-bottom:10px;"></textarea>
                        </div>
                        <div class="form-group mark-star companyRating">
                            <label>Оценка компании</label>
                            <div>
                                <i class="fa fa-star"  v-on:click="setValue(1)"></i>
                                <i class="fa fa-star-o"  v-on:click="setValue(2)"></i>
                                <i class="fa fa-star-o"  v-on:click="setValue(3)"></i>
                                <i class="fa fa-star-o"  v-on:click="setValue(4)"></i>
                                <i class="fa fa-star-o" v-on:click="setValue(5)"></i>
                            </div>
                            <input v-model="newReview.points" name="points" type="hidden" value="1">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info submitComment" type="submit" :disabled="!isValid" >отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script>
        var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        var vm = new Vue({
            http: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
                }
            },

            el: '#ReviewController',

            data: {
                @if(Auth::user())
                newReview : {
                    name: '{{ Auth::user()->name }}',
                    email: '{{  Auth::user()->email }}',
                    text: '',
                    points: '1'
                },
                @else
                newReview:  {
                    name: '',
                    email: '',
                    text: '',
                    points: '1'
                },
                @endif

                reviews: {
                    name: '',
                    email: '',
                    text: '',
                    points: ''
                },

                success: false
            },

            methods: {

                fetchReview: function fetchReview() {
                    this.$http.get('/auto_service/allreview/{{ $offer->id }}').then(function (data) {
                        vm.$set('reviews', data.json());
                    });
                },

                AddNewReview: function AddNewReview() {
                    var review = this.newReview;

                    this.$http.post('/auto_services/addreview/{{ $offer->id }}', review).then(function (response) {
                        if (response.status == 200) {
                            this.fetchReview();

                            self = this;
                            this.success = true;
                            setTimeout(function () {
                                self.success = false;
                            }, 5000);

                            var items = $('.companyRating i').closest('div').find('i');
                            items.removeClass('fa-star').addClass('fa-star-o');
                            items = items.slice(0, 1);
                            items.each(function () {
                                $(this).removeClass('fa-star-o').addClass('fa-star');
                            });
                        }
                    });
                },

                setValue: function setValue(index) {
                    this.newReview.points = index;
                }

            },

            computed: {
                validation: function validation() {
                    return {
                        name: !!this.newReview.name.trim(),
                        email: emailRE.test(this.newReview.email),
                        text: !!this.newReview.text.trim()
                    };
                },

                isValid: function isValid() {
                    var validation = this.validation;
                    return Object.keys(validation).every(function (key) {
                        return validation[key];
                    });
                }
            },

            ready: function ready() {
                this.fetchReview();
            }
        });

        $('.companyRating i').click(function(event){

            var index = $(this).index() + 1;
            var items = $(this).closest('div').find('i');

            items.removeClass('fa-star').addClass('fa-star-o');
            items = items.slice(0, index);
            items.each(function(){
                $(this).removeClass('fa-star-o').addClass('fa-star');
            });

        });

        $(".image_js").colorbox({rel:'image_js'});

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

            myPlacemark = new ymaps.Placemark([{{ $map->latitude }}, {{ $map->longitude }}], {
                balloonContent: '<b>{{ $offer->title }}</b><br> \
                {{ $offer->address }} <br>\
                @foreach(json_decode($offer->phone) as $item)
                        {{ $item }} <br>\
                @endforeach
                '
            });

            myMap.geoObjects
                    .add(myPlacemark);

            myMap.setZoom({{ $map->zoom }});
        }
    </script>
@endsection