<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Заявка</title>
	@vite(['resources/js/widget.js', 'resources/css/app.css'])
</head>
<body class="m-0 p-0 bg-transparent">
	<div class="w-full max-w-md p-6 sm:p-8 mx-auto mt-[10%]">
		<h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Создать заявку</h2>
		<form action="{{ route('api.ticket.create') }}" method="POST" class="space-y-5" enctype="multipart/form-data">
			<div>
				<label for="name" class="block text-sm font-medium text-gray-700 mb-1">Имя</label>
				<input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required />
			</div>

			<div>
				<label for="email" class="block text-sm font-medium text-gray-700 mb-1">Почта</label>
				<input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required />
			</div>


			<div>
				<label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Номер телефона</label>
				<input type="text" id="phone" name="phone" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required />
			</div>

			<div>
				<label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Тема</label>
				<input type="text" id="subject" name="subject" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required />
			</div>

			<div>
				<label for="text" class="block text-sm font-medium text-gray-700 mb-1">Содержание</label>
				<input type="text" id="text" name="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required />
			</div>

			<div>
				<label for="files" class="mb-1 block text-sm font-medium text-gray-700">Добавить файлы</label>
				<input id="files" type="file" class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-blue-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-600 focus:outline-none disabled:pointer-events-none disabled:opacity-60 transition-all" name="attachments[]" accept="image/*, audio/*, video/*, application/*" multiple />
			</div>

			<button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md transition-all duration-200">Отправить</button>

			<div class="form-msg"></div>
		</form>
	</div>
</body>
</html>
