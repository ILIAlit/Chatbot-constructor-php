<!DOCTYPE html>
<html lang="en">

<style>
.container {
	padding: 30px;
}

table,
th,
td {
	border: 1px solid black;
}
</style>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>home</title>
</head>

<body>
	<div class='container' style="width:700px">
		<section>
			<h1>Create bot</h1>
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
	</section>
	<section>
		<hr>
		<h1>Bots</h1>
		<table style="width:100%">
			<tr>
				<th>id</th>
				<th>token</th>
			</tr>
			@foreach ($bots as $bot)
			<tr>
				<td>{{$bot->id}}</td>
				<td>{{$bot->token}}</td>
			</tr>
			@endforeach
		</table>
	</section>
	</div>

</body>

</html>