<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->RedirectTo(guests: '/admin/register', users: '/admin/panel');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
		$exceptions->render(function (\Throwable $e) {
				Log::channel('my_exception')->error('[Исключение]: {message} Возникло в классе: {class} Файла: {file}:{line}.\nStack trace:\n{trace}', [
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

					default:
						return redirect()->back()
							->withErrors(['error' => 'Произошла ошибка сервера. Повторите запрос позже'])
							->withInput();
				}		
		});
    })->create();
