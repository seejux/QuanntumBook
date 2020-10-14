<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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

    public function store(Request $request) {
        Storage::disk('public_uploads')->put('options.xml', $request->input("text"));

        $currentTime = Carbon::now();
        Storage::disk('public_uploads')->put('optionstimestamp.txt', $currentTime->toDateTimeString());

        return redirect()->to('/home');
    }
}
