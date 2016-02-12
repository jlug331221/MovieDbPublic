<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    /**
     * Create a new AdminController instance.
     *
     * AdminController constructor.
     */
    public function __construct() {
        $this->middleware('admin');
    }


    /**
     * Go to the admin dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $name = Auth::user()->name;
        return view('/admin/adminDash', compact('name'));
    }
}
