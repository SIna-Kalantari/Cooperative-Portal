<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Accessibility;

class AccessController extends Controller
{
    public function showAccess(){
        $accessibility = Accessibility::get();
        return view('roles.accessibility', compact('accessibility'));
    }

    public function insertAccess(Request $request){
        $request->validate([
            'title' => 'required|max:50|unique:accessibilities',
            'englishTitle' => 'required|max:50|unique:accessibilities'
        ], [], ['title' => 'نام دسترسی', 'englishTitle' => 'نام بخش']);

        $accessibility = new Accessibility();
        $accessibility->title = $request->title;
        $accessibility->englishTitle = $request->englishTitle;
        $accessibility->save();
        
        return redirect()->back()->with('success', "دسترسی با موفقیت ثبت گردید.");
    }

    public function editAccess($id){
        $accessibility = Accessibility::find($id);
        return view('roles.accessDetail', compact('accessibility'));
    }

    public function updateAccess(Request $request){
        $accessibility = Accessibility::find($request->id);

        if($accessibility){
        $request->validate([
            'title' => [
                'required',
                'max:50',
                Rule::unique('accessibilities')->ignore($accessibility->id),
            ],
            'englishTitle' => [
                'required',
                'max:50',
                Rule::unique('accessibilities')->ignore($accessibility->id),
            ]
        ], [], ['title' => 'نام دسترسی', 'englishTitle' => 'نام بخش']);

        $accessibility->title = $request->title;
        $accessibility->englishTitle = $request->englishTitle;
        $accessibility->save();

            return redirect('roles/accessibility')->with('success', 'دسترسی با موفقیت بروزرسانی شد');
        }else{
            return redirect()->back()->with('fail', 'دسترسی بروزرسانی نشد');
        }
    }

    public function deleteAccess($id){
        $accessibility = Accessibility::find($id);
        if($accessibility){
            $accessibility->delete();
            return redirect()->back()->with('success', 'دسترسی با موفقیت حذف گردید.');
        }else{
            return redirect()->back()->with('fail', 'دسترسی موردنظر یافت نشد.');
        }
    }
}
