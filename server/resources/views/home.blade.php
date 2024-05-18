@extends('layout')

@section('main')
<form method='post' action='/bot/create'>
	@csrf
	<fieldset>
		<legend>Create bot</legend>
		<p>
			<label for="name">Name</label>
			<input type="text" required name="name" id="name">
		</p>
		<p>
			<label for="token">Token</label>
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
</div>
@endif
@endsection