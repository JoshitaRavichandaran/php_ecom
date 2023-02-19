<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::all();
        return $users;
    }



    public function userProducts($id)
    {
        $data=User::find($id)->products()->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        $user = new User;

        $user->name=$request->name;
        $user->email=$request->email;
        $user->contact=$request->contact;
        $user->password=Hash::make($request->password);
        $user->save();

        return["success"=>true,"message"=>"User registered"];

    }




    public function login(Request $request)
    {
        $credentials=$request->only(['email','password']);

        if(Auth::attempt($credentials))
        {
            $token=$request->user()->createToken('login_token')->plainTextToken;
            return ["token"=>$token,"user"=>["id"=>$request->user()->id,"user"=>$request->user()->name]];
        } 
        else{
            return "Some problem";
        }
    }


    // public function userProducts($id)
    // {
    //     $data=User::find($id)->products()->get();
    //     return $data;
    // }



   

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=User::find($id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->contact=$request->contact;
        $user->password=Hash::make($request->password);
        $user->save();

        return["success"=>true,"message"=>"User Updated"];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
