<?php
ob_start();
require 'Class/Header.inc';
require 'config.php';
      $logins;
      $types;
        if(isset($_COOKIE['access_token']))
        {
        define('access_token',$_COOKIE['access_token']);
        define('access_secret',$_COOKIE['access_secret']);
        define('login',$_COOKIE['login']);
        if(isset($_GET['type']))
        {
            define('type',$_GET['type']);
            $types = type;
        }
        $CookiesCheck = new CookiesOpration;
        $CookiesCheck->CookiesCall($connectbd);
        $logins= login; 
        
    
        }
        else
        {
            $logins = null;
            $types = '';
        }


?>


<html dir="rtl">
    <head>
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/lib/chosen/chosen.min.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

        <title>لوحة ادارة الطلبات</title>
        
     <meta charset="UTF-8"/>
	 
    </head>
    
       <body>
	  
	<?php   if($logins == 'is alive'){  ?>
        
        <aside dir="rtl"  id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php"><i class="menu-icon fa fa-laptop"></i>الرئيسية </a>
                    </li>
                
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>المدراء</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="addadmin.php">اضافة مدير</a></li>
                            
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>العملاء</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="addcustomer.php">اضافة عميل</a></li>
                            <li><i class="fa fa-table"></i><a href="viewcustomers.php">تعديل عميل</a></li>
                            <li><i class="fa fa-table"></i><a href="viewcustomers.php">استعراض عميل</a></li>
                        </ul>
                    </li>
                    

                    <li class="menu-title">التصنيفات والخدمات</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>التصنيفات</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="addcategory.php">اضافة تصنيف</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="viewcategory.php">حذف تصنيف</a></li>
                            <li><i class="menu-icon ti-themify-logo"></i><a href="viewcategory.php">استعراض تصنيف</a></li>
                        </ul>
                    </li>
                   
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>الخدمات</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="addservice.php">اضافة خدمة</a></li>
                            <li><i class="menu-icon fa fa-area-chart"></i><a href="viewservices.php">تعديل او حذف خدمة</a></li>
                            <li><i class="menu-icon fa fa-pie-chart"></i><a href="viewservices.php">استعراض الخدمات</a></li>
                        </ul>
                    </li>

                    
                    <li class="menu-title">العمليات المالية والطلبات</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>الطلبات</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="addorder.php">اضافة طلب</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="vieworders.php">تعديل طلب</a></li>
                            <li><i class="menu-icon fa fa-paper-plane"></i><a href="vieworders.php">استعراض طلب</a></li>
                        </ul>
                    </li>

                    <li class="menu-title"> ادوات المستخدم</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>ادوات</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="index.php?type=logout">تسجيل خروج</a></li>
                            
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
        
		    <!-- Right Panel -->

            <div id="right-panel" class="right-panel">



<!-- Header-->
<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="./"><img width="80" height="40" src="images/logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    
</header><!-- /header -->
<!-- Header-->



			
                <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
        <script src="assets/js/main.js"></script>
        <?php }  ?>
		
		
		
		
	   