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

<div class="row">
    <div class="col-lg-12">
            <div class="card-box" style="overflow:scroll">
                    <div class="col-lg-12">
                        <h4 class="m-t-0 header-title"><b>دسترسی‌ها</b></h4>
                        <div class="p-20">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نام دسترسی</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $counter = 1; ?>
                                    @foreach($accessibility as $access)
                                        <tr>
                                            <td>{{$counter++}}</div>
                                            <td>{{$access->title}}</td>
                                            <td style="min-width: 71px;">
                                                <span onclick="redirectToEditAccess(this)" data-id="{{$access->id}}" class="btn btn-table btn-info btn-sm"><i class="md md-edit"></i></span>
                                                <button data-id="{{$access->id}}" onclick="redirectToDeleteAccess({{$access->id}})" class="btn btn-danger waves-effect waves-light btn-sm" id="danger-alert"><i class="md md-delete"></i></button>
                                                <form action="{{url('roles/'.$access->id)}}" id="delForm{{$access->id}}" style="display:none" method='POST'> @csrf {{method_field('DELETE')}} </form>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card-box" style="overflow:scroll">
                <div class="col-lg-12">
                    <h4 class="m-t-0 header-title"><b>ثبت دسترسی‌ها</b></h4>
                        <div class="p-20">
                            <form class="form-horizontal form-submit" method="post" action="{{url('roles/accessibility')}}">
                                @csrf
                                @if ($errors->first())
                                    <div style="display: flex; align-items: center; justify-content: center;" class="form-group">
                                        <div style="text-align: center" class="alert alert-danger col-lg-10 col-sm-10" role="alert">
                                            <strong>{{ $errors->first() }}</strong>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="title">نام دسترسی</label>
                                    <div class="col-lg-9">
                                        <input value="{{old('title')}}" name="title" type="text" autocomplete="off" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="englishTitle">نام بخش</label>
                                    <div class="col-lg-9">
                                        <input value="{{old('englishTitle')}}" name="englishTitle" type="text" autocomplete="off" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-block btn-md btn-success waves-effect waves-light" style="width: 100px">ثبت</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
</div>

@endsection

@section('scripts')
    <script>

        function redirectToEditAccess(event){
            window.location.href = "{{url('roles').'/'}}"+$(event).attr('data-id')+"/edit";
        }
        @if(session('success'))
            $.Notification.notify('success','bottom left', 'عملیات موفق', "{{session()->get('success')}}");
        @endif

        function redirectToDeleteAccess(id){
            swal({
                title: "آیا برای حذف نام دسترسی اطمینان دارین ؟",
                text: "بعد از حذف اطلاعات قابل بازیابی نیستند.",
                type: "error",
                showCancelButton: true,
                cancelButtonClass: 'btn-white btn-md waves-effect',
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light del-access',
                confirmButtonText: 'اطمینان دارم!'
            });

            $('.del-access').click(function(e){
                $('#delForm'+id).submit();
            });
        }
    </script>
@endsection