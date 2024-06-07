<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    
    public function index()
    {
        $users = User::all();
        return view('panel.users.index', compact('users'));
    }


    public function create()
    {
        return view('panel.users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:255', 'unique:users'],
            'role' => ['required', 'max:255'], 
        ]);

        $data = $request->only(['name', 'email', 'mobile', 'role']);
        $data['password'] = Hash::make('password');
            User::create($data);
        return redirect()->route('users.index');

    }

    public function show($id)
    {
      
    }


    public function edit($id)
    {
        return view('panel.users.edit');
    }

    public function update(Request $request, $id)
    {
       
    }

    public function destroy($id)
    {
    
    }
}
