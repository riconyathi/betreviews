<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentLikes;

class CommentLikesController extends Controller
{
    public function store(Request $request)
    {
        try {
            //check if user already like post
            $like = CommentLikes::where('comment_id','=',$request->comment_id)
                ->where('user_id','=',auth()->user()->id)->exists();
            if(!$like){

                CommentLikes::create([
                    'user_id' => auth()->user()->id,
                    'comment_id' => $request->comment_id
                ]);
        
                return response()->json([
                    'message' => 'You have succesfuly liked!'
                ]);

            }else{
                CommentLikes::where('user_id', auth()->user()->id)
                    ->where('comment_id', $request->comment_id)
                    ->delete();

                return response()->json([
                    'message' => 'You have succesfuly unliked!'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]); 
        }
        
    }

   

    
}
