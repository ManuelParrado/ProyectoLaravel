<?php

namespace App\Http\Controllers;

use App\Http\Requests\APICategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class APICategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => 'true',
            'category' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(APICategoryRequest $request)
    {
        $request->validated();

        $category = Category::create($request->all());
        return response()->json([
            'status' => 'true',
            'category' => $category,
            'message' => 'Succesfull'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return response()->json([
            'status' => 'true',
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(APICategoryRequest $request, string $id)
    {
        $request->validated();

        $category = Category::find($id);
        $category->update($request->all());
        return response()->json([
            'status' => 'true',
            'category' => $category,
            'message' => 'Todo ha ido perfectamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json([
            'status' => 'true',
            'category' => $category,
            'message' => 'Todo ha ido perfectamente'
        ], 200);
    }
}
