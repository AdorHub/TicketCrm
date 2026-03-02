<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

	public function index()
	{
		return view('admin/auth/login');
	}
    /**
     * Handle the incoming request.
     */
    public function store(LoginRequest $request)
    {
        $this->service->login($request->validated());
		return redirect()->route('panel.dashboard.index');
    }
}
