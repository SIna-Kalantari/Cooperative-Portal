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
                                        <th>آخرین فعالیت</th>
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
                                            <td>@if($user->lastActivity){{jdate('l, n F Y | H:i:s', $user->lastActivity)}}@elseثبت نام جدید@endif</td>
                                            <td>
                                                @if($user->isActive)
                                                    <span class="label label-table label-success">فعال</span>
                                                @else
                                                    <span class="label label-table label-danger">مسدود شده</span>
                                                @endif
                                            </td>
                                            <td style="min-width: 100px;">
                                                @if($user->isActive)
                                                    <span onclick="changeUserStatus(this)" data-id="{{$user->id}}" class="label label-table label-warning"><i class="md md-remove-circle"></i></span>
                                                @else
                                                    <span onclick="changeUserStatus(this)" data-id="{{$user->id}}" class="label label-table label-success"><i class="md md-check"></i></span>
                                                @endif
                                                <span onclick="redirectToEditUser(this)" data-id="{{$user->id}}" class="label label-table label-primary"><i class="md md-edit"></i></span>
                                                <form style="display:none" id="delForm{{$user->id}}" action="{{url('users/'.$user->id)}}" method="POST"> @csrf {{method_field('DELETE')}} </form> <span onclick="deleteUserSubmit(<?=$user->id?>)" data-id="{{$user->id}}" class="label label-table label-danger"><i class="md md-delete"></i></span>
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
        function deleteUserSubmit(userId){
            swal({
                title: "آیا برای حذف این کاربر اطمینان دارین ؟",
                text: "تمامی فرایند های مرتبط با این کاربر هم حذف خواهند شد و بعد از حذف اطلاعات قابل بازیابی نیستند.",
                type: "error",
                showCancelButton: true,
                cancelButtonClass: 'btn-white btn-md waves-effect',
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light del-user',
                confirmButtonText: 'اطمینان دارم!'
            });

            $('.del-user').click(function(e){
                $('#delForm'+userId).submit();
            });
        }
        function redirectToEditUser(event){
            window.location.href = "{{url('users').'/'}}"+$(event).attr('data-id')+"/edit";
        }
        function changeUserStatus(event){
            window.location.href = "{{url('users').'/'}}"+$(event).attr('data-id')+"/changeStatus";
        }
        @if(session('success'))
            $.Notification.notify('success','bottom left', 'عملیات موفق', "{{session()->get('success')}}");
        @endif
    </script>
@endsection