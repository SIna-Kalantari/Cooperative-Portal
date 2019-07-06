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
    <div class="col-lg-12">
            <div class="card-box" style="overflow:scroll">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="m-t-0 header-title"><b>تخصص‌ها</b></h4>
                        <div class="p-20">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>تخصص</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($experts as $key => $expert)
                                        <tr>
                                            <td>{{++$key}}</div>
                                            <td>{{$expert->title}}</td>
                                            <td style="min-width: 71px;">
                                                <span onclick="redirectToEditExpert(this)" data-id="{{$expert->id}}" class="btn btn-table btn-info btn-sm"><i class="md md-edit"></i></span>
                                                <button data-id="{{$expert->id}}" onclick="redirectToDeleteExpert({{$expert->id}})" class="btn btn-danger waves-effect waves-light btn-sm" id="danger-alert"><i class="md md-delete"></i></button>
                                                <form action="{{url('experts/'.$expert->id)}}" id="delForm{{$expert->id}}" style="display:none" method='POST'> @csrf {{method_field('DELETE')}} </form>
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
        function redirectToEditExpert(event){
            window.location.href = "{{url('experts').'/'}}"+$(event).attr('data-id')+"/edit";
        }
        @if(session('success'))
            $.Notification.notify('success','bottom left', 'عملیات موفق', "{{session()->get('success')}}");
        @endif

        function redirectToDeleteExpert(id){
            swal({
                title: "آیا برای حذف این تخصص اطمینان دارین ؟",
                text: "بعد از حذف اطلاعات قابل بازیابی نیستند.",
                type: "error",
                showCancelButton: true,
                cancelButtonClass: 'btn-white btn-md waves-effect',
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light del-expert',
                confirmButtonText: 'اطمینان دارم!'
            });

            $('.del-expert').click(function(e){
                $('#delForm'+id).submit();
            });
        }
    </script>
@endsection