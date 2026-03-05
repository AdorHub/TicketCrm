<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>
		@yield('title', 'Админ Панель')
	</title>
	@vite(['resources/css/app.css', 'resources/js/sidebar.js', 'resources/js/flashSessionMsg.js'])
	@yield('links')
</head>
<body class="bg-gray-100">
	<div id="sidebar" class="fixed top-0 left-0 h-full bg-white shadow sidebar w-64 z-99 flex flex-col">
		<div class="flex items-center justify-between p-2 md:p-4">
			<div id="logo-container" class="flex items-center gap-2">
				<div class="bg-violet-600 text-white font-bold text-xl w-8 h-8 flex items-center justify-center rounded-lg">
					{{ mb_substr(Auth::user()->name, 0, 1) }}
				</div>
				<div id="logo-text" class="hidden md:flex flex-col ml-2 space-y-1">
				<span class="font-semibold text-gray-800">
					{{ Auth::user()->name }}
				</span>
				<span class="text-sm text-gray-500">
					{{ Auth::user()->getRoleNames()->first() }}
				</span>
				</div>
			</div>
			<!-- Гамбургер -->
			<button id="toggleBtn" class="md:hidden p-1">
				<svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
				</svg>
			</button>
		</div>
		<!-- Меню -->
		<ul class="mt-4 space-y-2 px-2 md:px-4 flex-1 overflow-y-auto">
			<li class="flex items-center p-2 hover:bg-violet-50 hover:cursor-pointer rounded transition">
				<svg class="w-6 h-6 text-gray-500 {{ Request::routeIs('panel.dashboard.index') ? 'text-purple-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path d="M21 12l-9-9-9 9h3v8h12v-8h3z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<a href="{{ route('panel.dashboard.index') }}" class="ml-4 hidden md:inline">Dashboard</a>
			</li>
			<li class="flex items-center p-2 hover:bg-violet-50 hover:cursor-pointer rounded transition">
				<svg class="w-6 h-6 text-gray-500 {{ Request::routeIs('panel.tickets.*') ? 'text-purple-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path d="M3 17v-6a2 2 0 012-2h14a2 2 0 012 2v6M16 7V5a4 4 0 10-8 0v2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<a href="{{ route('panel.tickets.index') }}" class="ml-4 hidden md:inline">Tickets</a>
			</li>
		</ul>
		<!-- Нижняя часть -->
		<div class="mt-auto p-2 md:p-4">
			<form action="{{ route('logout') }}" method="POST">
				@csrf
				@method('DELETE')

				<button type="submit" class="flex items-center p-2 border border-red-500 rounded w-full justify-center md:justify-start gap-2 hover:cursor-pointer hover:bg-red-100 hover:scale-103 transition-all">
					<svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<span class="hidden md:inline text-red-500">Logout</span>
				</button>
			</form>

		</div>
	</div>
	<main id="content" class="transition-margin duration-300 ml-0 md:ml-64 p-4">
		@yield('content')
	</main>
	@yield('scripts')
</body>
</html>
