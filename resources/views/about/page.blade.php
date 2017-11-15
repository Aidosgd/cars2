@extends('layouts.app')

@section('content')
<h1>Список публикаций в блог</h1>

<ul>
	@foreach($pages as $page)
	<li>
		<a href="/about/{{ $page->url }}" >
			{{ $page->title }}
		</a>	
	</li>
	@endforeach
</ul>
 
@endsection