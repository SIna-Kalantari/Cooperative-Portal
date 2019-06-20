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
                <h4 class="m-t-0 header-title"><b>تعریف پروژه جدید</b></h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-20">
                            <form class="form-horizontal" method="post" action="{{url('projects')}}" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->first())
                                    <div style="display: flex; align-items: center; justify-content: center;" class="form-group">
                                        <!-- <label class="col-lg-4 control-label" for="title"></label> -->
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
                                    <label class="col-lg-3 control-label" for="totalPrice">مبلغ کل پروژه</label>
                                    <div class="col-lg-9">
                                        <input style="text-align: left; direction:ltr"  onkeydown="this.value = formatNumber(this.value.replace(/,/g, ''))" value="{{old('totalPrice')}}" name="totalPrice" type="text" autocomplete="off" id="totalPrice" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="clientName">نام مشتری</label>
                                    <div class="col-lg-9">
                                        <input value="{{old('clientName')}}" name="clientName" type="text" autocomplete="off" id="clientName" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="expertId">دسته بندی</label>
                                    <div class="col-lg-9">
                                        <select name="experts[]" id="experts" multiple="multiple" class="select2 select2-multiple" multiple data-placeholder="انتخاب کنید ...">
                                            @foreach($experts as $expert)
                                                <option value="{{$expert->id}}">{{$expert->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="projectAdminId">مدیر پروژه</label>
                                    <div class="col-lg-9">
                                        <select name="projectAdminId" id="projectAdminId" class="select2" data-placeholder="انتخاب کنید ...">
                                            <option>انتخاب نشده</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name.' '.$user->family}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="marketerId">بازاریاب</label>
                                    <div class="col-lg-9">
                                        <select name="marketerId" id="marketerId" class="select2" data-placeholder="انتخاب کنید ...">
                                            <option>انتخاب نشده</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name.' '.$user->family}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="starting_at">تاریخ شروع</label>
                                    <div class="col-lg-9">
                                        <input value="{{old('starting_at')}}" name="starting_at" type="text" autocomplete="off" id="starting_at" class="form-control pdp">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="ending_at">تاریخ پایان</label>
                                    <div class="col-lg-9">
                                        <input value="{{old('ending_at')}}" name="ending_at" type="text" autocomplete="off" id="ending_at" class="form-control pdp">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="descriptions">توضیحات</label>
                                    <div class="col-lg-9">
                                        <!-- <input  name="descriptions" type="text" > -->
                                        <textarea class="form-control" name="descriptions" rows="4">{{old('descriptions')}}</textarea>

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label"></label>
                                    <div class="col-lg-9">
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
        $(document).ready(function() {
            $(".pdp").pDatepicker({
                format: 'YYYY-MM-DD',
            });
        });
    </script>
@endsection('links')