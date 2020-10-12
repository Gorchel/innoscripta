<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Main Controller for home page
 *
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('layout.main');
    }
}
