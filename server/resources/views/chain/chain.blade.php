@extends('layout')

@section('main')
<div class='container'>
	<h1 class='pb-5'>Мои цепочки</h1>
	<table class="table">
		<tr>
			<th>id</th>
			<th>Заголовок</th>
			<th>Изменить</th>
		</tr>
		@foreach ($chains as $chain)
		<tr>
			<td>{{$chain->id}}</td>
			<td>{{$chain->title}}</td>
			<td><a href='bot/update-bot/{{$chain->id}}'>Изменить</a></td>
		</tr>
		@endforeach
	</table>
</div>
@endsection