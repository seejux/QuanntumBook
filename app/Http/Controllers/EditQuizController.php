<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EditQuizController extends Controller
{
    public function index($quizNumber)
    {
        return view('edit-quiz', [
            "quizNumber" => $quizNumber,
            "thumbnails" => MediaController::getAllImages(),
        ]);

    }

    public function store(Request $request) {
        Storage::disk('public_uploads')->put('quizzes.xml', $request->input("text"));

        $currentTime = Carbon::now();
        Storage::disk('public_uploads')->put('quizzestimestamp.txt', $currentTime->toDateTimeString());

        return redirect()->to('/quizzes');
    }
}
