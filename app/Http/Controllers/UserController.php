<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('administration.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administration.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' =>  ['required', 'string', 'max:255'],
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => ['required', 'confirmed', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'role' => ['required', 'string', 'in:user,admin'],
        ]);

        try {

            $newUser = new User();

            $newUser->name = $request->name;
            $newUser->last_name = $request->last_name;
            $newUser->email = $request->email;
            $newUser->role = $request->role;
            $newUser->password = Hash::make($request->password);

            $newUser->save();

            return to_route('user.index')->with('status', 'User created successfully')->with('color', 'green');
        } catch (QueryException $e) {
            return to_route('user.index')->with('status', 'An error has occurred')->with('color', 'red');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('administration.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $request->validated();

        try {
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->role = $request->role;

            $user->save();

            return to_route('user.index')->with('status', 'User edited successfully')->with('color', 'green');
        } catch (QueryException $e) {
            return to_route('user.index')->with('status', 'An error has occurred')->with('color', 'red');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {

            $user->delete();
            return to_route('user.index')->with('status', 'User deleted successfully')->with('color', 'green');
        } catch (QueryException $e) {
            return to_route('user.index')->with('status', 'An error has occurred')->with('color', 'red');
        }
    }
}
