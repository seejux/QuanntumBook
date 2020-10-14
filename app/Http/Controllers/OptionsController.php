<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Auth;

class OptionsController extends Controller
{
  public function index()
  {
      return view('options');
  }

  public function changePassword(Request $request) {
    if (!(Hash::check($request->get('old-password'), Auth::user()->password))) {
        return view('options')->withErrors(['old-password' => 'Current password does not match']);
    }

    $validatedData = $request->validate([
        'old-password' => 'required',
        'new-password' => 'required|string|min:6|confirmed',
    ]);

    $user = Auth::user();
    $user->password = Hash::make($request->get('new-password'));
    $user->save();

    return view('home');
  }
}
