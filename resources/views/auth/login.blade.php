<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">

        <title>الماس شمال - ورود</title>

        <link href="{{asset('css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/components.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/responsive.css')}}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{asset('js/modernizr.min.js')}}"></script>
        
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
                <div class="panel-heading"> 
                    <h3 class="text-center"> ورود به <strong class="text-custom">الماس شمال</strong> </h3>
                </div> 
                <div class="panel-body">
                    <form method="post" class="form-horizontal m-t-20" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input style="text-align:center" name="phone" autofocus class="form-control" type="text" required="" placeholder="نام کاربریت">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input style="text-align:center" name="password" class="form-control" type="password" required="" placeholder="و اینجا هم رمز عبورت">
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" type="checkbox" name="remember">
                                    <label for="checkbox-signup">
                                        مرا به خاطرت نگه دار
                                    </label>
                                </div>
                                
                            </div>
                        </div>
                        @if ($errors->first())
                            <div sty class="alert alert-danger" role="alert">
                                <strong>{{ $errors->first() }}</strong>
                            </div>
                        @endif
                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                                <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">بزن بریم تو</button>
                            </div>
                        </div>

                        <!-- <div class="form-group m-t-30 m-b-0">
                            <div class="col-sm-12">
                                <a href="{{url('')}}" class="text-dark"><i class="fa fa-lock m-r-5"></i>برگردیم به سایت</a>
                            </div>
                        </div> -->
                    </form> 
                
                </div>   
            </div>
        </div>
        
        

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap-rtl.min.js')}}"></script>
        <script src="{{asset('js/detect.js')}}"></script>
        <script src="{{asset('js/fastclick.js')}}"></script>
        <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('js/waves.js')}}"></script>
        <script src="{{asset('js/wow.min.js')}}"></script>
        <script src="{{asset('js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>

        <script src="{{asset('js/jquery.core.js')}}"></script>
        <script src="{{asset('js/jquery.app.js')}}"></script>
	
	</body>
</html>