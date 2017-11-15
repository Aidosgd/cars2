@extends('admin.app')

@section('content')
    <section class="content">
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Объявления</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Пользователь</th>
                                <th>Дата</th>
                                <th>Статус</th>
                                <th>Категория</th>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Телефон</th>
                                <th>Город</th>
                            </tr>
                            @foreach($offers as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->created_at->format('d.m.Y') }}</td>
                                    <td><span class="label {{ $item->active == 1 ? 'label-success' : 'label-danger' }}">{{ $item->active == 1 ? 'Включен' : 'Выключен' }}</span></td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->city->name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection