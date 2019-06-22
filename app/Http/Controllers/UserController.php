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

    public function insert(\App\Http\Requests\UserInsertRequest $request){
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

    public function update(\App\Http\Requests\UserInsertRequest $request){
        $user = User::find($request->id);
        $user->update($request->except(['_token']));
        return redirect('users')->with('success', "اطلاعات حساب کاربری $user->name $user->family بروزرسانی شد.");
    }

    public function changeStatus(Request $request){
        $user = User::find($request->id);
        $user->isActive == 1 ? $user->update(['isActive' => 0]) : $user->update(['isActive' => 1]);
        return redirect('users')->with('success', "وضعیت حساب کاربری $user->name $user->family با موفقیت تغییر یافت.");
    }

    public function delete(Request $request){
        $user = User::find($request->id);
        if(!$user){
            return redirect()->back()->with('fail', 'شناسه کاربر مورد نظر یافت نشد.');
        }
        $user->delete();
        return redirect()->back()->with('success', "کاربر مورد نظر با موفقیت حذف گردید.");
    }

}
