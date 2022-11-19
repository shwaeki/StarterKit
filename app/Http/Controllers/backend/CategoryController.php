<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:view-category');
        $this->middleware('permission:create-category', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-category', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-category', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        return view('backend.category.index');
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $request->merge(['added_by' => Auth::user()->id]);
        Category::create($request->all());
        flash('Category created successfully!')->success();
        return redirect()->route('category.index');
    }

    public function show(Category $category)
    {
        return back();
    }

    public function edit(Category $category)
    {
        $category->with('user');
        return view('backend.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        flash('Category updated successfully!')->success();
        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        flash('Category deleted successfully!')->info();
        return redirect()->route('category.index');
    }
}
