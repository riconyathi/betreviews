<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Comment;


class RepliesController extends Controller
{

    public function index($id){
        $replies = Reply::with('users')->where('comment_id', $id)->get();
        

        return $replies;
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $request->validate([
            'reply'=>'required'
        ]);

        try {
            $filename = null;
            $comment = Comment::findOrFail($id);
           
                if($request->file('image')){

            
                    $file = $request->file('image');
                    // start
                    $filename = time().'_'.$file->getClientOriginalName();
                   
                    $file->storeAs('replies', $filename, 'public');
                     
        
                }
                    // end

                Reply::create([
                    'user_id' => auth()->user()->id,
                    'comment_id'=>$id,
                    'reply' => $request->reply,
                    'image'=> $filename
                ]);
        
                return response()->json([
                    'message'=> 'you have added your replied'
                ]); 
             
            
                      
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]); 
        }
        
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            $reply = Reply::findOrFail($id);
                if ( $reply->user()->user_id == auth()->user()->id 
                || auth()->user()->getRoleNames() == 'admin'
                || auth()->user()->getRoleNames() == 'moderator'
                || auth()->user()->getRoleNames() == 'editor' ) {
               
                    if($reply->count()!= 0 ){
                        $reply->delete();

                        return response()->json([
                            'message' => 'You have succesfuly deleted reply!'
                        ]);
                    }else{
                        return response()->json([
                            'message' => 'Reply not found!'
                        ]);  
                    }
                }
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]);  
        }
       
    }
}
