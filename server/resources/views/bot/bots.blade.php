<!DOCTYPE html>
<html lang="ru">
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
	<title>Bots</title>
</head>

<body>
	<div class='container' style="width:700px">
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
					<td><a href='bot/update-bot/{{$bot->id}}'>Изменить</a></td>
				</tr>
				@endforeach
			</table>
		</section>
	</div>
	<script>
	function updateBotChain(botId, chainId) {

	}
	</script>
</body>

</html>