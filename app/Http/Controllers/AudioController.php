<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aud;

class AudioController extends Controller
{
    /**
     * Display the form for uploading audio.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('audio.create');
    }

    /**
     * Display a listing of uploaded audios.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all audio files from database
        $audios = Aud::all();

        return view('audio.index', compact('audios'));
    }

    /**
     * Handle audio file upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        $request->validate([
            'audio' => 'required|mimes:mp3,wav|max:30720', // Max 30MB for mp3 or wav files
        ]);

        $audio = $request->file('audio');
        $audioName = time().'.'.$audio->getClientOriginalExtension(); // Unique filename based on timestamp and original extension
        $audioPath = $audio->storeAs('public/audio', $audioName); // Store audio in /storage/app/public/audio directory

        // Save audio file details to database
        Aud::create([
            'file_name' => $audioName,
            'file_path' => $audioPath,
        ]);

        return back()->with('success', 'Audio uploaded successfully.')->with('audio', $audioName);
    }
}
