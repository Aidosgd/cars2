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
		<a href="/news/comp_news/" title="Новости компании">
			Новости компании
		</a>
	</li>
</ol>

<div>
	<div class="news-list">
	    @foreach($news as $item)
		<p class="news-item" id="bx_1373509569_18953">
			<i class="fa fa-file-text-o"></i> <span class="news-date-time">{{ $item->created_at->format('d.m.Y') }}</span>
			<a href="/news/{{ $item->category }}/{{ $item->url }}">
			    <b>
			        {{ $item->title }}
                </b>
            </a>
            <br>
		</p>
		@endforeach
		{!! $news->links() !!}
	 </div>
</div>
@endsection