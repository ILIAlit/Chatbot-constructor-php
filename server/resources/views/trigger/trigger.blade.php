@extends('layout')

@section('main')
<div class='container'>
	<section>
		<h1>Create trigger</h1>
		<form method='post' action='/trigger/create'>
			@csrf
			<fieldset>
				<legend>Create trigger</legend>
				<p>
					<label for="trigger">Trigger</label>
					<input type="text" required name="trigger" id="trigger">
				</p>
				<p>
					<label for="text">Text</label>
					<input type="text" required name="text" id="text">
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
</section>
</div>
@endsection