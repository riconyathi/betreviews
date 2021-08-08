<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    
    public function store(Request $request)
    { 

        
        try {
            //check if user already like post
            $like = Like::where('post_id','=',$request->post_id)
                ->where('user_id','=',auth()->user()->id)->exists();
            
            if(!$like){
                Like::create([
                    'user_id' => auth()->user()->id,
                    'post_id' => $request->post_id
                ]);
        
                return response()->json([
                    'message' => 'You have succesfuly liked!'
                ],200);
            }else{
                Like::where('user_id', auth()->user()->id)
                    ->where('post_id', $request->post_id)
                    ->delete();

                    return [
                        'message' => 'You have succesfuly unliked!'
                    ];  
            }
           
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]);  
         }

        
    }

    
}
