<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Storage;
class ProjectController extends Controller
{
    public function index(){
        $projects = Project::orderBy('id', 'desc')->paginate(15);
        return view('projects.index', compact('projects'));
    }

    public function showAddProjectForm(Request $request){
        $experts = \App\Expert::get();
        $users = \App\User::get();
        return view('projects.add', compact('experts', 'users'));
    }

    public function insert(\App\Http\Requests\ProjectRequest $request){
        $projectId = Project::insertGetId($request->except(['_token', 'experts']));
        if(count($request->experts)){
            foreach ($request->experts as $value) {
                \App\ProjectExpert::insert([
                    'projectId' => $projectId,
                    'expertId'  =>  $value
                ]);
            }
        }
        return redirect('projects');
    }

    public function showProjectDetailForm(Request $request){
        $project = Project::with(['usersRelation' => function($rel){
                                    $rel->with(['user' => function($user){
                                        $user->with('expert');
                                    }]);
                                }, 'projectAdmin', 'marketer', 'experts'])->find($request->id);
        $experts = \App\Expert::get();
        $users = \App\User::get();
        // dd($project);
        return view('projects.details', compact('users', 'experts', 'project'));
    }

    public function update(\App\Http\Requests\ProjectRequest $request){
        $project = Project::find($request->id);
        if(!$project){
            return redirect()->back()->with('fail', 'شناسه پروژه مورد نظر یافت نشد.');
        }
        $project->expertsRelation()->delete();
        if(count($request->experts)){
            foreach ($request->experts as $value) {
                \App\ProjectExpert::insert([
                    'projectId' => $project->id,
                    'expertId'  =>  $value
                ]);
            }
        }
        $project->update($request->except(['_token', 'ending_at']));
        return redirect('projects')->with('success', "اطلاعات پروژه با موفقیت بروزرسانی شد.");
    }

    public function changeStatus(Request $request){
        $project = Project::find($request->id);
        if(!$project){
            return redirect()->back()->with('fail', 'شناسه پروژه مورد نظر یافت نشد.');
        }elseif(!isset($request->status) || !in_array($request->status, [0, 2])){
            return redirect()->back()->with('fail', 'اطلاعات ارسال شده نقص دارند، لطفا دوباره تلاش کنید.');
        }
        $request->status == 2 ? $project->update(['status' => 2]) : $project->update(['status' => 0]);
        return redirect('projects')->with('success', "وضعیت پروژه مورد نظر با موفقیت تغییر یافت.");
    }

    public function addUser(Request $request){
        $request->validate([
            'userId' => 'required|exists:users,id',
            'workCost'  =>  'required|numeric'
        ], [], ['workCost' => 'ارزش ریالی کار متخصص', 'userId' => 'متخصص']);
        $project = Project::find($request->id);
        if($project){
            $user = \App\UserProject::firstOrNew(['projectId' => $project->id, 'userId' => $request->userId]);
            $user->workCost = $request->workCost;
            $user->created_at = time();
            $user->save();
        }
        return redirect()->back()->with('success', "متخصص جدید به پروژه افزوده شد.");
    }

    public function delUser(Request $request){
        $userProject = \App\UserProject::where([
            'projectId' => $request->id,
            'userId' => $request->userId,
        ])->first();
        if(!$userProject){
            return redirect()->back()->with('fail', 'شناسه کاربر با پروژه مورد نظر یافت نشد.');
        }
        $userProject->delete();
        return redirect()->back()->with('success', "متخصص از پروژه مورد نظر حذف گردید.");
    }

    public function addFile(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:documents',
            'id' => 'exists:projects,id',
            'destination' => 'required',
        ], [], ['title' => 'نام فایل', 'destination' => 'فایل']);
        
            $destination = Storage::putFile('public/'. $request->id .'/', $request->file('destination'));
                if(!file_exists(storage_path('app/'.$destination)))
                {
                    return redirect()->back()->with('fail', "فایل آپلود نشده است.");
                }
            $extension = $request->destination->getClientOriginalExtension();
            $size = Storage::size($destination);
            \App\Document::create([
                'title' => $request->title,
                'type' => $extension,
                'size' => $size,
                'destination' => $destination,
                'projectId' => $request->id,
                'created_at' => time(),
            ]);

        return redirect()->back()->with('success', "فایل جدید به پروژه افزوده شد.");
    }

    public function delFile(Request $request)
    {
        $file = \App\Document::where([
            'projectId' => $request->id,
        ])->first();
        
        if(!$file){
            return redirect()->back()->with('fail', 'فایل، با پروژه مورد نظر یافت نشد.');
        }
        if(file_exists(storage_path('app/'.$file->destination))){
            unlink(storage_path('app/'.$file->destination));
        }
        $file->delete();
        return redirect()->back()->with('success', "فایل از پروژه مورد نظر حذف گردید.");
    }
}
