<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChaptersController extends Controller
{
    public function index()
    {
        return view('chapters');
    }
}
