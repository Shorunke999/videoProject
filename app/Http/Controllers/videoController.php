<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\video;

class videoController extends Controller
{
    public function upload(Request $request){
        try{
            $validated = $request->data->validate(
                [
                    'title' => 'required|string',
                    'video' => 'required|mimes:mp4|max:2048'
                ]
            );
            $videoPath = $request->data->file('video')->store('videos');
            $userId = auth()->user()->id;
            Video::create([
                'userId' => $userId,
                'title' => $request->data->title,
                'path' => $videoPath
            ]);
            return redirect()->back()->with('msg','upload succesfully');
        }catch(\Exception $e){
            return redirect()->back()->with('msg', $e->getMessage());
        }
    }
}
