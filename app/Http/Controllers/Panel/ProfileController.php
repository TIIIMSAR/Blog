<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('panel.profile');
    }

    public function update(UpdateProfileRequest $request)
    {
        $data = $request->validated();

            if($request->password)
                $data['password'] = Hash::make($request->password);
            else 
                unset($data['password']);

            if($request->hasFile('profile')){

                $file = $request->file('profile'); // فایل اپلود شده با کلیداپلود در دسترس است
                $ext = $file->getClientOriginalExtension(); // پسوند فایل

                $file_name = auth()->user()->id . '_' .time() . '.' . $ext; // نام فایل کامل و یونیک شده
                $file->storeAs('images/users', $file_name, 'public_files');

                $data['profile'] = $file_name;
            }

            DB::table('users')
            ->where('id', auth()->id())
            ->update($data);

            session()->flash('status', 'اطلاعات کاربری شما ویرایش شد!');
        
        return back();
    }
}
