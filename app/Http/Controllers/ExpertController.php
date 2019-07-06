<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Expert;

class ExpertController extends Controller
{
    public function show(){
        $experts = Expert::orderBy('id', 'desc')->paginate(15);
        return view('experts.show', compact('experts'));
    }

    public function showAddExpertForm(Request $request)
    {
        return view('experts.add');
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50|unique:experts,title'
        ], [], ['title' => 'نام تکنولوژی']);

        $expert = new Expert();
        $expert->title = $request->title;
        $expert->save();

        return redirect('experts');
    }

    public function showEditExpertForm(Request $request)
    {
        $expert = Expert::find($request->id);
        return view('experts.edit', compact('expert'));
    }

    public function update(Request $request)
    {
        $expert = Expert::find($request->id);
        if($expert){
            $request->validate([
                'title' => [
                    'required',
                    'max:50',
                    Rule::unique('experts')->ignore($expert->id),
                ]
            ], [], ['title' => 'نام تکنولوژی']);

            $expert->title = $request->title;
            $expert->save();
            return redirect('experts')->with('success', "تخصص با موفقیت ویرایش شد.");
        }else{
            return redirect()->back()->with('fail', "شناسه موردنظر یافت نشد.");
        }
    }

    public function delete(Request $request)
    {
        $expert = Expert::find($request->id);
        if(!$expert){
            return redirect()->back()->with('fail', "تخصص موردنظر یافت نشد.");
        }else{
            $expert->delete();
            return redirect()->back()->with('success', "تخصص با موفقیت حذف گردید.");
        }
    }
}
