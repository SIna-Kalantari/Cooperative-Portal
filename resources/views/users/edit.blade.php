@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>ویرایش کاربر - {{$user->name.' '.$user->family}}</b></h4>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="p-20">
                            <form class="form-horizontal" method="post" action="<?=url("users/$user->id/update")?>" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->first())
                                    <div class="form-group">
                                        <label class="col-lg-4 control-label" for="title"></label>
                                        <div style="text-align: center" class="alert alert-danger col-lg-8" role="alert">
                                            <strong>{{ $errors->first() }}</strong>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="col-lg-4 control-label" for="name">نام</label>
                                    <div class="col-lg-8">
                                        <input value="@if(old('name')){{old('name')}}@else{{$user->name}}@endif" name="name" type="text" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label" for="family">نام خانوادگی</label>
                                    <div class="col-lg-8">
                                        <input value="@if(old('family')){{old('family')}}@else{{$user->family}}@endif" name="family" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label" for="phone">شماره همراه</label>
                                    <div class="col-lg-8">
                                        <input placeholder="9115921971" value="@if(old('phone')){{old('phone')}}@else{{$user->phone}}@endif" name="phone" type="text" id="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label" for="isActive">وضعیت حساب</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" data-style="btn-white" name="isActive" id="isActive">
                                                <option  value="1" @if($user->isActive == 1) selected @endif>فعال</option>
                                                <option  value="0" @if($user->isActive == 0) selected @endif>مسدود</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label" for="roleId">نقش</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" data-style="btn-white" name="roleId" id="roleId">
                                            @foreach($roles as $role)
                                                <option  value="{{$role->id}}" @if(old('roleId') == $role->id) selected @elseif(!old('roleId') && $user->roleId == $role->id) selected @endif>{{$role->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label" for="expertId">تخصص</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" data-style="btn-white" name="expertId" id="expertId">
                                            <option value="">انتخاب نشده</option>
                                            @foreach($experts as $expert)
                                                <option value="{{$expert->id}}" @if(old('expertId') == $expert->id) selected @elseif(!old('expertId') && $user->expert && $user->expert->id == $expert->id) selected @endif>{{$expert->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label"></label>
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-block btn-md btn-success waves-effect waves-light">بروزرسانی</button>
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