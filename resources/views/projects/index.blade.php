@extends('layouts.app')

@section('links')
    <style>
        .table{
            text-align: center;
        }
        .table > thead > tr > th{
            text-align: center;
            vertical-align: middle !important;
        }
        .table > tbody > tr > td{
            text-align: center;
            vertical-align: middle !important;
        }
        .label.label-table{
            cursor: pointer;
        }
        .label.label-table:hover {
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.3);
            /* transition: box-shadow 300m ease; */
        }
        .label.label-table > i{
            vertical-align: middle;
        }
        .card-box::-webkit-scrollbar { width: 0 !important; }
        .card-box { overflow: -moz-scrollbars-none; }
        .text , .title {
            text-align: right;
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12">
            <div class="card-box" style="overflow:scroll">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="m-t-0 header-title"><b>کاربران</b></h4>
                        <div class="p-20">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان</th>
                                        <th>نام مشتری</th>
                                        <th>مدیر پروژه</th>
                                        <th>بازاریاب</th>
                                        <th>شروع</th>
                                        <th>پایان</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $key => $project)
                                        <tr>
                                            <td>{{++$key}}</div>
                                            <td>{{$project->title}}</td>
                                            <td>{{$project->clientName}}</td>
                                            <td>{{$project->projectAdmin->name.' '.$project->projectAdmin->family}}</td>
                                            <td>{{$project->marketer->name.' '.$project->marketer->family}}</td>
                                            <td>{{$project->starting_at}}</td>
                                            <td>{{$project->ending_at}}</td>
                                            <td>
                                                @if($project->status == 1)
                                                    <span class="label label-table label-primary">در حال انجام</span>
                                                @elseif($project->status == 2)
                                                    <span class="label label-table label-success">تمام شده</span>
                                                @else
                                                    <span class="label label-table label-danger">لغو شده</span>
                                                @endif
                                            </td>
                                            <td style="min-width: 71px;">
                                                <span onclick="redirectToEditProject(this)" data-id="{{$project->id}}" class="label label-table label-info"><i class="md md-edit"></i> اطلاعات بیشتر</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function redirectToEditProject(event){
            window.location.href = "{{url('projects').'/'}}"+$(event).attr('data-id')+"/edit";
        }
        @if(session('success'))
            $.Notification.notify('success','bottom left', 'عملیات موفق', "{{session()->get('success')}}");
        @endif
    </script>
@endsection