<?php

namespace App\Http\Controllers\Panel;

use App\Models\Catagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatagoryController extends Controller
{

    public function index()
    {
        return view('panel.categories.index');
    }

    public function store(Request $request)
    {
        //
    }


    public function update(Request $request, Catagory $catagory)
    {
        //
    }

    public function destroy(Catagory $catagory)
    {
        //
    }
}
