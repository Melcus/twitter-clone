<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index()
    {
        return view('home');
    }
}
