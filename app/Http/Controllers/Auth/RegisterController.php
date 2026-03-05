<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegisterService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @param RegisterService $service Service for handling user registration logic
	 */
	public function __construct(private RegisterService $service)
	{
		//
	}

	/**
	 * Display the user registration form.
	 *
	 * @return \Illuminate\Contracts\View\View View with the registration form
	 */
	public function index(): View
	{
		return view('admin/auth/register');
	}

	/**
	 * Process user registration.
	 *
	 * @param RegisterRequest $request Validated registration request with user data
	 * @return \Illuminate\Http\RedirectResponse Redirect to login page with success message
	 */
    public function store(RegisterRequest $request): RedirectResponse
	{
		$this->service->register($request->validated());
		return redirect()->route('login.index')->with('success', 'Регистрация прошла успешно!');
	}
}
