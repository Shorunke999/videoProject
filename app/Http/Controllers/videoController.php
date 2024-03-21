<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\video;

class videoController extends Controller
{
    public function upload(Request $request){
        try{
            $validated = $request->validate(
                [
                    'title' => 'required|string',
                    'video' => 'required'
                ]
            );
            $videoPath = $request->file('video')->store('videos');
            $userId = auth()->user()->id;
            Video::create([
                'userId' => $userId,
                'title' => $request->title,
                'path' => $videoPath
            ]);
            return redirect()->back()->with('msg','upload succesfully' );
        }catch(\Exception $e){
            return redirect()->back()->with('msg', $e->getMessage());
        }
    }
    public function view(){
        return inertia('Dashboard');
    }
    public function play($url){
        return inertia('videoPlayer',['url' => $url]);
    }
}
