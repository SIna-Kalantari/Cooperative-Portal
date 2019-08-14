<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Role;
use App\Accessibility;

class RoleController extends Controller
{
    public function showRole(Request $request){
        $roles = Role::with('roleAccess')->get();
        $accessibility = Accessibility::get();
        return view('roles.role', compact('roles', 'accessibility'));
    }

    public function insertRole(Request $request){
        $request->validate([
            'title' => 'required|max:50|unique:roles',
            'accessibility.*' => 'required|exists:accessibilities,id'
        ], [], ['title' => 'نام دسترسی', 'accessibility' => 'دسترسی']);
        
        $roleId = Role::insertGetId($request->except(['accessibility', '_token']));
        foreach ($request->accessibility as $access) {
            \App\RoleAccess::insert([
                'roleId' => $roleId,
                'accessId'  =>  $access
            ]);
        }

        return redirect()->back()->with('success', "دسترسی با موفقیت ثبت گردید.");
    }

    public function editRole(Request $request){
        $role = Role::with('roleAccess', 'accessibilities')->find($request->id);
        $roleAccess = $role->accessibilities;
        $accessibility = Accessibility::get();
        // echo "<pre>";
        // print_r($accessibility->all());die;
        return view('roles.roleDetail', compact('roleAccess', 'accessibility', 'role'));
    }

    public function updateRole(Request $request){
        $role = Role::with('roleAccess')->find($request->id);

        if($role){
            $request->validate([
                'title' => [
                    'required',
                    'max:50',
                    Rule::unique('roles')->ignore($role->id),
                ],
                'accessibility.*' => 'required|exists:accessibilities,id'
            ], [], ['title' => 'نام دسترسی', 'accessibility' => 'دسترسی']);

            $role->roleAccess()->delete();
            if(count($request->accessibility)){
                foreach ($request->accessibility as $value) {
                    \App\roleAccess::insert([
                      'roleId' => $role->id,
                      'accessId'  =>  $value
                    ]);
                }
            }
            $role->update($request->except(['_token', 'accessibility']));
            return redirect('roles/role')->with('success', 'دسترسی با موفقیت بروزرسانی شد');
        }else{
            return redirect()->back()->with('fail', 'دسترسی بروزرسانی نشد');
        }
    }

    public function deleteRole(Request $request){
        $role = Role::with('roleAccess')->find($request->id);
        if(!$role){
            return redirect()->back()->with('fail', 'نقش مورد نظر یافت نشد.');
        }else{
            if($role->roleAccess){
                $role->roleAccess()->delete();
            }
            $role->delete();
            return redirect()->back()->with('success', " شناسه نقش مورد نظر حذف گردید.");   
        }
    }

}
