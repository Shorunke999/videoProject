<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiController extends Controller
{
    public function paginate(){
        try{
            //$videoData = Http::get()->paginate();
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
