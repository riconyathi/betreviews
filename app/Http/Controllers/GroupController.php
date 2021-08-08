<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupImage;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class GroupController extends Controller
{
  public function index(){

    
    return Group::with('profile')->get();
  }

  public function groupDetails($slug){

    return Group::withCount('users','posts')->with('profile')->where('slug',$slug)->first();
}


    
public function groupMembers($slug){

    return Group::with('users.profile')->where('slug',$slug)->first();
}

  public function myGroups(){
    
    $user = User::findOrFail(auth()->user()->id);
    $groups = $user->groups()
    ->wherePivot('user_id', '=', auth()->user()->id)
    ->get();

    return $groups;
}

    public function store(Request $request)
    {
     
       $this->validate($request,[
            'name' => 'required|string|max:255',
            'about' => 'required|string'
        ]);

        //creates a post using the user and post relationship
       $group = Group::create([
            'name' => $request->name,
            'slug' => $request->name,
            'about'=>$request->about
        ]);
        
        //dd(auth);
        $group->users()->attach(auth()->user()->id);

        return [
            'message'=> 'group successfuly created '.$group->name
        ];

    }

    public function joinGroup(Request $request, $slug)
    {
        try {

            $group = Group::where('slug',$slug)->first();            
           
                
                //check if already joined group
                $hasJoined = $group->users()->where('id',auth()->user()->id)->exists();
                if(!$hasJoined){

                    $group->users()->attach(auth()->user()->id);

                    return response()->json([
                        'message' => 'You have succesfuly joined '.$group->name
                    ],200);
                }else{
                    return response()->json([
                        'message' => 'You already part of the group'.$group->name
                    ],200); 
                }
                
                
           
            

        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]);  
        }
        

    }

    public function leaveGroup(Request $request, $slug)
    {
        try {
            $group = Group::where('slug',$slug)->first();
            if ($group->count()!= 0) {
                $group->users()->detach(auth()->user()->id);
                return response()->json([
                    'message' => 'You have succesfuly left '.$group->name
                ],200);
            } else {
                return response()->json([
                    'message' => 'You have already left group '.$group->name
                ],200); 
            }
            
            
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()],404);  
        }
    
    }

    public function kill($id)
    {

        
        try {
            $group = Group::findOrFail($id);
            
                $group->delete();
                
                return response()->json([
                    'message' => 'You have succesfuly Deleted '.$group->name
                ],203);
            
            
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]); 
        }
       
    }

    public function search($name)
    {
        try {
            $group = Group::where('name','like','%'.$name.'%')->get();
            if ($group->count()!=0) {
                return response()->json(['count'=> $group->count() ,'data'=>$group], 200);
                
            } else {
                return response()->json(['count'=> $group->count() ,'message'=> 'No groups have been found','data'=>$group], 404);
            }
                     
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]);   
        }
        
    }

    public function updateCover(Request $request,$slug)
    {
        try {
            $filename = "";

           
            if ($request->file('files')) {
                $file = $request->file('files');
               $filename = time() . '_' . $file->getClientOriginalName();
                    
                 $file->storeAs('groupprofile', $filename, 'public');

                 $group = Group::where('slug',$slug)->first();

                 GroupImage::create([
                    'group_id' => $group->id,
                    'path' => $filename

                ]);
                
            }

           
                return "done";
        
        } catch (\Exception $e) {
            return $e;
        }
        
    }

    
    public function updateGroup(Request $request,$slug)
    {
        try {
          

                 $group = Group::where('slug',$slug)->first();
                                
                $group->name = $request->name;
                $group->about = $request->about;

                $group->save();
                
                return "done";
        
        } catch (\Exception $e) {
            return $e;
        }
        
    }

    
    public function groups()
    {
        try {
           $group = Group::with('profile')->get();

           return  $group;
        
        } catch (\Exception $e) {
            return $e;
        }
        
    }

    public function isMember($slug)
    {
        try {
            $hasJoined = 0;
           $group = Group::with('users')->where('slug',$slug)->first();
            foreach ($group->users as $user) {
                if($user->id == auth()->user()->id){
                    return $hasJoined = 1;
                }
            }
          
           return $hasJoined;
           
        
        } catch (\Exception $e) {
            return $e;
        }
        
    }

    
}
