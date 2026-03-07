<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Заявка</title>
    @vite(['resources/js/widget.js', 'resources/css/app.css'])
</head>
<body class="m-0 p-0 bg-gray-50 min-h-screen flex flex-col items-center justify-center">
    <div class="w-full max-w-md p-4 sm:p-6 lg:p-8 mx-auto flex-1 flex flex-col justify-center">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-center text-gray-800 mb-4 sm:mb-6 lg:mb-8 self-start">Создать заявку</h2>
        <form action="{{ route('api.ticket.create') }}" method="POST" class="space-y-3 sm:space-y-4 lg:space-y-5 w-full flex-1 flex flex-col justify-between">
            <div class="space-y-3 sm:space-y-4 flex-1 min-h-50 lg:min-h-62.5">
                <div>
                    <label for="name" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Имя</label>
                    <input type="text" id="name" name="name" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 h-10 sm:h-11 lg:h-12" required />
                </div>

                <div>
                    <label for="email" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Почта</label>
                    <input type="email" id="email" name="email" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 h-10 sm:h-11 lg:h-12" required />
                </div>

                <div>
                    <label for="phone" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Номер телефона</label>
                    <input type="text" id="phone" name="phone" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 h-10 sm:h-11 lg:h-12" required />
                </div>

                <div>
                    <label for="subject" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Тема</label>
                    <input type="text" id="subject" name="subject" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 h-10 sm:h-11 lg:h-12" required />
                </div>

                <div>
                    <label for="text" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Содержание</label>
                    <textarea id="text" name="text" rows="4" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none h-24 sm:h-28 lg:h-32" placeholder="Опишите вашу проблему подробно..." required></textarea>
                </div>

                <div>
                    <label for="files" class="mb-2 block text-sm sm:text-base font-medium text-gray-700">Добавить файлы</label>
                    <input id="files" type="file" class="mt-2 block w-full text-sm file:mr-2 sm:file:mr-4 file:rounded-md file:border-0 file:bg-blue-500 file:py-2 file:px-3 sm:file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-600 focus:outline-none disabled:pointer-events-none disabled:opacity-60 transition-all duration-200" name="attachments[]" accept="image/*, audio/*, video/*, application/*" multiple />
                </div>
            </div>


            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 sm:py-4 lg:py-5 rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:-translate-y-0.5 active:translate-y-0 mt-4 self-end">Отправить</button>
            <div class="form-msg mt-4 p-3 rounded-md text-center text-sm min-h-10"></div>
        </form>
    </div>
</body>
</html>
