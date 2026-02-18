<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
		$exceptions->render(function (\Throwable $e) {
				Log::channel('my_exception')->error('[Error]: {message} occurred in class {class} at file {file}:{line}.\nStack trace:\n{trace}', [
					'{message}' => $e->getMessage(),
					'{class}' => get_class($e),
					'{file}' => $e->getFile(),
					'{line}' => $e->getLine(),
					'{trace}' => $e->getTraceAsString(),
				]);
			return redirect()->back()
				->with('error', 'Произошла ошибка сервера. Повторите запрос позже')
				->withInput();
		});
    })->create();
