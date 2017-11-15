@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
	<li>
		<a href="/" title="Главная">
			Главная
		</a>
	</li>
	<li>
		<a href="/news/comp_news/" title="Пресс-центр">
			Пресс-центр
		</a>
	</li>
	<li>
		<a href="/news/{{$page->category}}/" title="Новости компании">
		@if($page->category == 'comp_news')
			Новости компании
	    @elseif($page->category == 'pressrelise')
	        Пресс-релизы
		@endif
		</a>
	</li>
</ol>
<h1>{{ $page->title }}</h1>

<div>
	{!! $page->body !!}
</div>

<p><a href="/news/{{$page->category}}">Возврат к списку</a></p>
@endsection