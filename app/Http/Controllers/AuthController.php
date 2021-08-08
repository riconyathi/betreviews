<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Socialite;
use App\Mail\MailUser;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function index(){
        
        try {
            $users = User::all();
            
            return $users;

        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]); 
        }
    }
 
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'surname' => 'required|string|min:2|max:255',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|min:5'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'surname' => $fields['surname'],
            'slug' => $fields['name']."".$fields['surname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        $user->assignRole('user');
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        //send email
        Mail::to($fields['email'])->send(new MailUser());
        //Mail::to()->send(new NewUserNotification);

        return response($response, 200);
    }

    public function login(Request $request) {

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|min:5'
        ]);

        // Check email
        $user = User::with('roles')->with('profile')->where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad login details'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function assignRole(Request $request){
        try {
            $user = User::findOrFail($request->user_id);
        
                    if($user->getRoleNames()->isEmpty()){
                    
                        $user->assignRole($request->role);
                        return response()->json(['message'=>'successfuly assigned role']);
                    } else if($user->getRoleNames()[0] != $request->role){
                        $user->removeRole($user->getRoleNames()[0]);
                        $user->assignRole($request->role);
                        return response()->json(['message'=>'successfuly assigned role']);
                         
                    }else{
                        return response()->json(['message'=>'Role already assigned to user']);
                    } 
            
        } catch (\Exception $e) {
            return response()->json(['message'=> $e->getMessage()]);  
        }
        

    }

    public function logout(Request $request) {
        
        auth()->user()->tokens()->delete();

        
        return response([
            'message' => 'Successfuly logged out'
        ], 200);
    }

    //get user data
    public function user($id) {

        if($id){

            return User::withCount('groups')->withCount('followers')->findOrFail($id);
            
        }else{

            return User::findOrFail(auth()->user()->id);
        }
        
        
    }
    public function getUser($slug) {

            return User::with('profile')->where('slug',"=","".$slug)->first();
        
    }

      //get user data
      public function updatePicture(Request $request,$id) {

        
        try {
            $filename = "";

           
            if ($request->file('files')) {
                $file = $request->file('files');
               $filename = time() . '_' . $file->getClientOriginalName();
                    
                 $file->storeAs('userprofile', $filename, 'public');

                 ProfileImage::create([
                    'user_id' => $id,
                    'path' => $filename

                ]);
                
            }

           
           
                

                return "done";
        
        } catch (\Exception $e) {
            return $e;
        }
       
        
    }

    public function updateProfile(Request $request,$slug) {

        
        try {
            
            $user = User::where('slug',"=","".$slug)->first();

            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->gender = $request->gender;
            $user->about = $request->about;

            $user->save();

        } catch (\Exception $e) {
            return $e;
        }
       
        
    }

    public function signinGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    
    public function githubRedirect()
    {
       
    }
}


