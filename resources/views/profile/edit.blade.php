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
                <?php
                $category = [];
                foreach ($categories as $catItem)
                {
                    if (!isset($categoriesGroup[$catItem->category_group_id]))
                    {
                        $category[$catItem->category_group_id] = [];
                    }
                    $category[$catItem->categoryGroup->name][$catItem->id] = $catItem->name;
                }
                ?>
                {!! Form::select('category', $category, $offer->category->id, ['required' => 'required', 'class' => 'form-control', 'id' => 'category']) !!}
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
                {!! Form::textarea('description', $offer->description, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group @if ($errors->has('price')) has-error @endif">
                <label>Цена: @if ($errors->has('price')){!!$errors->first('price')!!}@endif</label>
                {!! Form::text('price', $offer->price, ['class'=>'form-control price']) !!}
            </div>
            <div class="form-lists defaults">
                <div class="hidden-block">

                </div>
            </div>
            <div class="form-group">
                <label>Подходит к машинам:</label>
                {!! Form::select('vehicleBrand', $vehicleBrand->lists('name', 'id'), $offer->vehicleBrand->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                <label>Состояние:</label>
                {!! Form::select('condition', $condition->lists('name', 'id'), $offer->condition->id, ['required' => 'required', 'class' => 'form-control']) !!}
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
                <label>Доставка и отправка:</label>
                {!! Form::select('delivery', $delivery->lists('name', 'id'), $offer->delivery->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="well">
        {!! Form::submit('Сохранить', ['class' => 'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
<div class="form-lists hidden" style="display: none">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="not-necessary">Производитель:</label>
                {!! Form::text('manufacturer', $offer->manufacturer, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="not-necessary">Код запчасти:</label>
                {!! Form::text('partnumber', $offer->partnumber, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>
<div class="form-lists" id="form80" style="display: none">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="not-necessary">Ширина профиля:</label>
                {!! Form::select('tireWidth', $tireWidths->lists('name', 'id'), $offer->tireWidth->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="not-necessary">Высота профиля:</label>
                {!! Form::select('tireHeight', $tireHeights->lists('name', 'id'), $offer->tireHeight->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="not-necessary">Диаметр:</label>
                {!! Form::select('diameter', $diameters->lists('name', 'id'), $offer->diameter->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="not-necessary">Сезонность шин:</label>
                {!! Form::select('tireSeason', $tireSeasons->lists('name', 'id'), $offer->tireSeason->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="not-necessary">Производитель:</label>
                {!! Form::select('tireBrand', $tireBrands->lists('name', 'id'), $offer->tireBrand->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>
</div>
<div class="form-lists" id="form81" style="display: none">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Диаметр:</label>
                {!! Form::select('diameter', $diameters->lists('name', 'id'), $offer->diameter->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Тип дисков:</label>
                {!! Form::select('rimType', $rimTypes->lists('name', 'id'), $offer->rimType->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Производитель дисков:</label>
                {!! Form::text('manufacturer', $offer->manufacturer, ['class'=>'form-control']) !!}
            </div>
        </div>
        {{--<div class="col-md-3">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Ширина обода (J):</label>--}}
                {{--{!! Form::select('rimWidth', $rimWidths->lists('name', 'id'), $offer->rimWidth->id, ['required' => 'required', 'class' => 'form-control']) !!}--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Крепёжка (PCD):</label>
                {!! Form::select('rimPcd', $rimPcds->lists('name', 'id'), $offer->rimPcd->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        {{--<div class="col-md-4">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Вылет (ЕТ):</label>--}}
                {{--{!! Form::select('rimEt', $rimEts->lists('name', 'id'), $offer->rimEt->id, ['required' => 'required', 'class' => 'form-control']) !!}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Диаметр ступицы (DIA):</label>--}}
                {{--{!! Form::select('rimDia', $rimDias->lists('name', 'id'), $offer->rimDia->id, ['required' => 'required', 'class' => 'form-control']) !!}--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>
<div class="form-lists" id="form82" style="display: none">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Ширина профиля:</label>
                {!! Form::select('tireWidth', $tireWidths->lists('name', 'id'), $offer->tireWidth->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Высота профиля:</label>
                {!! Form::select('tireHeight', $tireHeights->lists('name', 'id'), $offer->tireHeight->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Диаметр:</label>
                {!! Form::select('diameter', $diameters->lists('name', 'id'), $offer->diameter->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Сезонность шин:</label>
                {!! Form::select('tireSeason', $tireSeasons->lists('name', 'id'), $offer->tireSeason->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Производитель:</label>
                {!! Form::select('tireBrand', $tireBrands->lists('name', 'id'), $offer->tireBrand->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Тип дисков:</label>
                {!! Form::select('rimType', $rimTypes->lists('name', 'id'), $offer->rimType->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
        {{--<div class="col-md-3">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Ширина обода (J):</label>--}}
                {{--{!! Form::select('rimWidth', $rimWidths->lists('name', 'id'), $offer->rimWidth->id, ['required' => 'required', 'class' => 'form-control']) !!}--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Крепёжка (PCD):</label>
                {!! Form::select('rimPcd', $rimPcds->lists('name', 'id'), $offer->rimPcd->id, ['required' => 'required', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="not-necessary">Производитель дисков:</label>
                {!! Form::text('manufacturer', $offer->manufacturer, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        {{--<div class="col-md-4">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Вылет (ЕТ):</label>--}}
                {{--{!! Form::select('rimEt', $rimEts->lists('name', 'id'), $offer->rimEt->id, ['required' => 'required', 'class' => 'form-control']) !!}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-4">--}}
            {{--<div class="form-group">--}}
                {{--<label class="not-necessary">Диаметр ступицы (DIA):</label>--}}
                {{--{!! Form::select('rimDia', $rimDias->lists('name', 'id'), $offer->rimDia->id, ['required' => 'required', 'class' => 'form-control']) !!}--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>
@endsection
@section('scripts')
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
        $('.price').maskMoney({thousands:'', allowZero:false, precision:0,});
        $('.deleteImage').on('click', function(){
            $(this).closest('.img-preview').remove();
        });
        $("#category")
            .change(function() {
                var str = "";
                $( "#category option:selected" ).each(function() {
                    str += $( this ).val() + " ";
                });
                var hiddenForm = $('#form'+str).html();
                $('form .form-lists.defaults .hidden-block *').remove();
                if (hiddenForm){
                    var formPlace = $('.hidden-block');
                    formPlace.html(hiddenForm);
                } else {
                    hiddenForm = $('.form-lists.hidden').html();
                    var formPlace = $('.hidden-block');
                    formPlace.html(hiddenForm);
                }
            })
            .trigger( "change" );
    </script>
@endsection