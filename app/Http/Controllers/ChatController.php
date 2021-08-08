<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{

    public function index($id){
        //remeber to define or to check both sent and received messages 
        $chat = Chat::where('recipient_id','=',$id)
                    ->where('user_id','=',auth()->user()->id)
                    ->get();

        return response()->json($chat); 
    }
    public function store(Request $request){

        try {

            $this->validate($request,[
                'recipient_id' => 'required',
                'message'=> 'string',
                'media' => 'string'
            ]); 

            $request->user()->chat()->create([
                'recipient_id' => $request->recipient_id,
                'message' => $request->message,
                'media'=> $request->media
            ]);

            return response()->json(['message'=>'message sent']);

        } catch (\Exception $e) {

            return response()->json(['message'=> $e->getMessage()]);
        }
    }

    public function destroy($id){

        try {
            $chat = Chat::findOrFail($id);
            if($chat->count() == 0 ){

                return response()->json(['message'=> 'message not found'],404);
                
            } else{

                $chat->delete(); 
            
                return response()->json(['message'=> 'Successfuly deleted message'],201);

            }

        } catch (\Exception $e) {

            return response()->json(['message'=> $e->getMessage()]);
        }
    }

    public function clearChat(Request $request){

        try {
            $chat = Chat::where('recipient_id','=',$request->recipient_id)
                    ->where('user_id','=',auth()->user()->id)
                    ->delete();
            
            
                return response()->json(['message'=> 'Successfuly cleared chat'],201);

        } catch (\Exception $e) {

            return response()->json(['message'=> $e->getMessage()]);
        }
    }
}
