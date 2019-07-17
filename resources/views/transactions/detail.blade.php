@extends('layouts.app')
@section('title')اطلاعات پروژه {{$transaction->title}} - @stop
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
    

        .label.label-table{
            cursor: pointer;
        }
        .label.label-table:hover {
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.3);
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
<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-inverse">
                <h3 class="portlet-title">بروزرسانی تراکنش‌ها</h3>
                <div class="portlet-widgets">
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#initialData" aria-expanded="true"><i class="ion-minus-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="initialData" class="panel-collapse collapse in" aria-expanded="true">
                <div class="portlet-body" style="display: flow-root; padding-top: 30px">
                    <div class="col-lg-12">
                        <form class="form-horizontal form-submit" method="post" action="{{url("transactions/$transaction->id/update")}}">
                            @csrf
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="title">عنوان تراکنش</label>
                                <div class="col-lg-9">
                                    <input value="{{$transaction->title}}" name="title" type="text" autocomplete="off" class="form-control" autofocus>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="amount">مبلغ</label>
                                <div class="col-lg-9">
                                    <input onkeyup="this.value = formatNumber(this.value.replace(/,/g, ''))" style="text-align: left; direction:ltr" value="{{number_format($transaction->amount)}}" name="amount" type="text" autocomplete="off" id="amount" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="typeId">نوع تراکنش</label>
                                <div class="col-lg-9">
                                    <select name="typeId" id="typeId" class="select2"  data-placeholder="انتخاب کنید ...">
                                        @foreach($types as $type)
                                            <option @if($transaction->typeId == $type->id)
                                                        selected
                                                    @endif value="{{$type->id}}"> {{$type->title}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6" id="projectSection" @if(!$transaction->project) style="display:none" @endif>
                                    <label class="col-lg-3 control-label" for="projectId">نام پروژه</label>
                                    <div class="col-lg-9">
                                         <select name="projectId" id="projectId" class="select2" data-placeholder="انتخاب کنید ...">
                                            <option>انتخاب نشده</option>
                                            @foreach($projects as $project)
                                                <option
                                                    @if($transaction->project && $transaction->project->id == $project->id)
                                                        selected
                                                    @endif
                                                    value="{{$project->id}}">{{$project->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group col-lg-12" style="display: flex; align-items: baseline; justify-content: space-between;">
                                <button style="width: 100px" type="submit" class="btn btn-block btn-md btn-success waves-effect waves-light">بروزرسانی</button>
                                <a href="{{url('transactions')}}"><button style="width: 110px" type="button"  class="btn btn-block btn-md btn-danger waves-effect waves-light">لغو </button></a>
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
        $('.form-submit').submit( function(event){
            event.target[2].value = event.target[2].value.replace(/,/g, '');
            return true;
        })

        @php
            $project = \DB::table('transaction_types')->where('title', 'پروژه')->first();
            if($project){
        @endphp
            $('#typeId').change(function(){
                var projectId = {{ $project->id }};
                    if ($(this).val() == projectId){
                        $('#projectSection').fadeIn();
                    }else{
                        $('#projectSection').fadeOut();
                    }
            });
        @php } @endphp

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