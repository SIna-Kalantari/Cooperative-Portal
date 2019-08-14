@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-inverse">
                <h3 class="portlet-title">ویرایش نقش‌ها</h3>
                <div class="portlet-widgets">
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#initialData" aria-expanded="true"><i class="ion-minus-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="initialData" class="panel-collapse collapse in" aria-expanded="true">
                <div class="portlet-body" style="display: flow-root; padding-top: 30px">
                    <div class="col-lg-12">
                        <form class="form-horizontal form-submit" method="post" action="{{url('roles/role/'.$role->id.'/update')}}">
                            @csrf
                            <div class="form-group col-lg-6">
                                <label class="col-lg-3 control-label" for="title">نام نقش</label>
                                <div class="col-lg-9">
                                    <input value="{{$role->title}}" name="title" type="text" autocomplete="off" class="form-control" autofocus>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                    <label class="col-lg-3 control-label" for="accessibility">دسترسی‌ها</label>
                                    <div class="col-lg-9">
                                        <select name="accessibility[]" id="accessibility" multiple="multiple" class="select2 select2-multiple" multiple data-placeholder="انتخاب کنید ...">     
                                            @foreach($accessibility as $access)
                                                <option @foreach($roleAccess as $accessible)
                                                    @if($accessible->id == $access->id)
                                                        selected
                                                    @endif
                                                @endforeach  value="{{$access->id}}" > {{$access->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group col-lg-12" style="display: flex; align-items: baseline; justify-content: space-between;">
                                <button style="width: 100px" type="submit" class="btn btn-block btn-md btn-success waves-effect waves-light">ویرایش</button>
                                <a href="{{url('roles/role')}}"><button style="width: 110px" type="button"  class="btn btn-block btn-md btn-danger waves-effect waves-light">لغو </button></a>
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

<script>

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