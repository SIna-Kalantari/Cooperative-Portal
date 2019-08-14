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
                        <h4 class="m-t-0 header-title"><b>تکنولوژی ها</b></h4>
                        <div class="p-20">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>تصویر</th>
                                        <th>نام تکنولوژی</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($technologies as $key => $technology)
                                        <tr>
                                            <td>{{++$key}}</div>
                                            <td><img src="{{asset('storage/'.$technology->icon)}}" alt="icon" width="50px" height="50px"> </td>
                                            <td>{{$technology->title}}</td>
                                            <td style="min-width: 71px;">
                                                <span onclick="redirectToEditTechnology(this)" data-id="{{$technology->id}}" class="btn btn-table btn-info btn-sm"><i class="md md-edit"></i></span>
                                                <button data-id="{{$technology->id}}" onclick="redirectToDeleteTechnology({{$technology->id}})" class="btn btn-danger waves-effect waves-light btn-sm" id="danger-alert"><i class="md md-delete"></i></button>
                                                <form action="{{url('technologies/'.$technology->id)}}" id="delForm{{$technology->id}}" style="display:none" method='POST'> @csrf {{method_field('DELETE')}} </form>
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
        function redirectToEditTechnology(event){
            window.location.href = "{{url('technologies').'/'}}"+$(event).attr('data-id')+"/edit";
        }
        @if(session('success'))
            $.Notification.notify('success','bottom left', 'عملیات موفق', "{{session()->get('success')}}");
        @endif

        function redirectToDeleteTechnology(id){
            swal({
                title: "آیا برای حذف این تکنولوژی اطمینان دارین ؟",
                text: "بعد از حذف اطلاعات قابل بازیابی نیستند.",
                type: "error",
                showCancelButton: true,
                cancelButtonClass: 'btn-white btn-md waves-effect',
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light del-technology',
                confirmButtonText: 'اطمینان دارم!'
            });

            $('.del-technology').click(function(e){
                $('#delForm'+id).submit();
            });
        }
    </script>
@endsection