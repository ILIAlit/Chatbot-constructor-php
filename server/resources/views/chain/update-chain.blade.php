@extends('layout')

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"
	integrity="sha512-zYXldzJsDrNKV+odAwFYiDXV2Cy37cwizT+NkuiPGsa9X1dOz04eHvUWVuxaJ299GvcJT31ug2zO4itXBjFx4w=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js">
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script>
let idItemNum = 0

function resTransformData(date) {
	let parts = date.split(" ");
	let datePart = parts[0];
	let timePart = parts[1];
	let dateParts = datePart.split("-");
	let timeParts = timePart.split(":");
	return dateParts[1] + "-" + dateParts[2] + "-" + dateParts[0] + ' ' +
		timeParts[0] + ':' +
		timeParts[1];
}

function secondsConverter(seconds) {
	let hours = Math.floor(seconds / 3600);
	let minutes = Math.floor((seconds % 3600) / 60);
	let remainingSeconds = seconds % 60;
	return {
		hours: hours,
		minutes: minutes,
		seconds: remainingSeconds
	}
}

function registerDdD() {
	let dragItem = null;
	const sortableList = document.getElementById('elements-container')

	new Sortable(sortableList, {
		animation: 150,
		ghostClass: 'blue-background-class'
	})
}

function addMessageComponentByTime(text = null, time = null) {
	if (time) {
		time = resTransformData(time)
	}
	let elementContainer = document.getElementById('elements-container')
	const messageElement = document.createElement("div");
	messageElement.innerHTML =
		`<div draggable='true' class='list-group-item'>
			<div class='d-flex gap-2 card-body'>
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">⇅</span>
				</div>
				<input value="${text ? text : ''}" required class="form-control" type="text" name="text" />
				<input class="form-control" type="text" id='date-piker-${idItemNum}' name="date" value="${time ? time : ''}" />
				<button id='remove-item-${idItemNum}' type="button" class="btn btn-outline-danger">Х</button>
			</div>
		</div>`;
	elementContainer.appendChild(messageElement)
	$(`#date-piker-${idItemNum}`).daterangepicker({
		"locale": {
			"format": 'MM-DD-YYYY H:mm'
		},
		"singleDatePicker": true,
		"timePicker": true,
		"timePicker24Hour": true,
		"drops": "up"
	}, function() {

	});

	$(`#date-piker-${idItemNum}`).on('cancel.daterangepicker', function(ev, picker) {
		$(`#date-piker-${idItemNum}`).val('Введите дату и время');
	});
	$(`#date-piker-${idItemNum}`).on('apply.daterangepicker', function(ev, picker) {
		console.log($(this).val());
	});
	const removeItemButton = document.getElementById(`remove-item-${idItemNum}`)
	removeItemButton.addEventListener('click', function(event) {
		const item = this.closest('.list-group-item');
		item.remove();
	})
	registerDdD()
	idItemNum++;
}

function addMessageComponentByPause(text = null, seconds = null) {
	if (seconds) {
		timeObject = secondsConverter(seconds)
	}
	let elementContainer = document.getElementById('elements-container')
	const messageElement = document.createElement("div");
	messageElement.innerHTML =
		`<div draggable='true' class='list-group-item'>
			<div class='d-flex gap-2 card-body'>
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon">⇅</span>
				</div>
				<input value="${text ? text : ''}" required class="form-control" type="text" name="text" />
				<input value="${seconds ? timeObject.hours : ''}" class="form-control" type='number' name='hour' placeholder='Часы' />
				<input value="${seconds ? timeObject.minutes : ''}" class="form-control" type='number' name='minute' placeholder='Минуты' />
				<input value="${seconds ? timeObject.seconds : ''}"  class="form-control" name='second' type='number' placeholder='Секунды' />
				<button id='remove-item-${idItemNum}' type="button" class="btn btn-outline-danger">Х</button>
			</div>
		</div>`;
	elementContainer.appendChild(messageElement)

	const removeItemButton = document.getElementById(`remove-item-${idItemNum}`)
	removeItemButton.addEventListener('click', function(event) {
		const item = this.closest('.list-group-item');
		item.remove();
	})
	registerDdD()
	idItemNum++;
}
</script>

<style>
.draggable {
	font-family: "Trebuchet MS", sans-serif;
	display: flex;
	gap: 30px;
}

.column {
	flex-basis: 20%;
	background: #ddd;
	min-height: 90vh;
	padding: 20px;
	border-radius: 10px;
}

.column h1 {
	text-align: center;
	font-size: 22px;
}

.item {
	background: #fff;
	margin: 20px;
	padding: 20px;
	border-radius: 3px;
	cursor: pointer;
}

.invisible {
	display: none;
}
</style>


@section('main')

