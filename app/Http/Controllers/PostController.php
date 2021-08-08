<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Images;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = Post::orderBy('id', 'DESC')->with('images','comments','group','user.profile')
                        ->withCount('likes','comments')->get();
           

                return response()->json($posts);
            
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
    //user posts
    public function userPosts()
    {
        try {
            $posts = Post::with('comments')->withCount('likes')
                ->where('user_id', '=', auth()->user()->id)
                ->get();;
            if ($posts->count() == 0) {

                return response()->json(['count' => $posts->count(), 'message' => 'No post have been found', 'data' => $posts], 404);
            } else {
                return response()->json(['count' => $posts->count(), 'data' => $posts], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check for links if just a user
        try {
            $pics = [];
            if ($request->file('files')) {
                foreach ($request->file('files') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    //$file->move(public_path('posts'),$filename);
                    $file->storeAs('posts', $filename, 'public');
                    $pics[] = $filename;
                }
            }
            $post =  $request->user()->post()->create([
                'body' => $request->body,
                'group_id'=> 0,
                'slug' => $request->body
            ]);

            for ($i = 0; $i < count($pics); $i++) {
                Images::create([
                    'post_id' => $post->id,
                    'path' => $pics[$i]
                ]);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $post = Post::withCount('comments')->withCount('likes')
                    // ->with('comments')->with('user')
                    ->where('slug', $slug)
                    ->with('images','comments.user.profile','comments.likes','group','user.profile')
                    ->first();
            if ($post->count() == 0) {

                return response()->json(['message' => 'No post have been found', 'data' => $post], 404);
            } else {
                return response()->json($post, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $images = [];
            $post = Post::with('images')->where('id',$id)->first();

            
            if (
                $post->user_id  == auth()->user()->id 
                || auth()->user()->hasRole('admin') 
                ) {
        
        foreach ($post->images as $image) {
           $images[] = "posts/".$image->path; 
        }
           
           
            Storage::delete($images);
            $post->images()->delete();

            // ends
             $post->delete();

            return response()->json('Post delete succesfuly');
            }
            }
         catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * search post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        try {
            $posts = Post::where('body', 'like', '%' . $name . '%')->get();
            if ($posts->count() == 0) {

                return response()->json(['message' => 'Post not found'], 404);
            } else {

                return response()->json(['count' => $posts->count(), 'data' => $posts], 200);
            }
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function groupPost(Request $request, $slug)
    {
        //check for links if just a user
        try {
            $pics = [];
            if ($request->file('files')) {
                foreach ($request->file('files') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    //$file->move(public_path('posts'),$filename);
                    $file->storeAs('posts', $filename, 'public');
                    $pics[] = $filename;
                }
            }
            $group = Group::where('slug', $slug)->first();
            $post =  $request->user()->post()->create([
                'body' => $request->body,
                'slug' => $request->body,
                'group_id'=> $group->id
            ]);

            for ($i = 0; $i < count($pics); $i++) {
                Images::create([
                    'post_id' => $post->id,
                    'path' => $pics[$i]
                ]);
            }


            return response()->json([
                'message' => 'Group post succesfully created'
            ], 200);
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function getGroupPost($slug)
    {
        try {
           $group = Group::where('slug',$slug)->first();

            $posts = Post::where('group_id',$group->id)
                    ->orderBy('id', 'DESC')
                    ->with('images','comments','group','user.profile')
                    ->withCount('likes')
                    ->withCount('comments')->get();
           
                return response()->json($posts);
            
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function getAllGroupPost()
    {
        try {
           
            $posts = Post::where('group_id' ,'<>', 0)
                    ->with('images','comments.replies','group.profile','user')
                    ->withCount('likes','comments')
                    ->get();
           
                return response()->json($posts);
            
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }


}
