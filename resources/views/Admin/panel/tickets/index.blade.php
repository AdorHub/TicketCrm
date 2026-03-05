@extends('admin.layouts.panel.sidebar')

@section('content')
	{{-- Фильтры --}}
	<h1 class="text-3xl font-medium text-center space-y-6 mb-6">Фильтры</h1>
	<form action="{{ route('panel.tickets.index') }}" method="GET">
		<div class="w-full mx-auto bg-white rounded-lg shadow p-4 mb-8 grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-6 gap-4">
			<!-- Дата от -->
			<div class="flex flex-col text-left">
				<label for="from_date" class="block text-md font-medium text-gray-700">Дата от</label>
				<input type="date" id="from_date" name="from_date" class="px-3 py-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $filters['from_date'] ?? '' }}">
			</div>

			<!-- Дата до -->
			<div class="flex flex-col text-left">
				<label for="to_date" class="block text-md font-medium text-gray-700">Дата до</label>
				<input type="date" id="to_date" name="to_date" class="px-3 py-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $filters['to_date'] ?? '' }}">
			</div>

			<!-- Статус -->
			<div class="flex flex-col text-left">
				<label for="status" class="block text-md font-medium text-gray-700">Статус</label>
				<select id="status" name="status" class="px-3 py-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
					<option value="all" selected>Все</option>
					<option value="new" {{ (isset($filters['status']) && $filters['status'] == 'new') ? 'selected' : '' }}>Новый</option>
					<option value="processing" {{ (isset($filters['status']) && $filters['status'] == 'processing') ? 'selected' : '' }}>В процессе</option>
					<option value="processed" {{ (isset($filters['status']) && $filters['status'] == 'processed') ? 'selected' : '' }}>Обработаный</option>
				</select>
			</div>

			<!-- Email -->
			<div class="flex flex-col text-left">
				<label for="email" class="block text-md font-medium text-gray-700">Email</label>
				<input type="text" id="email" name="email" placeholder="Поиск по e-mail" class="px-3 py-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo focus:border-indigo-500 sm:text-sm" value="{{ $filters['email'] ?? '' }}">
			</div>

			<!-- Телефон -->
			<div class="flex flex-col text-left">
				<label for="phone" class="block text-md font-medium text-gray-700">Телефон</label>
				<input type="text" id="phone" name="phone" placeholder="Поиск по телефону" class="px-3 py-2 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo focus:border-indigo-500 sm:text-sm" value="{{ $filters['phone'] ?? '' }}">
			</div>

			<!-- Блок кнопок -->
			<div class="flex items-end justify-left gap-2 text-center">
				<button type="submit" class="px-4 py-2 bg-violet-600 text-white rounded-md hover:bg-violet-700 transition cursor-pointer flex-1">Применить</button>
				<a href="{{ route('panel.tickets.index') }}" class="px-4 py-2 bg-blue-300 text-white rounded-md hover:bg-blue-200 transition flex-1">Сбросить</a>
			</div>
		</div>
	</form>

	@if ($errors->any())
		<div class="text-red-500 text-center mb-3">
			@foreach ($errors->all() as $error)
				<p>{{ $error }}</p>
			@endforeach
		</div>
	@endif

	{{-- Список заявок --}}
	@if ($tickets->count() > 0)
		<h1 class="text-3xl font-medium text-center mb-6">Список Заявок</h1>
		<div class="w-full mx-auto bg-white shadow rounded-lg overflow-x-auto">
			<table class="min-w-full">
				<thead class="bg-blue-300">
					<tr>
						<th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Тема</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Дата</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Статус</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Телефон</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Действия</th>
					</tr>
				</thead>
				
				<tbody class="bg-white divide-y divide-gray-300">
					@foreach ($tickets as $ticket)
						<tr>
							<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $ticket->id }}</td>
							<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $ticket->subject }}</td>
							<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $ticket->created_at }}</td>
							<td class="px-6 py-4 whitespace-nowrap text-sm">
								<span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-800">{{ $ticket->status }}</span>
							</td>
							<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $ticket->customer->email }}</td>
							<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $ticket->customer->phone }}</td>

							<td class="px-6 py-4 whitespace-nowrap text-sm text-center">
								<a href="{{ route('panel.tickets.show', $ticket->id) }}" class="border text-blue-300 border-blue-300 text-lg p-2 hover:bg-blue-200 cursor-pointer font-bold transition-all">&raquo;</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		{{-- Пагинация --}}
		<div class="flex justify-center mt-4">
			<nav class="isolate inline-flex -space-x-px rounded-md" aria-label="Pagination">
				@if ($tickets->onFirstPage())
					<span class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 border border-gray-300 bg-gray-50 cursor-not-allowed" aria-disabled="true">
						<svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
							<path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
						</svg>
					</span>
				@else
					<a href="{{ $tickets->previousPageUrl() }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-black border border-gray-300 hover:bg-gray-100 focus:z-20">
						<svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
							<path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
						</svg>
					</a>
				@endif

				@php
					$start = max($tickets->currentPage() - 2, 1);
					$end = min($tickets->currentPage() + 2, $tickets->lastPage());
				@endphp
				@if ($start > 1)
					<a href="{{ $tickets->url(1) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-black border border-gray-300 hover:bg-gray-100 focus:z-20">1</a>
					@if ($start > 2)
						<span class="px-2 py-2 text-black">...</span>
					@endif
				@endif

				@for ($page = $start; $page <= $end; $page++)
					@if ($page == $tickets->currentPage())
						<span aria-current="page" class="relative z-10 inline-flex items-center bg-indigo-500 px-4 py-2 text-sm font-semibold text-white border border-gray-300">{{ $page }}</span>
					@else
						<a href="{{ $tickets->url($page) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-black border border-gray-300 hover:bg-gray-100 focus:z-20">{{ $page }}</a>
					@endif
				@endfor

				@if ($end < $tickets->lastPage())
					@if ($end < $tickets->lastPage() - 1)
						<span class="px-2 py-2 text-black">...</span>
					@endif
					<a href="{{ $tickets->url($tickets->lastPage()) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-black border border-gray-300 hover:bg-gray-100 focus:z-20">{{ $tickets->lastPage() }}</a>
				@endif

				@if ($tickets->hasMorePages())
					<a href="{{ $tickets->nextPageUrl() }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-black border border-gray-300 hover:bg-gray-100 focus:z-20">
						<svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
							<path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
						</svg>
					</a>
				@else
					<span class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 border border-gray-300 bg-gray-50 cursor-not-allowed" aria-disabled="true">
						<svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
							<path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
						</svg>
					</span>
				@endif
			</nav>
		</div>
	@else
		<h1 class="text-3xl font-medium text-center mb-6">Заявки отсутсвуют...</h1>
	@endif
@endsection

