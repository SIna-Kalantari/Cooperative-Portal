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
                <h4 class="m-t-0 header-title"><b>افزودن تکنولوژی</b></h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-20">
                            <form class="form-horizontal form-submit" method="post" action="{{url('technologies')}}" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->first())
                                    <div style="display: flex; align-items: center; justify-content: center;" class="form-group">
                                        <div style="text-align: center" class="alert alert-danger col-lg-10 col-sm-10" role="alert">
                                            <strong>{{ $errors->first() }}</strong>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="title">عنوان</label>
                                    <div class="col-lg-9">
                                        <input value="{{old('title')}}" name="title" type="text" autocomplete="off" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="icon">تصویر</label>
                                    <div class="col-lg-9">
                                        <input value="{{old('icon')}}" class="form-control" name="icon" type="file" >
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
    </div>
@endsection