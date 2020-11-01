<?php
require 'Header.php';
require 'Class/customer.inc';
if(isset($_POST['addcustomer']))
{
     //check if pass is empty
  
     
     $customername=strip_tags( $_POST['customername']);
     $customerphone=strip_tags( $_POST['customerphone']);
   
     $addcustomer = new CustomersOpration;
     $addcustomer->Name=$customername;
     $addcustomer->Phone=$customerphone;

    $addcustomer->AdduserOpration($connectbd);
     
}


?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>لوحة الادارة</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">لوحة الادارة</a></li>
                            <li><a href="#">العملاء</a></li>
                            <li class="active">اضافة عميل</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<html dir="rtl">
    <head>
        
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    
    <meta name="viewport" content="width=device-width, initial-scale=1">



        <title>Add Customer</title>
        
     <meta charset="UTF-8"/>
	 
    </head>
    
       <body>


<div class="clearfix"></div>

<footer class="site-footer">
    <div class="footer-inner bg-white">
        <div class="row">
            <div class="col-sm-6">
                Copyright &copy; 2018 Ela Admin
            </div>
            <div class="col-sm-6 text-right">
                Designed by <a href="https://colorlib.com">Colorlib</a>
            </div>
        </div>
    </div>
</footer>


</div><!-- /#right-panel -->





       
       <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form  action="add_customer.php" method="POST">
                        <div class="form-group">
                            <label>اسم العميل</label>
                            <input type="text" name="customername" class="form-control" placeholder="اسم العميل">
                        </div>
                        <div class="form-group">
                            <label>رقم هاتف العميل</label>
                            <input type="text" name ="customerphone" class="form-control" placeholder="رقم هاتف العميل">
                        </div>
                    
                        <button name="addcustomer" type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">اضافة عميل</button>
                        
                        
                    </form>
                </div>
            </div>

           
    </div>
    
      
