@extends('layout')

@section('main')
<div class='container'>
	<section class='w-50'>
		<h1 class='pb-5'>Создать триггер</h1>
		<form onsubmit='loadingTrue()' method='post' action='/trigger/create'>
			@csrf
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">🌟</span>
				<input type="text" required class="form-control p-2" id='trigger' name='trigger' placeholder="Триггер"
					aria-label="Триггер" aria-describedby="basic-addon1">
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">📞</span>
				<input type="text" required class="form-control p-2" id='text' name='text' placeholder="Ответ"
					aria-label="Текст" aria-describedby="basic-addon1">
			</div>
			<button class="btn btn-primary">Сохранить</button>
		</form>
		@if ($errors-> any())
		@foreach ($errors->all() as $error)
		<div class="alert alert-danger" role="alert">
			{{$error}}
		</div>
		@endforeach
		@endif
	</section>
</div>
@endsection