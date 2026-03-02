<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegisterService;

class RegisterController extends Controller
{
	/**
	 * Create a new class instance.
	 */
	public function __construct(private RegisterService $service)
	{
		//
	}

	public function index()
	{
		return view('admin/auth/register');
	}

    public function store(RegisterRequest $request)
	{
		$this->service->register($request->validated());
		return redirect()->route('login.index')->with('success', 'Регистрация прошла успешно!');
	}
}
