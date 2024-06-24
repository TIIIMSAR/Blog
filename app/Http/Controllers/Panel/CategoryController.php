<?php

namespace App\Http\Controllers\Panel;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Category\CategoryCreateRequest;
use App\Http\Requests\Panel\Category\CategoryUpdeteRequest;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(7);
        $parentCategories = Category::where('category_id', null)->get();
        return view('panel.categories.index', compact('categories', 'parentCategories'));
    }

    public function store(CategoryCreateRequest $request)
    {
        Category::create(
            $request->validated()
        );
            session()->flash('status', 'دسته بندی با موفقیت ایجاد شد!');
            return back();
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::where('category_id', null)->where('id', '!=', $category->id)->get();
        return view('panel.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(CategoryUpdeteRequest $request, Category $category)
    {
        $category->update(
            $request->validated()
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
