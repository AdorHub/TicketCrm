<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;

class LoginController extends Controller
{
	/**
	 * Injects the service for handling business logic.
	 */
	public function __construct(private LoginService $service)
	{
		//
	}
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $this->service->login($request->validated());
		return redirect()->route('panel.index');
    }
}
