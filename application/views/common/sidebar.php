
<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0" style="background: #9CCC65!important;">
            <div class="navbar-header" style="background: #9CCC65!important;">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="<?php echo base_url();?>Admin/dashboard">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><img src="<?php echo base_url();?>assets/plugins/images/favicon.png" alt="home" class="dark-logo" style="width: 80%;"/><!--This is light logo icon--><img src="<?php echo base_url();?>assets/plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
                     </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is dark logo text--><!-- <img src="<?php echo base_url();?>assets/plugins/images/admin-text.png" alt="home" class="dark-logo" /> --><!--This is light logo text--><img src="<?php echo base_url();?>assets/plugins/images/admin-text-dark.png" alt="home" class="light-logo" />
                     </span> </a>
                </div>
                <!-- /Logo -->
                
                <ul class="nav navbar-top-links navbar-right pull-right">
                   <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo base_url();?>assets/plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $this->session->userdata('name');?></b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="<?php echo base_url();?>assets/plugins/images/users/varun.jpg" alt="user" /></div>
                                    <div class="u-text">
                                        <h4><?php echo $this->session->userdata('name');?></h4>
                                        <p class="text-muted"><?php echo $this->session->userdata('email');?></p><!-- <a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a> --></div>
                                </div>
                            </li>
                           <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url();?>Admin/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Restaurant app</span></h3> </div>
                <ul class="nav" id="side-menu">
                    
                 <li> <a href="<?php echo base_url('Admin/dashboard'); ?>" class="waves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard </span></a></li>
                 <li style = "display: none;"> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cart-outline fa-fw" data-icon="v"></i> <span class="hide-menu"> Products <span class="fa arrow"></span> </span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="<?php echo base_url('Admin/addSupplier'); ?>" class="waves-effect"><i class="fa fa-industry" aria-hidden="true"></i><span class="hide-menu" style="margin-left: 10px;">Add Supplier</span></a>
                        </li>
                        <li> <a href="<?php echo base_url('Admin/addCompany'); ?>" class="waves-effect"><i class="fa fa-hdd" data-icon="v"></i> <span class="hide-menu" style="margin-left: 10px;"> All Company </span></a>
                        </li>
                        <li> <a href="<?php echo base_url('Admin/addMeasurement'); ?>" class="waves-effect"><i class="fa fa-balance-scale"></i> <span class="hide-menu" style="margin-left: 10px;">Add Measurement</span></a>
                        </li>
                        <li> <a href="<?php echo base_url('Admin/addProduct'); ?>" class="waves-effect"><i class="fab fa-product-hunt"></i> <span class="hide-menu" style="margin-left: 10px;">Add Product</span></a>
                        </li>
                        
                    </ul>
                </li>
                <li><a href="<?php echo base_url('Admin/addStaff'); ?>" class="waves-effect"><i class="fa fa-user"></i> <span class="hide-menu" style="margin-left: 10px;">Staff </span></a>
                </li>
<!--                 <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user" data-icon="v"></i> <span class="hide-menu"> &nbsp;&nbsp;Users <span class="fa arrow"></span> </span></a>
                    <ul class="nav nav-second-level">
                        <li style="display: none;"> <a href="<?php echo base_url('Admin/user'); ?>" class="waves-effect"><i class="fa fa-user" data-icon="v"></i> <span class="hide-menu" style="margin-left: 10px;"> All Customer </span></a>
                        </li>
                        <li><a href="<?php echo base_url('Admin/addStaff'); ?>" class="waves-effect"><i class="fa fa-user"></i> <span class="hide-menu" style="margin-left: 10px;">Staff </span></a>
                        </li>
                    </ul>
                </li> -->
                <li> <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-money-bill-alt fa-fw" data-icon="v"></i> <span class="hide-menu"> Restaurant <span class="fa arrow"></span> </span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="<?php echo base_url('Admin/allOrder'); ?>" class="waves-effect"><i class="fas fa-money-bill-alt fa-fw" data-icon="v"></i> <span class="hide-menu"> Sales </span></a>
                        </li>
                        <li> <a href="<?php echo base_url('Admin/deletedOrder'); ?>" class="waves-effect"><i class="fas fa-money-bill-alt fa-fw" data-icon="v"></i> <span class="hide-menu"> Deleted Orders </span></a>
                        </li>    
                        <li><a href="<?php echo base_url('Admin/sale_report'); ?>" class="waves-effect"><i class="far fa-chart-bar fa-fw"></i> <span class="hide-menu">Sale Report</span></a>
                        </li>  
                        <li><a href="<?php echo base_url('Admin/sale_report_tax'); ?>" class="waves-effect"><i class="far fa-chart-bar fa-fw"></i> <span class="hide-menu">Sale Report (Tax)</span></a>
                        </li>             
                        <li style="display: none;"><a href="<?php echo base_url('Admin/allpurechase'); ?>" class="waves-effect"><i class="fa fa-shopping-cart"></i> <span class="hide-menu"> &nbsp;&nbsp;Purchase </span></a>
                        </li>
                        <li style="display: none;"><a href="<?php echo base_url('Admin/report'); ?>" class="waves-effect"><i class="far fa-chart-bar fa-fw"></i> <span class="hide-menu">Purchase Report</span></a></li>
                        <li style="display: none;"><a href="<?php echo base_url('Admin/allInventory'); ?>" class="waves-effect"><i class="mdi mdi-clipboard-text fa-fw"></i> <span class="hide-menu">Inventory</span></a>
                        <li style="display: none;"><a href="<?php echo base_url('Admin/addUsage'); ?>" class="waves-effect"><i class="far fa-chart-bar fa-fw"></i> <span class="hide-menu">Usage</span></a>
                        </li>
                    </ul>
                </li>
                <li> <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-bars" data-icon="v"></i> <span class="hide-menu"> &nbsp;&nbsp;Menu <span class="fa arrow"></span> </span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="<?php echo base_url('Admin/addCategory'); ?>" class="waves-effect"><i class="mdi mdi-table fa-fw"></i> <span class="hide-menu">Add Food Category</span></a>
                        </li>
                        <li> <a href="<?php echo base_url('Admin/addMenu'); ?>" class="waves-effect"><i class="fas fa-bars"></i> <span class="hide-menu" style="margin-left: 10px;">Add Menu</span></a>
                        </li>
                    </ul>
                </li>
                <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog" data-icon="v"></i> <span class="hide-menu"> Settings <span class="fa arrow"></span> </span></a>
                    <ul class="nav nav-second-level">
                        <li style="display: none;"> <a href="<?php echo base_url('Admin/addTax'); ?>" class="waves-effect"><i class="mdi mdi-chart-bar fa-fw"></i> <span class="hide-menu"> Add Tax </span></a>
                        </li>
                         <li> <a href="<?php echo base_url('Admin/setEmail'); ?>" class="waves-effect"><i class="fa fa-envelope"></i> <span class="hide-menu"> Report Email </span></a>
                        </li>
                        <li> <a href="<?php echo base_url('Admin/adminSetting'); ?>" class="waves-effect"><i class="fa fa-envelope"></i> <span class="hide-menu"> Admin Setting </span></a>
                        </li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
