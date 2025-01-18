<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function getAllUsers(){
        $users = User::all();
        return $users;
    }
    public function create(Request $request){
        $user = User::create($request->all());
        return "user added successfully";
    }
    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update($request->all());
        return "user update successfully";
}
    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return "user delete successfully";
    }
    public function show ($id){
        $user = User::findOrFail($id);
        return $user;
       
    }
    function authenticateUser(Request $request) {
        try {
            $user = User::where('email', $request->email)->firstOrFail();
            if ($request->password == $user->password) {
                return view('pages.home');
            } else {
                return response()->json(['error' => 'Invalid password'], 401);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}