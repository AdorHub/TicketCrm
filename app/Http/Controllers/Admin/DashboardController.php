<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	/**
	 * Show the admin panel dashboard view.
	 *
	 * @return \Illuminate\Contracts\View\View The dashboard view
	 */
    public function index()
	{
		return view('admin.panel.dashboard');
	}
}