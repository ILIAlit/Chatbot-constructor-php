@vite(['resources/css/app.css'])

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class='p-20'>
	<div>
		<nav class="navbar navbar-expand navbar-light bg-white topbar p-3 mb-2 static-top shadow">
			<div class="container-fluid">
				<a class="navbar-brand" href="/">
					<img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24"
						class="d-inline-block align-text-top">
					Bootstrap
				</a>
			</div>
		</nav>
	</div>
	<div class='d-flex align-items-start p-5'>
		<!-- <nav class='navbar-nav bg-gradient-primary sidebar sidebar-dark accordion' id='accordionSidebar'>
			<li class='nav-item active' href='chain'>Создать цепочку</li>
			<a href='trigger'>Создать триггер</a>
			<a href='bot'>Мои боты</a>
		</nav> -->
		<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<a href='/' class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
				data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
				aria-selected="true">Главная</a>
			<a href='chain' class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
				data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
				aria-selected="false">Создать цепочку</a>
			<button class="nav-link" id="v-pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#v-pills-disabled"
				type="button" role="tab" aria-controls="v-pills-disabled" aria-selected="false"
				disabled>Disabled</button>
			<button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"
				type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
			<button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"
				type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
		</div>
		<div>
			@yield('main')
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
	</script>
</body>

</html>