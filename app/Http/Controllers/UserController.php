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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
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

            return to_route('user.index')->with('status', 'Usuario creado correctamente');
        } catch (QueryException $e) {
            //Si se hace mal manda un mensaje de error a la vista
            Log::error('Error al guardar el gasto: ' . $e->getMessage());
            // También puedes imprimir el mensaje de error
            echo 'Error en la base de datos: ' . $e->getMessage();
            // Redirecciona a la página anterior con un mensaje de error
            return back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
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

            return to_route('user.index')->with('status', 'Usuario editado correctamente');
        } catch (QueryException $e) {
            //Si se hace mal manda un mensaje de error a la vista
            Log::error('Error al guardar el gasto: ' . $e->getMessage());
            // También puedes imprimir el mensaje de error
            echo 'Error en la base de datos: ' . $e->getMessage();
            // Redirecciona a la página anterior con un mensaje de error
            return back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
