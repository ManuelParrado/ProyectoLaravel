<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $userExpenses = $user->expenses()->with('categories')->get();
        return view('project.index')->with('userExpenses', $userExpenses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allCategories = Category::all();
        return view('project.create')->with('allCategories', $allCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        $request->validated();

        try {
            $newExpense = new Expense();
            $newExpense->description = $request->description;
            $newExpense->amount = $request->amount;
            $newExpense->payment_method = $request->payment_method;
            $newExpense->user_id = Auth::id();

            $imageName = time() . "-" . $request->file('image')->getClientOriginalName();
            $newExpense->image = $imageName;

            $newExpense->save();

            $newExpense->categories()->sync($request->input('selected_categories'));
            $request->file('image')->storeAs('public/images', $imageName);

            return to_route('expense.index')->with('status', 'Coche insertado correctamente');
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
    public function show(Expense $expense)
    {
        $path = "storage/images/";
        return view('project.show')->with('expense', $expense)->with('path', $path);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $allCategories = Category::all();
        return view('project.edit')->with(['expense' => $expense, 'allCategories' => $allCategories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $request->validated();

        try {
            $expense->description = $request->description;
            $expense->amount = $request->amount;
            $expense->payment_method = $request->payment_method;
            $expense->user_id = Auth::id();

            // Si el usuario sube la foto, entonces:
            if (is_uploaded_file($request->file('image'))) {

                Storage::delete('public/images/' . $expense->image); // Borramos la foto antigua, ya que la vamos a sustituir
                $imageName = time() . "-" . $request->file('image')->getClientOriginalName(); // Creamos un nombre para la foto
                $expense->image = $imageName;
                $request->file('image')->storeAs('public\images', $imageName); // La subimos a la carpeta concreta

            }

            $expense->save();

            $expense->categories()->sync($request->input('selected_categories'));

            return to_route('expense.index')->with('status', 'Coche editado correctamente');
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
    public function destroy(Expense $expense)
    {
        try {
            $expense->delete();
            // Devolvemos un mensaje correcto en caso de que haya ido todo bien
            return to_route('expense.index')->with('status', 'Gasto borrado correctamente')->with('color', 'green');
        } catch (QueryException $e) {

            // Devolvemos un mensaje de error en caso de que algo haya ido mal
            return to_route('expense.index')->with('status', 'No se ha podido borrar el gasto')->with('color', 'red');
        }
    }
}
