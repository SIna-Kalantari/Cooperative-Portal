@extends('layouts.app')

@section('links')
        <link href="{{asset('/')}}/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('/')}}/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('/')}}/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="{{asset('/')}}/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('/')}}/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('/')}}/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

@endsection('links')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>افزودن کاربر جدید</b></h4>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="p-20">
                            <form class="form-horizontal" method="post" action="{{url('users')}}" enctype="multipart/form-data">
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
                                        <input value="{{old('name')}}" name="name" type="text" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label" for="family">نام خانوادگی</label>
                                    <div class="col-lg-8">
                                        <input value="{{old('family')}}" name="family" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label" for="phone">شماره همراه</label>
                                    <div class="col-lg-8">
                                        <input placeholder="9115921971" value="{{old('phone')}}" name="phone" type="text" id="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label" for="roleId">نقش</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" data-style="btn-white" name="roleId" id="roleId">
                                            @foreach($roles as $role)
                                                <option  value="{{$role->id}}" @if(old('roleId') == $role->id) selected @endif>{{$role->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label" for="expertId">تخصص</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" data-style="btn-white" name="expertId" id="expertId">
                                            <option value="" @if(!old('expertId')) selected @endif>انتخاب نشده</option>
                                            @foreach($experts as $expert)
                                                <option value="{{$expert->id}}" @if(old('expertId') == $expert->id) selected @endif>{{$expert->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label"></label>
                                    <div class="col-lg-8">
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

        <script src="{{asset('/')}}/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="{{asset('/')}}/plugins/switchery/js/switchery.min.js"></script>
        <script type="text/javascript" src="{{asset('/')}}/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="{{asset('/')}}/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="{{asset('/')}}/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="{{asset('/')}}/plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="{{asset('/')}}/plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="{{asset('/')}}/plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="{{asset('/')}}/pages/autocomplete.js"></script>

        <script type="text/javascript" src="{{asset('/')}}/pages/jquery.form-advanced.init.js"></script>

@endsection('links')