<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Aud;

// class AudioController extends Controller
// {
//     public function create()
    // {
    //     return view('audio.create');
    // }

    // public function index()
    // {
    //     return view('audio.index');
    // }

    // public function upload(Request $request)
    // {
    //     $request->validate([
    //         // 'audio' => 'required|mimes:mp3,wav',
    //         'audio' => 'required|mimes:mp3,wav|max:30720', // 30MB maximum size for audio file
    //     ]);

//         $audio = $request->file('audio');
//         $audioName = time().'.'.$audio->extension();
//         // $audioBlob->getClientOriginalExtension();
//         $audioPath = $audio->storeAs('audio', $audioName, 'public');

//         // Save to database
//         Aud::create([
//             'file_name' => $audioName,
//             'file_path' => $audioPath,
//         ]);

//         return back()->with('success', 'Audio uploaded successfully.')->with('audio', $audioName);
//     }
// }



// app/Http/Controllers/AudioController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aud;

class AudioController extends Controller
{
    public function create()
    {
        return view('audio.create');
    }

    public function index()
    {
        $audios = Aud::all();
        return view('audio.index', compact('audios'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'audio' => 'required|mimes:mp3,wav,aac,flac,webm|max:60720', // Adjust max size as needed
        ]);

        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audioName = time().'.'.$audio->getClientOriginalExtension();
            $audioPath = $audio->storeAs('audio', $audioName, 'public');

            Aud::create([
                'file_name' => $audioName,
                'file_path' => $audioPath,
            ]);

            return back()->with('success', 'Audio uploaded successfully.')->with('audio', $audioName);
        }

        return back()->with('error', 'File upload failed.');
    }
}
