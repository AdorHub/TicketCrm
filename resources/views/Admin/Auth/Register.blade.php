<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin Register Page</title>
	@vite(['resources/css/app.css'])
</head>
<body class="h-full">
	<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
	<div class="sm:mx-auto sm:w-full sm:max-w-sm">
		<h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">Присоединиться к системе</h2>
		@if (session('error'))
			<p class="text-red-500! mt-5 text-center font-bold">{{ session('error') }}</p>
		@endif
	</div>

	<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
		<form action="{{ route('register.store') }}" method="POST" class="space-y-6">
			@csrf
			<div>
				<label for="name" class="block text-sm/6 font-medium text-gray-100">Имя</label>
				<div class="mt-2">
					<input id="name" type="name" name="name" required autocomplete="name" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" value="{{ old('name') }}" />
				</div>
				@error('name')
					<p class="text-red-500">{{ $message }}</p>
				@enderror
			</div>

			<div>
				<label for="email" class="block text-sm/6 font-medium text-gray-100">Email</label>
				<div class="mt-2">
					<input id="email" type="email" name="email" required autocomplete="email" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" value="{{ old('email') }}" />
				</div>
				@error('email')
					<p class="text-red-500">{{ $message }}</p>
				@enderror
			</div>

			<div>
				<div class="flex items-center justify-between">
					<label for="password" class="block text-sm/6 font-medium text-gray-100">Пароль</label>
				</div>
				<div class="mt-2">
					<input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
				</div>
				@error('password')
					<p class="text-red-500">{{ $message }}</p>
				@enderror
			</div>

						<div>
				<div class="flex items-center justify-between">
					<label for="password" class="block text-sm/6 font-medium text-gray-100">Повторите пароль</label>
				</div>
				<div class="mt-2">
					<input id="password" type="password" name="password_confirmation" required autocomplete="current-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
				</div>
			</div>

			<div>
				<button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 hover:cursor-pointer">Зарегистрироваться</button>
			</div>
		</form>

		<p class="mt-10 text-center text-sm/6 text-gray-400">
		Уже зарегистрированы? 
		<a href="{{ route('login.index') }}" class="font-semibold text-indigo-400 hover:text-indigo-300">Вход</a>
		</p>
	</div>
	</div>
</body>
</html>