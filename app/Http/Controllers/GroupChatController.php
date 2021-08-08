<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupChat;

class GroupChatController extends Controller
{
    public function index($id){

        $groupChat = GroupChat::where('group_id','=',$id)->get();

        return response()->json(['count'=> $groupChat->count(),'data'=>$groupChat], 200); 
    }

    public function store(Request $request){

        try {

            $this->validate($request,[
                'group_id' => 'required',
                'message'=> 'string',
                'media' => 'string'
            ]); 

            $request->user()->groupChat()->create([
                'group_id' => $request->group_id,
                'message' => $request->message,
                'media'=> $request->media
            ]);

            return response()->json(['message'=>'successful sent']);

        } catch (\Exception $e) {

            return response()->json(['message'=> $e->getMessage()]);
        }
    }

    public function destroy($id){

        try {
            $groupChat = GroupChat::findOrFail($id);
            if($groupChat->count() == 0 ){

                return response()->json(['message'=> 'message not found'],404);
                
            } else{

                $groupChat->delete(); 
            
                return response()->json(['message'=> 'Successfuly deleted message'],201);

            }

        } catch (\Exception $e) {

            return response()->json(['message'=> $e->getMessage()]);
        }
    }
}
