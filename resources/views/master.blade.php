<!DOCTYPE html>
<html lang="en">
    <head>

        <style>
            .btn-file {
                position: relative;
                overflow: hidden;
            }
            .btn-file input[type=file] {
                position: absolute;
                top: 0;
                right: 0;
                min-width: 100%;
                min-height: 100%;
                font-size: 100px;
                text-align: right;
                filter: alpha(opacity=0);
                opacity: 0;
                outline: none;
                background:#000099 ;
                cursor: inherit;
                display: block;
            }
        </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DMS</title>

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

        <!-- Fonts ogleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/animate.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

        <link href="{{ URL::asset('css/plugins/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/plugins/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/plugins/dataTables/dataTables.tableTools.min.css') }}" rel="stylesheet">

        <link href="{{ URL::asset('css/plugins/chosen/chosen.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">












    </head>




    <!-- Scripts -->
    <body class="pace-done fixed-sidebar  "  >

        <div id="wrapper">

            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                                </span>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Nilesh Jayanandana</strong>
                                        </span> <span class="text-muted text-xs block">Admin <b class="caret"></b></span> </span> </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="profile.html">Profile</a></li>
                                    <li><a href="contacts.html">Contacts</a></li>
                                    <li><a href="mailbox.html">Mailbox</a></li>
                                    <li class="divider"></li>
                                    <li><a href="login.html">Logout</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                IN+
                            </div>
                        </li>


                        <li  >
                            <a href="#" id="man"><i class="fa fa-book"></i> <span class="nav-label">MANAGEMENT</span> </a>
                            <ul class="nav nav-second-level">
                                <li id="cus" ><a href="customers">Customers</a></li>
                                <li id="rou" ><a href="routes">Routes</a></li>
                                <li id="rep" ><a href="reps">Representatives</a></li>
                                <li id="veh" ><a href="vehicles">Vehicles</a></li>



                            </ul>
                        </li>

                        <li  >
                            <a href="#" id="pro"><i class="fa fa-book"></i> <span class="nav-label">PRODUCTS</span> </a>
                            <ul class="nav nav-second-level">
                                <li id="cat" ><a href="categories">Categories/Brands</a></li>

                                <li id="prod" ><a href="products">Products</a></li>



                            </ul>
                        </li>

                        <li  >
                            <a href="#" id="sto"><i class="fa fa-book"></i> <span class="nav-label">STOCKS</span> </a>
                            <ul class="nav nav-second-level">
                                <li id="grn" ><a href="grn">Good Recieve Note</a></li>
                                <li id="stocks" ><a href="astocks">Active Stocks</a></li>
                                <li id="log" ><a href="stock_history">Stock History</a></li>
                                <li id="dis"><a href="discard-stocks">Discard Stocks </a></li>




                            </ul>
                        </li>
                        
                        
                        <li  >
                            <a href="#" id="loa"><i class="fa fa-book"></i> <span class="nav-label">LOADING/UNLOADING</span> </a>
                            <ul class="nav nav-second-level">
                                <li id="load" ><a href="load">Available Vehicles</a></li>
                                <li id="act" ><a href="active-vehicles">Active Vehicles</a></li>
                                <li id="lhis" ><a href="load-history">Loading History</a></li>
                                




                            </ul>
                        </li>

                          <li  >
                            <a href="#" id="sal"><i class="fa fa-book"></i> <span class="nav-label">SALES</span> </a>
                            <ul class="nav nav-second-level">
                                <li id="vsal" ><a href="load">Vehicle Sales</a></li>
                               
                                




                            </ul>
                        </li>

                        
                    </ul>

                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
  
                </div>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-sm-8">
                        <h2>@yield('heading')</h2>
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </div>
                    <div class="col-sm-4">
                        <div class="title-action">
                            @yield('headerbuttons')
                        </div>  

                    </div>
                </div>
                <div class=" ">
                    @yield('content')
                </div>


            </div>
        </div>



        <script src="{{ URL::asset('js/jquery-2.1.1.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/flot/jquery.flot.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/flot/jquery.flot.spline.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/flot/jquery.flot.pie.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
        <script src="{{ URL::asset('js/inspinia.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/pace/pace.min.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

        <script src="{{ URL::asset('js/plugins/chosen/chosen.jquery.js')}}"></script>
        <script src="{{ URL::asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

        <script src="{{ URL::asset('js/plugins/dataTables/jquery.dataTables.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/dataTables/dataTables.responsive.js') }}"></script>
        <script src="{{ URL::asset('js/plugins/dataTables/dataTables.tableTools.min.js') }}"></script>






        @yield('js')









    </body>
</html>
