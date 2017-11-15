@extends('layouts.app')

@section('content')
<h1>Список публикаций в блог</h1>

<ul>
	@foreach($models as $user)
	<li>
		<a href="/about/{{ $user->id }}" >
			{{ $user->email }}
		</a>	
	</li>
	@endforeach
</ul>
 
@endsection