<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Главная</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id='main-screen' class=''>
	<div id='loader' class='d-none'>
		<div class="loading-state">
			<div class="loading"></div>
		</div>
	</div>
	<header class="navbar navbar-expand navbar-light bg-black topbar p-3 static-top shadow">
		<div class="container-fluid">
			<a class="navbar-brand text-white" href="/">
				<!-- <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24"
					class="d-inline-block align-text-top"> -->
				Bootstrap
			</a>
		</div>
	</header>
	<div class="container-fluid">

		<div class="row flex-nowrap">
			<div class="col-auto col-md-3 bg-light shadow col-xl-2 px-sm-2 px-0 ">
				<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
					<a href="/"
						class="d-flex align-items-center mt-3 pb-3 mb-md-0 me-md-auto text-black text-decoration-none">
						<span class="d-none d-sm-inline h3">Меню</span>
					</a>
					<ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
						id="menu">
						<li>
							<a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
								<i class="fs-4 bi-bootstrap"></i> <span
									class="ms-1 h5 d-none d-sm-inline">Боты</span></a>
							<ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
								<li class="w-100">
									<a href="/" class="nav-link px-0"> <span class="d-none d-sm-inline text-black">Мои
											боты</span>
									</a>
								</li>
								<li>
									<a href="/bot/create" class="nav-link px-0"> <span
											class="d-none d-sm-inline text-black">Создать
											бота</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
								<i class="fs-4 bi-bootstrap"></i> <span
									class="ms-1 h5 d-none d-sm-inline">Цепочки</span></a>
							<ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
								<li class="w-100">
									<a href="/chain" class="nav-link px-0"> <span
											class="d-none d-sm-inline text-black">Мои
											цепочки</span>
									</a>
								</li>
								<li>
									<a href="/chain/create" class="nav-link px-0"> <span
											class="d-none d-sm-inline text-black">Создать
											цепочку</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
								<i class="fs-4 bi-bootstrap"></i> <span
									class="ms-1 h5 d-none d-sm-inline">Триггеры</span></a>
							<ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
								<li class="w-100">
									<a href="/trigger" class="nav-link px-0"> <span
											class="d-none d-sm-inline text-black">Мои
											триггеры</span>
									</a>
								</li>
								<li>
									<a href="/trigger/create-trigger" class="nav-link px-0"> <span
											class="d-none d-sm-inline text-black">Создать
											триггер</span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div id='main' class='col p-5'>
				@yield('main')
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
	</script>
</body>

</html>