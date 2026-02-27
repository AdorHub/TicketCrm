<?php

use App\Http\Middleware\IsManagerMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->RedirectTo(guests: '/admin/register', users: '/admin/panel');

		$middleware->alias(['manager' => IsManagerMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
		if (!request()->is('/api/*')) {
			$exceptions->render(function (\Throwable $e) {
				Log::channel('exception')->error('[Исключение]: {message} Возникло в классе: {class} Файла: {file}:{line}.\nStack trace:\n{trace}', [
					'{message}' => $e->getMessage(),
					'{class}' => get_class($e),
					'{file}' => $e->getFile(),
					'{line}' => $e->getLine(),
					'{trace}' => $e->getTraceAsString(),
				]);

				switch (true) {
					case $e instanceof ValidationException:
						return redirect()->back()
							->withErrors($e->validator->messages())
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
			dd('API REQUEST EXCEPTION RESPONSE');
		}
    })->create();
