@extends('admin.layouts.panel.sidebar')

@section('content')
	<div class="container mx-auto p-8 bg-white rounded-lg shadow">
		<a href="{{ route('panel.tickets.index') }}" class="bg-violet-500 hover:bg-violet-400 transition-all text-white underline px-2 py-1 rounded-sm">Назад</a>
		<div class="border-b-2 border-violet-500 pb-3 mt-3">
			<form action="{{ route('panel.tickets.updateStatus', $ticket) }}" method="post" class="flex items-center gap-5">
				@method('PATCH')
				@csrf				
				<label for="status" class="text-gray-800 font-bold text-lg">Обновить статус</label>
				<select id="status" name="status" class="border-gray-300 rounded-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
					<option value="new" {{ $ticket['status'] == 'new' ? 'selected' : '' }}>Новый</option>
					<option value="processing" {{ $ticket['status'] == 'processing' ? 'selected' : '' }}>В процессе</option>
					<option value="processed" {{ $ticket['status'] == 'processed' ? 'selected' : '' }}>Обработаный</option>
				</select>
				<button type="submit" class="text-sm bg-blue-400 rounded-sm p-1 text-white cursor-pointer hover:bg-blue-500">Сохранить</button>
				@if (session('success'))
					<p class="success-msg text-green-500 text-center">{{ session('success') }}</p>
				@endif
			</form>
		</div>

		@error('status')
			<p class="text-red-500 text-center">{{ $message }}</p>
		@enderror

		<div class="text-xl space-y-3">
			<p class="text-gray-800 font-bold mt-3">Дата заявки</p>
			<p class="text-gray-800">{{ ucfirst(\Carbon\Carbon::parse($ticket->created_at)->locale('ru')->isoFormat('D MMMM YYYY')) }}</p>

			<p class="text-gray-800 font-bold">Тема:</p>
			<p class="text-gray-800">{{ $ticket->subject }}</p>

			<p class="text-gray-800 font-bold">Содержание:</p>
			<p class="text-gray-800">{{ $ticket->text }}</p>

			<div class="container">
				@if (!empty($files))
					@foreach ($files as $collectionName => $items)
						@if (count($items))
							<p class="text-gray-800 font-bold">Прикреплённые файлы заявки №{{ $ticket->id }}</p>
							<div>
								<h2 class="font-bold italic my-2">{{ ucwords($collectionName) }}:</h2>
								@foreach ($items as $item)
									<div class="flex flex-row justify-between space-y-2">
										<p>&bull; {{$item->file_name}}</p>
										@if (in_array($item->mime_type, ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif', 'application/pdf']))
											<div>
												<a href="{{ route('media.show', ['media' => $item->id]) }}" target="_blank" class="bg-blue-300 p-1 text-sm text-white font-medium hover:bg-blue-400 transition-all visited:bg-gray-300 rounded-sm">Просмотреть</a>
												<a href="{{ route('media.download', ['media' => $item->id]) }}" class="bg-green-300 p-1 text-sm text-white font-medium hover:bg-green-400 transition-all visited:bg-gray-300 rounded-sm">Скачать</a>
											</div>											
										@else
											<div>
												<a href="{{ route('media.download', ['media' => $item->id]) }}" class="bg-green-300 p-1 text-sm text-white font-medium hover:bg-green-400 transition-all visited:bg-gray-300 rounded-sm">Скачать</a>
											</div>											
										@endif
										</div>
								@endforeach
							</div>
						@endif
					@endforeach
				@endif
			</div>
		</div>
	</div>
@endsection


