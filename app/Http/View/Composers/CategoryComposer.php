<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer 
{
    protected $categories;

    public function __construct()
    {
            // تگ های والد و with(children) => تگ فرزند 
        $this->categories = Category::with('children')->where('category_id', null)->get();
    }

    public function compose(View $view)
    {
        $view->with('categories', $this->categories);
    }
}