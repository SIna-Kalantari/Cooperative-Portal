<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <!-- App Favicon icon -->
        <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
        <!-- App Title -->
        <title>@yield('title')الماس شمال</title>
        <link href="{{asset('/')}}plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('/')}}plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('/')}}plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('/')}}plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('/')}}plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="{{asset('/')}}plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        
        <link href="{{asset('css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/components.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/menu.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/responsive.css')}}" rel="stylesheet" type="text/css" />
       
        <!-- Datepicker -->
        <link href="{{asset('/')}}css/persian-datepicker.min.css" rel="stylesheet" type="text/css" />
        <!-- SweetAlert -->
        <link href="{{asset('/')}}plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css">


        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        @yield('links')

        <script src="{{asset('js/modernizr.min.js')}}"></script>
    </head>
    <body>
        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
                        <a class="logo"><span>الماس <img style="width:28px" src="{{asset('images/logo.png')}}"> شمال</span></a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav navbar-right pull-right">

                            <!-- <li class="dropdown navbar-c-items">
                                <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                    <i class="icon-bell"></i> <span class="badge badge-xs badge-danger">3</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg">
                                    <li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>
                                    <li class="list-group slimscroll-noti notification-list">
                                       <a href="javascript:void(0);" class="list-group-item">
                                          <div class="media">
                                             <div class="pull-left p-r-10">
                                                <em class="fa fa-cog noti-warning"></em>
                                             </div>
                                             <div class="media-body">
                                                <h5 class="media-heading">New settings</h5>
                                                <p class="m-0">
                                                    <small>There are new settings available</small>
                                                </p>
                                             </div>
                                          </div>
                                       </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="list-group-item text-right">
                                            <small class="font-600">See all notifications</small>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->

                            <li class="dropdown navbar-c-items">
                                <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="{{asset('images/user.png')}}" alt="avatar" class="img-circle"> </a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="ti-user text-custom m-r-10"></i> {{Auth()->user()->name.' '.Auth()->user()->family}}</a></li>
                                    <!-- <li><a href="javascript:void(0)"><i class="ti-settings text-custom m-r-10"></i> Settings</a></li> -->
                                    <!-- <li><a href="javascript:void(0)"><i class="ti-lock text-custom m-r-10"></i> Lock screen</a></li> -->
                                    <li class="divider"></li>
                                    <li><a href="{{route('logout')}}"><i class="ti-power-off text-danger m-r-10"></i> خروج</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>

                </div>
            </div>

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li class="has-submenu">
                                <a href="{{url('home')}}"><i class="md md-dashboard"></i>داشبورد</a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="md md-person"></i>کاربران</a>
                                <ul class="submenu">
                                    <li><a href="{{url('users')}}">مشاهده</a></li>
                                    <li><a href="{{url('users/add')}}">افزودن</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="md md-layers"></i>پروژه ها</a>
                                <ul class="submenu">
                                    <li><a href="{{url('projects')}}">مشاهده</a></li>
                                    <li><a href="{{url('projects/add')}}">افزودن</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="md md-class"></i>تکنولوژی ها</a>
                                <ul class="submenu">
                                    <li><a href="{{url('technologies')}}">مشاهده</a></li>
                                    <li><a href="{{url('technologies/add')}}">افزودن</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="md md-pages"></i>تخخصص‌ها</a>
                                <ul class="submenu">
                                    <li><a href="{{url('experts')}}">مشاهده</a></li>
                                    <li><a href="{{url('experts/add')}}">افزودن</a></li>
                                </ul>
                            </li>


                            <li class="has-submenu">
                                <a href="#"><i class="md md-folder-special"></i>تراکنش‌ها</a>
                                <ul class="submenu">
                                        <li><a href="{{url('transactions')}}">مشاهده</a></li>
                                        <li><a href="{{url('transactions/add')}}">ثبت تراکنش</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="md md-account-circle"></i>CRM</a>
                                <ul class="submenu">
                                    <li><a href="crm-dashboard.html"> Dashboard </a></li>
                                    <li><a href="crm-contact.html"> Contacts </a></li>
                                    <li><a href="crm-opportunities.html"> Opportunities </a></li>
                                    <li><a href="crm-leads.html"> Leads </a></li>
                                    <li><a href="crm-customers.html"> Customers </a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="md md-settings"></i>تنظیمات</a>
                                <ul class="submenu">
                                    <li><a href="{{url('transactions/financialTypes')}}">انواع امورمالی</a></li>
                                    <li><a href="{{url('roles')}}">نقش‌ها</a></li>
                                    <li><a href="{{url('access')}}">دسترسی‌ها</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- End navigation menu        -->
                    </div>
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container">
                
                @yield('content')
                
                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                .2019 - AlmaseShomal ©
                            </div>
                            <div class="col-xs-6">
                                <ul class="pull-right list-inline m-b-0">
                                    <li>
                                        <a target="_blank" href="http://almaseshomal.ir">سایت شرکت</a>
                                    </li>
                                    <!-- <li>
                                        <a href="#">Help</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

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
        <!-- App core js -->
        <script src="{{asset('js/jquery.core.js')}}"></script>
        <script src="{{asset('js/jquery.app.js')}}"></script>
        <!-- Sweet-Alert  -->
        <script src="{{asset('/')}}plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
        <!-- <script src="{{asset('/')}}pages/jquery.sweet-alert.init.js"></script> -->
        <!-- Notification js -->
        <script src="{{asset('/')}}plugins/notifyjs/js/notify.js"></script>
        <script src="{{asset('/')}}plugins/notifications/notify-metro.js"></script>
        <!-- Datepicker js -->
        <script type="text/javascript" src="{{asset('/')}}js/persian-date.min.js"></script>
        <script type="text/javascript" src="{{asset('/')}}js/persian-datepicker.min.js"></script>

        <script src="{{asset('/')}}plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="{{asset('/')}}plugins/switchery/js/switchery.min.js"></script>
        <script type="text/javascript" src="{{asset('/')}}plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script type="text/javascript" src="{{asset('/')}}plugins/multiselect/js/jquery.multi-select.js"></script>
        <script src="{{asset('/')}}plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="{{asset('/')}}plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="{{asset('/')}}plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="{{asset('/')}}plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="{{asset('/')}}pages/autocomplete.js"></script>
        
        <script type="text/javascript" src="{{asset('/')}}pages/jquery.form-advanced.init.js"></script>
        @yield('scripts')
        <script>
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }
        </script>

    </body>
</html>