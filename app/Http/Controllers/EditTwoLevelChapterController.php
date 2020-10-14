<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditTwoLevelChapterController extends Controller
{
    public function index($chapterNumber)
    {
        return view('edit-two-level-chapter', [
            "chapterNumber" => $chapterNumber,
            "thumbnails" => MediaController::getAllImages(),
        ]);
    }
}
