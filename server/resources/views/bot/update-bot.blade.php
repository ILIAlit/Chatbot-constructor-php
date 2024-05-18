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
					</td>
				</tr>
			</table>
			<br />
			<fieldset>
				<legend>Triggers:</legend>
				@foreach ($triggers as $trigger)
				@if (in_array($trigger->id, $botIdTriggersArray))
				<div>
					<input type="checkbox" id="{{$trigger->trigger}}" name="{{$trigger->id}}" checked />
					<label for="{{$trigger->trigger}}"><b>Триггер:</b> {{$trigger->trigger}}</label>
					<label for="{{$trigger->trigger}}"><b>Ответ:</b> {{$trigger->trigger}}</label>
				</div>
				@else
				<div>
					<input type="checkbox" id="{{$trigger->trigger}}" name="{{$trigger->id}}" />
					<label for="{{$trigger->trigger}}"><b>Триггер:</b> {{$trigger->trigger}}</label>
					<label for="{{$trigger->trigger}}"><b>Ответ:</b> {{$trigger->text}}</label>
				</div>
				@endif
				@endforeach
			</fieldset>
			<br>
			<button onclick="updateBotChain({{$bot->id}}), updateBotTriggers({{$bot->id}})">Применить</button>
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

	function updateBotTriggers(botId) {
		const selectedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');

		const checkTriggers = Array.from(selectedCheckboxes).map((checkbox) => {
			return checkbox.name;
		});

		console.log(checkTriggers)

		fetch(`/bot/updateBotTriggers/${botId}`, {
			method: 'PATCH',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
				"X-CSRF-Token": document.querySelector('input[name=_token]').value
			},
			body: JSON.stringify({
				triggers: checkTriggers
			}),
		}).then((res) => {
			if (res.status === 200) {
				location.href = '/'
			}
		})
	}
	</script>
</body>

</html>