<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<div class='container' style="width:700px">
		<section>
			<h1>Создать цепочку</h1>
			@csrf
			<fieldset>
				<legend>Создать цепочку</legend>
				<p>
					<label for="title">Заголовок</label>
					<input type="text" required name="title" id="title">
				</p>
				<div id="message-container"></div>
				<button onclick="addMessageComponent()">Добавить элемент</button>
				<button onclick="submit()">Сохранить</button>

				</p>
			</fieldset>
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
	<script>
	const messages = [];
	let orderNum = 0

	const inputTitle = document.getElementById("title")

	function addMessageComponent() {
		const messageText = prompt("Введите текст сообщения:");
		const pauseDuration = parseInt(prompt("Введите паузу (в секундах):"));

		if (messageText && !isNaN(pauseDuration)) {
			const messageObj = {
				text: messageText,
				pause: pauseDuration,
				order: orderNum++
			};
			messages.push(messageObj);
			displayMessageComponent(messageObj);
		} else {
			alert("Пожалуйста, введите корректные данные.");
		}
	}

	function displayMessageComponent(messageObj) {
		const messageContainer = document.getElementById("message-container");
		const messageElement = document.createElement("div");
		messageElement.textContent = `Текст: ${messageObj.text}, Пауза: ${messageObj.pause} секунд`;
		messageContainer.appendChild(messageElement);
	}

	function submit() {
		const title = inputTitle.value;
		if (!title) {
			alert("Пожалуйста, введите заголовок цепочки.");
			return;
		}
		if (!messages.length) {
			alert("Пожалуйста, добавьте элемент цепочки.");
			return;
		}
		const data = {
			title: title,
			stages: messages
		};
		console.log(data);
		fetch('/chain/create', {
			method: 'POST',
			headers: {
				//'Content-Type': 'application/json',
				'Content-Type': 'application/x-www-form-urlencoded',
				"X-CSRF-Token": document.querySelector('input[name=_token]').value
			},
			body: JSON.stringify(data)
		}).then((res) => {
			if (res.status == 200) {
				location.href = "/";
			} else {
				alert("Ошибка при создании цепочки");
			}
		});
	}
	</script>
</body>

</html>