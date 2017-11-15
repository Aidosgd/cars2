@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
	<li>
		<a href="/" title="Главная">
			Главная
		</a>
	</li>
	<li>
		<a href="/about/1" title="О компании">
			О компании
		</a>
	</li>
	<li>
		<a href="/about/{{ $page->url }}" title="{{$page->title}}">
			{{$page->title}}
		</a>
	</li>
</ol>
<style type="text/css">
.row .col-lg-2.text-right.title_h{
	font-size: 14px;
	font-weight: bold;
	color: #e2383f;
}
.line{
 	margin-bottom: 10px;padding-top: 10px; padding-bottom: 10px; border-radius: 8px;
}
.line:nth-child(even) .deschistory{
	border-left-width: 3px;
	border-left-style: solid;
	border-left-color: #fff;
}
.line:nth-child(odd) .deschistory{
	border-left-width: 3px;
	border-left-style: solid;
	border-left-color: #E1E1E1;
}
.line:nth-child(even){
	background-color:#f5f5f5;
}
</style>
<h1>{{$page->title}}</h1>

<div>
	{!! $page->body !!}
</div>
@endsection