<div class='container'>
	<section class=' w-50'>
		<h1 class='pb-5'>Изменить цепочку</h1>
		@csrf
		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1">@</span>
			<input value='{{$chain->title}}' type="text" class="form-control p-2" id='title' name='title'
				placeholder="Название" aria-label="Название" aria-describedby="basic-addon1">
		</div>
		<div class="form-check form-switch">
			<input class="form-check-input" type="checkbox" id="start-time-checker">
			<label class="form-check-label" for="flexSwitchCheckDefault">Назначить время начала</label>
		</div>
		<div id='input-start-time' class='d-none'>
			<div class="input-group mb-3 mt-2">
				<span class="input-group-text" id="basic-addon1">⌚</span>
				<input class="form-control" type="text" id='date-piker-start-time' name="webinar_start_time" value="" />
			</div>
		</div>
		<div class='mt-5 gap-2 d-flex flex-column'>
			<select class="element-select p-2" aria-label="element-selected">
				<option disabled selected>Компоненты</option>
				<option value="1">Сообщение с датой отправки</option>
				<option value="2">Сообщение с паузой</option>
			</select>
			<button id='add-element-btn' type="button" class="btn btn-primary">Добавить</button>
			<div class='d-flex flex-column mb-5 gap-2 p-1' id="elements-container">
				@foreach ($stages as $stage)
				@if (isset($stage->pause))
				<script>
				addMessageComponentByPause("{{$stage->text}}", "{{$stage->pause}}")
				</script>
				@else
				<script>
				addMessageComponentByTime("{{$stage->text}}", "{{$stage->time}}")
				</script>
				@endif

				@endforeach
			</div>
			<button onclick='submit({{$chain->id}})' id='submit-btn' type="button"
				class="btn btn-primary">Сохранить</button>

		</div>
		<div id='time-message' class='d-none gap-2'>
			<input type="text" name="text" />
			<input type="text" id='date-piker' name="date-piker" value="" />
			<button id='remove-item' type="button" class="btn btn-outline-danger">Х</button>
		</div>
	</section>
</div>

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
$(`#date-piker-start-time`).daterangepicker({
	"locale": {
		"format": 'MM-DD-YYYY H:mm'
	},
	"singleDatePicker": true,
	"timePicker": true,
	"timePicker24Hour": true,
	"drops": "up"
}, function() {

});

$(`#date-piker-start-time`).on('cancel.daterangepicker', function(ev, picker) {
	$(`#date-piker-start-time`).val('Введите дату и время');
});
$(`#date-piker-start-time`).on('apply.daterangepicker', function(ev, picker) {
	console.log($(this).val());
});
</script>

<script>
//const items = document.querySelectorAll('.item')
//const columns = document.querySelectorAll('.column')
const elementSelect = document.querySelector('.element-select')
const addedButton = document.getElementById('add-element-btn')
const startTimeChecker = document.getElementById('start-time-checker')

const messages = [];
let selectedItem = null;

elementSelect.addEventListener('change', (event) => {
	selectedItem = event.target.value;
})

startTimeChecker.addEventListener('change', (event) => {
	if (event.target.checked) {
		document.getElementById('input-start-time').classList.remove('d-none')
	} else {
		document.getElementById('input-start-time').classList.add('d-none')
	}
})

addedButton.addEventListener('click', (event) => {
	if (!selectedItem) {
		return;
	}
	switch (selectedItem) {
		case '1':
			addMessageComponentByTime();
			break;
		case '2':
			addMessageComponentByPause();
			break;
	}
})

function parseInputs() {
	const items = document.querySelectorAll('.list-group-item')
	const inputs = [];
	items.forEach(function(item) {
		const inputsChild = {};
		item.querySelectorAll('input').forEach(function(input) {
			inputsChild[input.name] = input.value;
		});
		inputs.push(inputsChild);
	})
	return inputs
}

function transformMessage() {
	const inputs = parseInputs();
	const transformed = inputs.map((item, index) => {
		if (!item.date) {
			return {
				text: item.text,
				order: index,
				pause: {
					hour: item.hour,
					minute: item.minute,
					second: item.second
				}
			};
		}
		const date = transformData(item.date)
		return {
			text: item.text,
			order: index,
			time: date
		};
	});
	return transformed;
}

function transformData(dateValue) {
	if (!dateValue) {
		return null;
	}
	const [date, time] = dateValue.split(' ');
	const [hour, minute] = time.split(':');
	const [month, day, year] = date.split('-');
	return {
		year,
		month,
		day,
		hour,
		minute
	}
}

function submit(chainId) {
	loadingTrue()
	const inputTitle = document.getElementById('title');
	const inputStartTime = document.getElementById('date-piker-start-time')
	const messages = transformMessage()
	const startTime = inputStartTime.value;
	let transformStartTime = transformData(startTime)
	if (!startTimeChecker.checked) {
		transformStartTime = null
	}

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
		webinar_start_time: transformStartTime,
		stages: messages
	};

	fetch(`/chain/update-chain/${chainId}`, {
		method: 'PATCH',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
			"X-CSRF-Token": document.querySelector('input[name=_token]').value
		},
		body: JSON.stringify(data)
	}).then((res) => {
		if (res.status === 200) {
			location.href = "/chain";
		} else {
			alert("Ошибка при обновлении цепочки");
		}
	});
}
</script>
@endsection