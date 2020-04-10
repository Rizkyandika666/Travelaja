<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function page_rute(){
        return view('layouts.rute');
    }

    public function page_booking(){
        return view('layouts.booking');
    }

    public function page_bookingFixed(){
        return view('layouts.verifikasi');
    }

    public function page_booking_all(){
        return view('layouts.check_booking');
    }

    public function page_booking_confirm(){
        return view('layouts.booking_confirm');
    }
}
