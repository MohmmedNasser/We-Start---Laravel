<?php

namespace App\Http\Controllers;

use App\Models\VideoUplado;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function upload(Request $request) {

        $request->validate([
            'myvideo' => 'required|mimes:mp4,mov,wmv,mkv',
        ]);

        $file = $request->file('myvideo');

        $filename = $file->getClientOriginalName();

        $path = $request->myvideo->move(public_path('public'), $filename);

        $video = new VideoUplado();

        $video->video = $path;

        $video->save();

        return redirect()->route('home');

    }
}
