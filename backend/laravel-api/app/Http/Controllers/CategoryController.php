<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return response()->json(Category::orderBy('id_category', 'asc')->get());
    }

    public function store(CategoryRequest $categoryRequest)
    {
        $category = Category::create($categoryRequest->validated());

        return (new CategoryResource($category))
            ->additional([
                'status'  => true,
                'message' => 'Categoria creada correctamente'
            ]);
    }

    public function show(string $id)
    {
        //
    }

    public function update(CategoryRequest $categoryRequest, $id)
    {
        $category = Category::findOrFail($id);

        $category->update($categoryRequest->validated());

        return (new CategoryResource($category))
            ->additional([
                'status'  => true,
                'message' => 'Categoria actualizada correctamente',
            ]);
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Categoria borrada correctamente'
        ], 200);
    }
}
