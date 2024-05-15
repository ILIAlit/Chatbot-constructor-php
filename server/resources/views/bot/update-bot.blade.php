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
	<title>Изменить бота</title>
</head>

<body>
	<div class='container' style="width:700px">
		<section>
			<hr>
			<h1>Bot {{$bot->name}}</h1>
			@csrf
			<table style="width:100%">
				<tr>
					<th>id</th>
					<th>token</th>
				</tr>
				<tr>
					<td>{{$bot->id}}</td>
					<td>{{$bot->token}}</td>
					<td>
						<select id='chain-select' name='chain'>
							@foreach ($chains as $chain)
							<option value="{{$chain->id}}">{{$chain->title}}</option>
							@endforeach
						</select>
						</select>
					</td>
				</tr>
			</table>
			<br>
			<button onclick="updateBotChain({{$bot->id}})">Применить</button>
		</section>
	</div>
	<script>
	function updateBotChain(botId) {
		const chainSelect = document.getElementById('chain-select');
		const chainId = chainSelect.value;
		fetch(`/bot/changeBotChain/${botId}`, {
			method: 'PATCH',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
				"X-CSRF-Token": document.querySelector('input[name=_token]').value
			},
			body: JSON.stringify({
				chainId: chainId
			}),
		}).then((res) => console.log(res))
	}
	</script>
</body>

</html>