@extends('layouts.app')
@section('title')اطلاعات پروژه {{$project->title}} - @stop
@section('links')
    <style>
        .pdp {
            text-align: left;
        }
        .select2-results__option, .select2-search__field{
            direction: rtl;
            text-align: right;
        }
        .select2-selection__choice{
            float: right !important;
        }
        .select2-search__field {
            padding-right: 20px !important;
        }
        span.select2-selection__rendered{
            padding-right: 34px !important;
            text-align: right;
        }
        textarea {
            resize: vertical;
        }
        
        #projectUsers::-webkit-scrollbar { width: 0 !important; }
        #projectUsers { overflow: -moz-scrollbars-none; }

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
        .table > thead > tr > th{
            text-align: center;
            vertical-align: middle !important;
        }
        .table > tbody > tr > td{
            text-align: center;
            vertical-align: middle !important;
        }
    </style>
@endsection('links')

@section('content')
<div class="row"> <!--  اطلاعات اولیه -->
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-inverse">
                <h3 class="portlet-title">اطلاعات اولیه</h3>
                <div class="portlet-widgets">
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#initialData"><i class="ion-minus-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="initialData" class="panel-collapse collapse in">
                <div class="portlet-body" style="display: flow-root; padding-top: 30px">
                    <div class="col-lg-12">
                        <form class="form-horizontal form-submit" method="post" action="<?= url("projects/$project->id/update")?>" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="title">عنوان</label>
                                <div class="col-lg-9">
                                    <input value="{{$project->title}}" name="title" type="text" autocomplete="off" class="form-control" autofocus>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="totalPrice">مبلغ کل پروژه</label>
                                <div class="col-lg-9">
                                    <input onkeyup="this.value = formatNumber(this.value.replace(/,/g, ''))" style="text-align: left; direction:ltr" value="{{number_format($project->totalPrice)}}" name="totalPrice" type="text" autocomplete="off" id="totalPrice" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="clientName">نام مشتری</label>
                                <div class="col-lg-9">
                                    <input value="{{$project->clientName}}" name="clientName" type="text" autocomplete="off" id="clientName" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="expertId">دسته بندی</label>
                                <div class="col-lg-9">
                                    <select name="experts[]" id="experts" multiple="multiple" class="select2 select2-multiple" multiple data-placeholder="انتخاب کنید ...">
                                        @foreach($experts as $expert)
                                            <option @foreach($project->experts as $pExpert)
                                                        @if($pExpert->id == $expert->id)
                                                            selected
                                                        @endif
                                                    @endforeach value="{{$expert->id}}">{{$expert->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="projectAdminId">مدیر پروژه</label>
                                <div class="col-lg-9">
                                    <select name="projectAdminId" id="projectAdminId" class="select2" data-placeholder="انتخاب کنید ...">
                                        @foreach($users as $user)
                                            <option <?php if($project->projectAdminId == $user->id) echo'selected'; ?> value="{{$user->id}}">{{$user->name.' '.$user->family}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="marketerId">بازاریاب</label>
                                <div class="col-lg-9">
                                    <select name="marketerId" id="marketerId" class="select2" data-placeholder="انتخاب کنید ...">
                                        @foreach($users as $user)
                                            <option <?php if($project->marketerId == $user->id) echo'selected'; ?> value="{{$user->id}}">{{$user->name.' '.$user->family}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="starting_at">تاریخ شروع</label>
                                <div class="col-lg-9">
                                    <input value="{{tr_num($project->starting_at, 'fa')}}" name="starting_at" type="text" autocomplete="off" id="starting_at" class="form-control pdp">
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="ending_at">تاریخ پایان</label>
                                <div class="col-lg-9">
                                    <input disabled="disabled" value="{{tr_num($project->ending_at, 'fa')}}" name="ending_at" type="text" autocomplete="off" id="ending_at" class="form-control pdp">
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: center;" class="form-group col-lg-12">
                                <label class="col-lg-1 control-label" for="descriptions">توضیحات</label>
                                <div class="col-lg-8" style="width: 100%">
                                    <textarea placeholder="توضیحات پروژه" class="form-control" name="descriptions" rows="10">@if(old('descriptions')){{old('descriptions')}}@else{{$project->descriptions}}@endif</textarea>

                                </div>
                            </div>
                            <div class="form-group col-lg-12" style="display: flex; align-items: baseline; justify-content: space-between;">
                                <button style="width: 145px" type="button" onclick="successProject()" class="btn btn-block btn-md btn-primary waves-effect waves-light">پروژه به اتمام رسیده</button>
                                <button style="width: 100px" type="submit" class="btn btn-block btn-md btn-success waves-effect waves-light">بروزرسانی</button>
                                <button style="width: 110px" type="button" onclick="cancelProject()" class="btn btn-block btn-md btn-danger waves-effect waves-light">پروژه لغو شده</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row"> <!-- متخصصین -->
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-inverse">
                <h3 class="portlet-title">متخصصین دخیل در پروژه</h3>
                <div class="portlet-widgets">
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#projectUsers"><i class="ion-minus-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="projectUsers" class="panel-collapse collapse in">
                <div class="portlet-body" style="display: flow-root; padding-top: 30px">
                <div class="col-lg-12">
                    <div class="p-20">
                        <table class="table m-0" style="border-bottom: solid 2px #ebeff2;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>تخصص</th>
                                    <th>ارزش ریالی کار</th>
                                    <th>زمان ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                @foreach($project->usersRelation as $key => $rel)
                                    <tr>
                                        <td>{{++$key}}</div>
                                        <td>{{$rel->user->name.' '.$rel->user->family}}</td>
                                        <td>{{$rel->user->expert->title}}</td>
                                        <td>{{number_format($rel->workCost)}}</td>
                                        <td>{{jdate('l, n F Y | H:i:s', $rel->created_at)}}</td>
                                        <td style="min-width: 71px;">
                                            <button data-id="{{$rel->user->id}}" onclick="redirectToDeleteUser(this)" class="btn btn-danger waves-effect waves-light btn-sm" id="danger-alert"><i class="md md-delete"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>    
                <div class="col-lg-12" style="margin-top: 30px;">
                        <form class="form-horizontal form-submit" method="post" action="<?= url("projects/$project->id/users")?>" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="userId">انتخاب متخصص</label>
                                <div class="col-lg-9">
                                    <select name="userId" id="userId" class="select2" data-placeholder="انتخاب کنید ...">
                                        <option>انتخاب نشده</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name.' '.$user->family}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="workCost">ارزش ریالی کار متخصص</label>
                                <div class="col-lg-9">
                                    <input onkeyup="this.value = formatNumber(this.value.replace(/,/g, ''))" style="text-align: left" name="workCost" type="text" autocomplete="off" id="workCost" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-lg-12" style="display: flex; align-items: center; justify-content: center;">
                                <button style="width: 100px" type="submit" class="btn btn-block btn-md btn-success waves-effect waves-light">افزودن</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row"> <!-- فایل‌ها -->
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-inverse">
                <h3 class="portlet-title">فایل‌های پروژه</h3>
                <div class="portlet-widgets">
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#projectUsers"><i class="ion-minus-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="projectUsers" class="panel-collapse collapse in">
                <div class="portlet-body" style="display: flow-root; padding-top: 30px">
                <div class="col-lg-12">
                    <div class="p-20">
                        <table class="table m-0" style="border-bottom: solid 2px #ebeff2;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام فایل</th>
                                    <th>نوع فایل</th>
                                    <th>حجم فایل</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                @foreach($project->document as $key => $rel)
                                    <tr>
                                        <td>{{++$key}}</div>
                                        <td>{{$rel->title}}</td>
                                        <td>{{$rel->type}}</td>
                                        <td>{{$rel->size}} بایت</td>
                                        <td style="min-width: 71px;">
                                            <button data-id="{{$rel->project->id}}" onclick="redirectToDeleteFile(this)" class="btn btn-danger waves-effect waves-light btn-sm" id="danger-alert"><i class="md md-delete"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>    
                <div class="col-lg-12" style="margin-top: 30px;">
                        <form class="form-horizontal form-submit" method="post" action="<?= url("projects/$project->id/documents")?>" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="title">نام فایل</label>
                                <div class="col-lg-9">
                                    <input value="" name="title" type="text" autocomplete="off" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="destination">انتخاب فایل</label>
                                <div class="col-lg-9">
                                    <input type="file" style="text-align: left" name="destination" autocomplete="off" id="destination" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-lg-12" style="display: flex; align-items: center; justify-content: center;">
                                <button style="width: 100px" type="submit" class="btn btn-block btn-md btn-success waves-effect waves-light">افزودن</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $(".pdp").pDatepicker({
                format: 'YYYY-MM-DD',
                initialValue: false
            });
        });

        function successProject(){
            swal({
                title: "آیا برای تغییر وضعیت این پروژه اطمینان دارین ؟",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: 'btn-white btn-md waves-effect',
                confirmButtonClass: 'btn-warning btn-md waves-effect waves-light successProject',
                confirmButtonText: 'اطمینان دارم!'
            });

            $('.successProject').click(function(e){
                window.location.href ="{{url('projects/'.$project->id.'/')}}"+'/changeStatus?status=2';
            });
        }

        function cancelProject(){
            swal({
                title: "آیا برای تغییر وضعیت این پروژه اطمینان دارین ؟",
                type: "error",
                showCancelButton: true,
                cancelButtonClass: 'btn-white btn-md waves-effect',
                confirmButtonClass: 'btn-error btn-md waves-effect waves-light successProject',
                confirmButtonText: 'اطمینان دارم!'
            });

            $('.successProject').click(function(e){
                window.location.href ="{{url('projects/'.$project->id.'/')}}"+'/changeStatus?status=0';
            });
        }

        function redirectToDeleteUser(event){
            swal({
                title: "آیا برای حذف این کاربر اطمینان دارین ؟",
                text: "بعد از حذف اطلاعات قابل بازیابی نیستند.",
                type: "error",
                showCancelButton: true,
                cancelButtonClass: 'btn-white btn-md waves-effect',
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light del-user',
                confirmButtonText: 'اطمینان دارم!'
            });

            $('.del-user').click(function(e){
                window.location.href ="{{url('projects/'.$project->id.'/users')}}"+'/'+event.getAttribute('data-id')+'/del';
            });
        }

        function redirectToDeleteFile(event){
            swal({
                title: "آیا برای حذف این فایل اطمینان دارین ؟",
                text: "بعد از حذف اطلاعات قابل بازیابی نیستند.",
                type: "error",
                showCancelButton: true,
                cancelButtonClass: 'btn-white btn-md waves-effect',
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light del-file',
                confirmButtonText: 'اطمینان دارم!'
            });

            $('.del-file').click(function(e){
                window.location.href ="{{url('projects/'.$project->id.'/documents')}}"+'/'+event.getAttribute('data-id')+'/del';
            });
        }

        $('.form-submit').submit( function(event){
            event.target[2].value = event.target[2].value.replace(/,/g, '');
            return true;
        })

        @if($errors->first())
            $.Notification.notify('error','bottom left', 'خطا', "{{$errors->first()}}");
        @endif

        @if(session('success'))
            $.Notification.notify('success','bottom left', 'عملیات موفق', "{{session()->get('success')}}");
        @endif
        @if(session('fail'))
            $.Notification.notify('error','bottom left', 'خطا!', "{{session()->get('fail')}}");
        @endif
    </script>

@endsection('links')