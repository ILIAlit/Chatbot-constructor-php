@extends('layout')

@section('main')
<div>

	<form method='post' action='/bot/create'>
		@csrf
		<fieldset>
			<legend>Создать бота</legend>
			<p>
				<label for="name">Имя</label>
				<input type="text" required name="name" id="name">
			</p>
			<p>
				<label for="token">Токен</label>
				<input type="text" required name="token" id="token">
			</p>
			<input type='submit'>
			</p>
		</fieldset>
	</form>
	@if ($errors-> any())
	<div style='background: red'>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
</div>
@endsection