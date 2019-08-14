@extends('layouts.app')

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
    </style>
@endsection('links')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>ثبت تراکنش</b></h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-20">
                            <form class="form-horizontal form-submit" method="post" action="{{url('transactions')}}">
                                @csrf
                                @if ($errors->first())
                                    <div style="display: flex; align-items: center; justify-content: center;" class="form-group">
                                        <div style="text-align: center" class="alert alert-danger col-lg-10 col-sm-10" role="alert">
                                            <strong>{{ $errors->first() }}</strong>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="title">عنوان تراکنش</label>
                                    <div class="col-lg-9">
                                        <input value="{{old('title')}}" name="title" type="text" autocomplete="off" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="amount">مبلغ</label>
                                    <div class="col-lg-9">
                                        <input style="text-align: left; direction:ltr"  onkeyup="this.value = formatNumber(this.value.replace(/,/g, ''))" value="{{old('amount')}}" name="amount" type="text" autocomplete="off" id="amount" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="typeId">نوع تراکنش</label>
                                    <div class="col-lg-9">
                                        <select name="typeId" id="typeId" class="select2" data-placeholder="انتخاب کنید ...">
                                            <option>انتخاب نشده</option>
                                            @foreach($types as $type)
                                                <option @if(old('typeId') == $type->id) selected @endif value="{{$type->id}}">{{$type->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6" id="projectSection" style="display:none">
                                    <label class="col-lg-3 control-label" for="projectId">نام پروژه</label>
                                    <div class="col-lg-9">
                                         <select name="projectId" id="projectId" class="select2" data-placeholder="انتخاب کنید ...">
                                            <option>انتخاب نشده</option>
                                            @foreach($projects as $project)
                                                <option @if(old('projectId') == $project->id) selected @endif value="{{$project->id}}">{{$project->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6" style="margin-bottom:20px; margin-top:0;">
                                    <label class="col-lg-3 control-label" for="cost">نوع هزینه</label>
                                    <label class="col-lg-4 radio-inline">
                                        <input style="transform: scale(0.40); margin-right:20px; margin-left:30px;	margin-top:-6px; border:none; outline:none;" value="0" name="cost" type="radio" autocomplete="off" id="cost" class="form-control"><span>برداشت از حساب</span>
                                    </label>
                                    <label class="col-lg-4 radio-inline">
                                        <input style="transform: scale(0.40); margin-right:10px; margin-left:30px; margin-top:-7px; border:none; outline:none;" value="1" name="cost" type="radio" autocomplete="off" id="cost" class="form-control"><span>واریز به حساب</span>
                                    </label>
                                </div>
                                <div class="form-group col-lg-10" id="button1" style="display:none">
                                    <label class="col-lg-6 control-label"></label>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-block btn-md btn-success waves-effect waves-light">ثبت</button>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6" id="button2">
                                    <label class="col-lg-10 control-label"></label>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-block btn-md btn-success waves-effect waves-light">ثبت</button>
                                    </div>
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

                    if ($(this).val() == projectId){
                        $('#button1').fadeIn();
                        $('#button2').fadeOut();
                    }else{
                        $('#button1').fadeOut();
                        $('#button2').fadeIn();
                    }
                });
        @php } @endphp

        @if($errors->first())
            $.Notification.notify('error','bottom left', 'خطا', "{{$errors->first()}}");
        @endif
    </script>
@endsection('links')