<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EditChapterController extends Controller
{
    public function index($chapterNumber, $subChapterNumber = null)
    {
        return view('edit-chapter', [
            "chapterNumber" => $chapterNumber,
            "subChapterNumber" => $subChapterNumber,
            "thumbnails" => MediaController::getAllImages(),
        ]);

    }

    public function store(Request $request) {
        // Saving about page
        if($request->input("chapterNumber") == "0") {
          Storage::disk('public_uploads')->put('about.xml', $request->input("text"));

          $currentTime = Carbon::now();
          Storage::disk('public_uploads')->put('abouttimestamp.txt', $currentTime->toDateTimeString());

          return redirect()->to('/edit-chapter/0');
        }

        Storage::disk('public_uploads')->put('chapters.xml', $request->input("text"));

        $currentTime = Carbon::now();
        Storage::disk('public_uploads')->put('chapterstimestamp.txt', $currentTime->toDateTimeString());

        if($request->input("redirectionURL") === "undefined" || $request->input("redirectionURL") == null) {
          if($request->input("subChapterNumber") != "0") return redirect()->to('/edit-two-level-chapter/'. $request->input("chapterNumber"));
          return redirect()->to('/chapters');
        }

        return redirect()->to($request->input("redirectionURL"));
    }
}
