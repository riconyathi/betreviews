<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Following;

class FollowController extends Controller
{
    public function store(Request $request)
    {

        try {
            //check if user already followed 
            $follow = Following::where('following_id','=',$request->following_id)
                ->where('user_id','=',auth()->user()->id)->exists();

                //test this code please
            if(!$follow){
            Following::create([
                'user_id' => auth()->user()->id,
                'following_id' => $request->following_id
            ]);
    
            return response()->json([
                'message' => 'You have succesfuly followed!'
            ]);

            } else{
                Following::where('user_id', auth()->user()->id)
                    ->where('following_id', $request->following_id)
                    ->delete();
    
                return response()->json([
                    'message' => 'You have succesfuly unfollowed!'
                ]);  
            }
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]);
        }
        
    }

public function getFollowing(){



    return Following::with('user')
                    ->where('following_id',auth()->user()->id)
                    ->get();

   
}
public function getFollowers(){

    //->where('user_id',auth()->user()->id)

    return Following::with('user')
                    
                    ->get();

   
}

public function getAllFollowers(){

    // ->where('user_id',auth()->user()->id)
    //                 ->orWhere('following_id',auth()->user()->id)
    return Following::with('user')
                    
                    ->get(); 
}

      
    
}
