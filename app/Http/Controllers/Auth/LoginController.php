<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @param LoginService $service Service for handling login business logic
	 */
	public function __construct(private LoginService $service)
	{
		//
	}

	/**
	 * Display the login form.
	 *
	 * @return \Illuminate\Contracts\View\View View with the login form
	 */
	public function index(): View
	{
		return view('admin/auth/login');
	}

	/**
	 * Process user login.
	 *
	 * @param LoginRequest $request Validated login request with credentials
	 * @return \Illuminate\Http\RedirectResponse Redirect to the dashboard after successful login
	 */
    public function store(LoginRequest $request): RedirectResponse
    {
        $this->service->login($request->validated());
		return redirect()->route('panel.dashboard.index');
    }
}
