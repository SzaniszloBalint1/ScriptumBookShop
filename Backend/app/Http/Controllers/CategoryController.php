<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return new CategoryCollection(Category::with('books')->get());
    }

    public function store(CategoryRequest $request)
    {
        $fields = $request->validated();
        $category = Category::create([
            'categoryname' => $fields['categoryname'],
        ]);

        return new CategoryResource($category);
    }

    public function show(string $id)
    {
        $category = Category::with('books')->find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $fields = $request->validated();
        $category->update([
            'categoryname' => $fields['categoryname'],
        ]);

        return new CategoryResource($category);
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();
        return response(null, 204);
    }
}
