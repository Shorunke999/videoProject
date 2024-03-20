<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class apiController extends Controller
{
    public function paginate(){
        try{
            //$videoData = Http::get()->paginate(10);
            $videoData = 123;
            return response()->json(
                [
                    'data' => $videoData
                ]
            );
        }catch(\Exception $e){
            return response()->json([
                'errorMessage' => $e->getMessage()
            ]);
        }
        
    }
}
