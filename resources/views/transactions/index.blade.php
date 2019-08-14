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
                        <h4 class="m-t-0 header-title"><b>تراکنش‌ها</b></h4>
                        <div class="p-20">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان تراکنش</th>
                                        <th>نوع تراکنش</th>
                                        <th>مبلغ (تومان)</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $counter = 1; ?>
                                
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td> {{$counter++}}</div>
                                            <td> {{$transaction->title}}</td>
                                            <td>
                                            
                                            @if(isset($transaction->transactionType->title))
                                                {{$transaction->transactionType->title}}
                                            @endif </td>
                                            @if($transaction->cost == 1)
                                                <td><span style="color:green">{{number_format($transaction->amount)}}  +</span></td>
                                            @elseif($transaction->cost == 0)
                                                <td><span style="color:red">{{number_format($transaction->amount)}}  -</span></td>
                                            @endif    
                                            <td style="min-width: 71px;">
                                                <span onclick="redirectToEditTransaction(this)" data-id="{{$transaction->id}}" class="btn btn-table btn-info btn-sm"><i class="md md-edit"></i></span>
                                                <button data-id="{{$transaction->id}}" onclick="redirectToDeleteTransaction({{$transaction->id}})" class="btn btn-danger waves-effect waves-light btn-sm" id="danger-alert"><i class="md md-delete"></i></button>
                                                <form action="{{url('transactions/'.$transaction->id)}}" id="delForm{{$transaction->id}}" style="display:none" method='POST'> @csrf {{method_field('DELETE')}} </form>
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
        function redirectToEditTransaction(event){
            window.location.href = "{{url('transactions').'/'}}"+$(event).attr('data-id')+"/edit";
        }
        @if(session('success'))
            $.Notification.notify('success','bottom left', 'عملیات موفق', "{{session()->get('success')}}");
        @endif

        function redirectToDeleteTransaction(id){
            swal({
                title: "آیا برای حذف این تراکنش اطمینان دارین ؟",
                text: "بعد از حذف اطلاعات قابل بازیابی نیستند.",
                type: "error",
                showCancelButton: true,
                cancelButtonClass: 'btn-white btn-md waves-effect',
                confirmButtonClass: 'btn-danger btn-md waves-effect waves-light del-transaction',
                confirmButtonText: 'اطمینان دارم!'
            });

            $('.del-transaction').click(function(e){
                $('#delForm'+id).submit();
            });
        }
    </script>
@endsection