<?php

namespace App\Http\Controllers\Panel;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(7);
        $parentCategories = Category::where('category_id', null)->get();
        return view('panel.categories.index', compact('categories', 'parentCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories'],
            'category_id' => ['nullable', 'exists:categories,id']
        ]);
        Category::create(
            $request->only(['name', 'slug', 'category_id'])
        );
            session()->flash('status', 'دسته بندی با موفقیت ایجاد شد!');
            return back();
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::where('category_id', null)->where('id', '!=', $category->id)->get();
        return view('panel.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id']
        ]);
        
        $category->update(
            $request->only(['name', 'category_id'])
        );
        session()->flash('status', 'دسته بندی اپدیت شد!');
            return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('status', 'دسته بندی حذف شد!');

            return back();
    }
}
