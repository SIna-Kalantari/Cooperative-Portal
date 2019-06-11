<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
        $users = User::orderByRaw("name ASC, family ASC")->with(['role', 'expert'])->get();
        return view('users.index', compact('users'));
    }

    public function showAddUserForm(Request $request){
        $roles = \App\Role::get();
        $experts = \App\Expert::get();
        return view('users.add', compact('roles', 'experts'));
    }

    public function insert(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'family' => 'required',
            'phone' => 'required|digits:10|starts_with:9|unique:users',
            'isActive' => 'required|boolean',
            'roleId' => 'required|exists:roles,id',
            'expertId' => 'nullable|exists:experts,id',
        ], [], ['phone' => 'شماره همراه']);

        $user = new User($request->except(['_token']));
        $password = rand(111111,999999);
        $user->password = \Hash::make($password);
        if($user->save()){
            \App\Jobs\PasswordSmsSender::dispatchNow($user->phone, $password);
        }
        return redirect('users');
    }

    public function showEditUserForm(Request $request){
        $roles = \App\Role::get();
        $experts = \App\Expert::get();
        $user = User::find($request->id);
        return view('users.edit', compact('roles', 'experts', 'user'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'family' => 'required',
            'phone' => [
                'required',
                'digits:10',
                'starts_with:9',
                \Illuminate\Validation\Rule::unique('users')->ignore($request->id)
            ],
            'isActive' => 'required|boolean',
            'roleId' => 'required|exists:roles,id',
            'expertId' => 'nullable|exists:experts,id',
        ], [], ['phone' => 'شماره همراه']);

        $user = User::find($request->id);
        $user->update($request->except(['_token']));
        return redirect('users')->with('success', "اطلاعات حساب کاربری $user->name $user->family بروزرسانی شد.");
    }

    public function changeStatus(Request $request){
        $user = User::find($request->id);
        $user->isActive == 1 ? $user->update(['isActive' => 0]) : $user->update(['isActive' => 1]);
        return redirect('users')->with('success', "وضعیت حساب کاربری $user->name $user->family با موفقیت تغییر یافت.");
    }

}
