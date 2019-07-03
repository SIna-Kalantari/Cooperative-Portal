<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Technology;
use Storage;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::orderby('id', 'desc')->paginate(15);
        return view('technologies.index', compact('technologies'));
    }

    public function showAddTechnologyForm(Request $request)
    {
        return view('technologies.add');
    }

    public function insert(Request $request){

        $request->validate([
            'title' => 'required|max:50|unique:technologies,title',
            'icon'  => 'required|max:1000|image|file'
        ], [], ['title' => 'نام تکنولوژی', 'icon' => 'تصویر']);

        $technology = new Technology();
        $technology->icon = $request->file('icon')->store('icons' , 'public');
        $technology->title = $request->title;
        $technology->save();

        return redirect('technologies');
    }

    public function showEditTechnologyForm($id)
    {
        $technology = Technology::find($id);
        return view('technologies.details', ['technology' => $technology]);
    }

    public function update(Request $request)
    {
        $technology = Technology::find($request->id);
        if($technology)
        {
        $request->validate([
            'title' => [
                'required',
                'max:50',
                Rule::unique('technologies')->ignore($technology->id),
            ],
            'icon'  => 'required|max:1000|image|file'
        ], [], ['title' => 'نام تکنولوژی', 'icon' => 'تصویر']);
        
        if($request->hasFile('icon')){
            Storage::delete($technology->icon);
        }
        
            $technology->icon = $request->file('icon')->store('icons' , 'public');
            $technology->title = $request->title;
            $technology->save();
            return redirect('technologies')->with('success', "اطلاعات تکنولوژی با موفقیت بروزرسانی شد.");
        }else{
            return redirect()->back()->with('fail', 'شناسه تکنولوژی مورد نظر یافت نشد.');
        }
    }

    public function delete(Request $request)
    {
        $technology = Technology::find($request->id);
        if(!$technology){
            return redirect()->back()->with('fail', 'تکنولوژی مورد نظر یافت نشد.');
        }
        if($request->hasFile('icon')){
            Storage::delete($technology->icon);
        }
        $technology->delete();
        return redirect()->back()->with('success', " تکنولوژی مورد نظر حذف گردید.");   
    }
}

