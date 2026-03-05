<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
	/**
	 * Handle user logout process.
	 *
	 * @param Request $request The current HTTP request instance containing session data and CSRF token
	 * @return RedirectResponse Redirect response object that sends the user to the login form page with a fresh session
	 */
    public function __invoke(Request $request): RedirectResponse
    {
        Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect()->route('login.index');
    }
}
