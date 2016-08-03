<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\MilestoneUser;
use App\Models\Project;
use App\Models\Milestone;
use Response;
use Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::json([
            'users' => User::all(),
        ], 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * get current logged in user for profile
     */
    public function profile() {
        $users = Auth::guard('web')->user();

        return Response::json(['users' => $users], 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return Response::json($validator->errors(), 202, array(), JSON_PRETTY_PRINT);
        }
        

        $user = New User;

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = \Hash::make($request->get('password'));
        $user->position = $request->get('position');
        $user->is_admin = (!is_null($request->get('is_admin'))) ? $request->get('is_admin') : 0;

        $user->save();

        return Response::json(['message' => 'Succesfully Add new users.'], 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->position = $request->get('position');

        $user->save();

        return Response::json(['message' => 'Users Changed.'], 200, array(), JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return Response::json(['message' => "User Deleted!"], 200, array(), JSON_PRETTY_PRINT);
    }

    public function isAdmin() 
    {
        $user = Auth::guard('web')->user();
        return Response::json(['message' => 'Profile Changed.', 'is_admin' => $user->is_admin], 200, array(), JSON_PRETTY_PRINT);
    } 
}
