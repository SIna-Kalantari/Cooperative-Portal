@extends('layouts.app')
@section('title')ویرایش اطلاعات تکنولوژی {{$technology->title}} - @stop
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
<div class="row"> <!--  ویرایش اطلاعات تکنولوژی -->
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-inverse">
                <h3 class="portlet-title">ویرایش اطلاعات تکنولوژی</h3>
                <div class="portlet-widgets">
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#initialData"><i class="ion-minus-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="initialData" class="panel-collapse collapse in">
                <div class="portlet-body" style="display: flow-root; padding-top: 30px">
                    <div class="col-lg-12">
                        <form class="form-horizontal form-submit" method="post" action="<?= url("technologies/$technology->id/update")?>" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="title">نام تکنولوژی</label>
                                <div class="col-lg-9">
                                    <input value="{{$technology->title}}" name="title" type="text" autocomplete="off" class="form-control" autofocus>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: center;" class="form-group col-lg-6">
                                <label class="col-lg-1 control-label" for="icon">تصویر</label>
                                <div class="col-lg-8" style="width: 100%">
                                    <input type="file" class="form-control" name="icon" rows="10">

                                </div>
                            </div>
                            <div class="form-group col-lg-12" style="display: flex; align-items: baseline; justify-content: space-between;">
                                <button style="width: 100px" type="submit" class="btn btn-block btn-md btn-success waves-effect waves-light">ویرایش</button>
                                <a href="{{url('technologies')}}"><button style="width: 110px" type="button"  class="btn btn-block btn-md btn-danger waves-effect waves-light">لغو ویرایش</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
        <img src="{{asset('storage/'.$technology->icon)}}" alt="no icon" width="200px" height="200px">
</div>
@endsection