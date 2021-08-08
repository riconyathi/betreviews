<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\GroupChatController;
use App\Http\Controllers\CommentLikesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;


Route::get('/signin/github', [AuthController::class, 'signinGithub']);

Route::get('/sigin/github/redirect', [AuthController::class, 'githubRedirect']);
// Route::get('/auth/redirect', function () {
//     return Socialite::driver('github')->redirect();
// });

// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('github')->user();

//     // $user->token
// });


//auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']); //email and password

//get all post
Route::get('/posts',[PostController::class, 'index']);
Route::get('/user-posts',[PostController::class, 'userPosts']);
 //users for users not logged in 
Route::get('/users',[AuthController::class, 'index']);

Route::get('/user/{id}',[AuthController::class, 'user']);




Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('/user/{id}',[AuthController::class, 'updatePicture']);

    Route::get('/user/{slug}/data',[AuthController::class, 'getUser']);
    Route::post('/user/{slug}/update',[AuthController::class, 'updateProfile']);
    // auth routes 
    Route::post('/logout', [AuthController::class, 'logout']);
    //posts routes
    Route::get('/post/{slug}',[PostController::class, 'show']);
    Route::post('/post',[PostController::class, 'store']);
    Route::get('/post/search/{name}',[PostController::class, 'search']);
    Route::delete('/post/{id}',[PostController::class, 'destroy']);
    
    //comments routes
   // Route::get('/post/{id}/comments',[CommentController::class, 'index']);
    Route::post('/post/{slug}/comment',[CommentController::class, 'store']);
    Route::delete('/post/delete-comment/{id}',[CommentController::class, 'destroy']);

    //replies routes
   Route::get('/comment/{id}/replies',[RepliesController::class, 'index']);
   Route::post('/comment/{id}/reply',[RepliesController::class, 'store']);
   Route::delete('/comment/delete-reply/{id}',[RepliesController::class, 'destroy']);

    //group routes
    Route::get('/all-groups', [GroupController::class, 'groups']);
    Route::get('/groups', [GroupController::class, 'index']);
    Route::get('/my-groups', [GroupController::class, 'myGroups']);
    Route::post('/group/{slug}/cover', [GroupController::class, 'updateCover']);
    Route::post('/group/{slug}/update', [GroupController::class, 'updateGroup']);
    Route::post('/create/group', [GroupController::class, 'store']);
    Route::post('/group/{slug}/post',[PostController::class, 'groupPost']);
    // slug removed 
    Route::get('/my-groups-post', [PostController::class, 'getAllGroupPost']);
    Route::get('/group/{slug}/post',[PostController::class, 'getGroupPost']);
    Route::post('/group/{slug}/join',[GroupController::class, 'joinGroup']);
    Route::post('/group/{slug}/leave',[GroupController::class, 'leaveGroup']);
   
    Route::get('/group/search/{name}',[GroupController::class, 'search']);
    Route::get('/group/{slug}',[GroupController::class, 'groupDetails']);
    Route::get('/group/{slug}/members',[GroupController::class, 'groupMembers']);
    Route::get('/group/{slug}/is-member',[GroupController::class, 'isMember']);

    //follow user and unfollow
    Route::post('/follow',[FollowController::class, 'store']);
    Route::get('/following',[FollowController::class, 'getFollowing']);
    Route::get('/followers',[FollowController::class, 'getFollowers']);
    Route::get('/all-connections',[FollowController::class, 'getAllFollowers']);

    //like a post and unlike
    Route::post('/like',[LikeController::class, 'store']);

    //comment likes
    Route::post('/comment/like',[CommentLikesController::class, 'store']);
    
   

   //chats
    Route::get('/chat/{id}',[ChatController::class, 'index']);
    Route::get('/group/{id}/chat',[GroupChatController::class, 'index']);

    Route::post('/chat',[ChatController::class, 'store']);
    Route::post('/group/chat',[GroupChatController::class, 'store']);

    Route::delete('/chat/{id}',[ChatController::class, 'destroy']);
    Route::delete('/group/chat/{id}',[GroupChatController::class, 'destroy']);

    Route::post('/clear-chat',[ChatController::class, 'clearChat']); 

    Route::group(['middleware' => ['role:admin']], function () {
        //permissions
        Route::post('/role/permission',[PermissionController::class, 'assignPermission']);
        //delete group
        Route::delete('/group/{id}',[GroupController::class, 'kill']);
        //assign role to user
        Route::post('/users/role',[AuthController::class, 'assignRole']);
    });
    
 });
