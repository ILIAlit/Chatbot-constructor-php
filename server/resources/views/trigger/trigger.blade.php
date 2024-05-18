<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trigger</title>
</head>

<body>
	<div class='container' style="width:700px">
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
</body>

</html>