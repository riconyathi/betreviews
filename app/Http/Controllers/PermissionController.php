<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function assignPermission(){

        
       return  auth()->user()->getRoleNames();
        //admin role
        //$role = Role::where('name','admin')->first();
        //dd($role);
        //$role->givePermissionTo('delete post');

        //moderator

        //editor

        //user
        //return response()->json(['message'=>'done done']);
    }
}
