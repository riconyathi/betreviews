<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function store(Request $request,$slug)
    {
        $filename = null; 
        
        $request->validate([
            'comment' => 'required'
        ]);
        try {

            if($request->file('image')){

            
            $file = $request->file('image');
            // start
            $filename = time().'_'.$file->getClientOriginalName();
           
            $file->storeAs('comments', $filename, 'public');
             

            }
            // end

            $post = Post::where('slug',$slug)->first();
            
            Comment::create([
                'user_id' => auth()->user()->id,
                'post_id'=>$post->id,
                'comment' => $request->comment,
                'image'=> $filename
            ]);
    
            return response()->json([
                'message'=> 'you have added your comment'
            ],200);

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
            $comment = Comment::findOrFail($id);
            if ( $reply->user()->user_id == auth()->user()->id 
                || auth()->user()->getRoleNames() == 'admin'
                || auth()->user()->getRoleNames() == 'moderator'
                || auth()->user()->getRoleNames() == 'editor' ) {
            if($comment->count() != 0 ){
                $comment->delete();

                return response()->json([
                    'message' => 'You have succesfuly deleted comment!'
                ],203);
            }else{
                return response()->json(['message'=> 'comment not found'],404);
            }
        }
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]);  
        }
            
    }
}
