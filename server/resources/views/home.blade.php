@extends('layout')

@section('main')
<div class='container'>
	<section>
		<h1 class='pb-2'>Мои боты</h1>
		<table class="table">
			<tr>
				<th>id</th>
				<th>token</th>
			</tr>
			@foreach ($bots as $bot)
			<tr>
				<td>{{$bot->id}}</td>
				<td>{{$bot->token}}</td>
				<td>{{$bot->webinar_start_time}}</td>
				<td>{{$bot->name}}</td>
				<td><a href='bot/update-bot/{{$bot->id}}'>Изменить</a></td>
			</tr>
			@endforeach
		</table>
	</section>
</div>
@endsection