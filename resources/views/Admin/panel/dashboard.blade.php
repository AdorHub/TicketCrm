@extends('admin.layouts.panel.sidebar')

@section('links')
    @vite('resources/js/dashboard.js')
@endsection

@section('content')
<div class="container mx-auto p-8 bg-white rounded-lg shadow text-center space-y-8 text-gray-800">
	<h1 class="text-3xl font-medium text-center space-y-6 mb-6">Статистика</h1>
	<!-- Статистика -->
	<div class="flex flex-col md:flex-row flex-wrap gap-4 w-full font-bold text-xl">
		<div class="border border-gray-300 p-4 rounded-lg bg-gray-100 flex-1 min-w-50" id="today-box">
			<p>Сегодня</p>
			<h1 class="my-2" id="today-count">-</h1>
		</div>

		<div class="border border-gray-300 p-4 rounded-lg bg-blue-50 flex-1 min-w-50" id="week-box">
			<p>На этой неделе</p>
			<h1 class="my-2" id="week-count">-</h1>
		</div>

		<div class="border border-gray-300 p-4 rounded-lg bg-green-100 flex-1 min-w-50" id="month-box">
			<p>В этом месяце</p>
			<h1 class="my-2" id="month-count">-</h1>
		</div>

		<div class="border border-gray-700 p-4 rounded-lg bg-gray-800 text-white flex-1 min-w-50" id="total-box">
			<p class="text-gray-400 m-0">Всего заявок</p>
			<h1 class="my-2" id="total-count">-</h1>
		</div>
	</div>

	<!-- Активность -->
	<div class="mt-4">
		<h3 class="text-xl font-bold p-4">Активность сегодня относительно вчерашнего</h3>
		<div class="bg-gray-300 w-full h-5 rounded-full overflow-hidden">
			<div id="progress-bar" class="bg-green-500 h-full w-0 transition-all duration-300"></div>
		</div>
		<p id="diff-text" class="text-yellow-600 mt-2 text-md">Загружаю...</p>
	</div>
</div>
@endsection
