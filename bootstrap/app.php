<?php

use App\Http\Middleware\IsManagerMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
		api: __DIR__.'/../routes/api.php',
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
		$middleware->RedirectTo(guests: '/admin/register', users: '/admin/panel');   

		$middleware->alias(['manager' => IsManagerMiddleware::class]);

		$middleware->validateCsrfTokens(except: ['api/*']);

		$middleware->group('api', [
			HandleCors::class
		]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
		if (!request()->is('api/*')) {
			// WEB HANDLING
			$exceptions->render(function (\Throwable $e) {
				Log::channel('exception')->error('[Исключение]: {message} Возникло в классе: {class} Файла: {file}:{line}.\nStack trace:\n{trace}', [
					'message' => $e->getMessage(),
					'class' => get_class($e),
					'file' => $e->getFile(),
					'line' => $e->getLine(),
					'trace' => $e->getTraceAsString(),
				]);

				switch (true) {
					case $e instanceof ValidationException:
						return redirect()->back()
							->withErrors($e->validator->messages)
							->withInput();

					case $e instanceof AuthenticationException:
						return redirect()->back()
							->withErrors(['password' => 'Почта или пароль указаны неверно'])
							->withInput();

					case $e instanceof HttpException:
						return response()->view('errors.' . $e->getStatusCode(), status: $e->getStatusCode());

					default:
						return redirect()->back()
							->withErrors(['error' => 'Произошла ошибка сервера. Повторите запрос позже'])
							->withInput();
				}
			});
		} else {
			// API HANDLING
			$exceptions->render(function (\Throwable $e) {
				Log::channel('api_exception')->error('[Исключение]: {message} Возникло в классе: {class} Файла: {file}:{line}.\nStack trace:\n{trace}', [
					'message' => $e->getMessage(),
					'class' => get_class($e),
					'file' => $e->getFile(),
					'line' => $e->getLine(),
					'trace' => $e->getTraceAsString(),
				]);
				switch (true) {
					case $e instanceof ThrottleRequestsException:
						return response()->json([
							'message' => 'Доступно лишь 1 заявку в сутки'
						], 429);
					case $e instanceof ValidationException:
						return response()->json([
							'message' => 'Ошибка валидации',
							'errors' => $e->errors()
						], 422);
					default:
						return response()->json([
							'message' => 'Ошибка сервера'
						], 500);
				}	
			});
		}
    })->create();
