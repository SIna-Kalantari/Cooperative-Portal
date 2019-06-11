@extends('layouts.app')

@section('links')
    <!-- <link href="{{asset('/')}}/plugins/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet" type="text/css" /> -->
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
                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>شماره همراه</th>
                                        <th>نقش</th>
                                        <th>تخصص</th>
                                        <th>آخرین ورود</th>
                                        <th>وضعیت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td>{{++$key}}</div>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->family}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->role->title}}</td>
                                            <td>@if($user->expert){{$user->expert->title}}@elseتعریف نشده@endif</td>
                                            <td>@if($user->lastLogin){{$user->lastLogin}}@elseثبت نام جدید@endif</td>
                                            <td>
                                                @if($user->isActive)
                                                    <span class="label label-table label-success">فعال</span>
                                                @else
                                                    <span class="label label-table label-danger">مسدود شده</span>
                                                @endif
                                            </td>
                                            <td style="min-width: 71px;">
                                                @if($user->isActive)
                                                    <span onclick="changeUserStatus(this)" data-id="{{$user->id}}" class="label label-table label-danger"><i class="md md-remove-circle"></i></span>
                                                @else
                                                    <span onclick="changeUserStatus(this)" data-id="{{$user->id}}" class="label label-table label-success"><i class="md md-check"></i></span>
                                                @endif
                                                <span onclick="redirectToEditUser(this)" data-id="{{$user->id}}" class="label label-table label-primary"><i class="md md-edit"></i></span>
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
    <!-- Sweet-Alert  -->
    <!-- <script src="{{asset('')}}plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="{{asset('')}}pages/jquery.sweet-alert.init.js"></script> -->
    
    <!-- Notification js -->
    <script src="{{asset('')}}plugins/notifyjs/js/notify.js"></script>
    <script src="{{asset('')}}plugins/notifications/notify-metro.js"></script>

    <script>
        function redirectToEditUser(event){
            window.location.href = "{{url('users/edit').'/'}}"+$(event).attr('data-id');
        }
        function changeUserStatus(event){
            window.location.href = "{{url('users/changeStatus').'/'}}"+$(event).attr('data-id');
        }
        @if(session('success'))
            $.Notification.notify('success','bottom left', 'عملیات موفق', "{{session()->get('success')}}");
        @endif
    </script>
@endsection