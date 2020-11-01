<?php

require 'config.php';
require 'Class/AdminReg.inc';
require 'Header.php';



if(isset($_POST['reg']))
{
     //check if pass is empty
     if(empty($_POST['password']))
     {
          echo 'يرجى ملئ جميع الحقول';
     }else
     {
     $username=strip_tags( $_POST['username']);
     $password=md5( $_POST['password']);
   
     $addadmin = new AdminOpration;
     $addadmin->Username=$username;
     $addadmin->Password=$password;

    $addadmin->AddAdmin($connectbd);
     }
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
                            <li><a href="#">المدراء</a></li>
                            <li class="active">اضافة مدير</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
            <div class="animated fadeIn">
                <div class="row">
       
     <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" width="250" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form  action="AddAdmin.php" method="POST">
                        <div class="form-group">
                            <label>اسم المستخدم</label>
                            <input type="text" name="username" class="form-control" placeholder="اسم المستخدم">
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password" name ="password" class="form-control" placeholder="كلمة المرور">
                        </div>
                    
                        <button name="reg" type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">تسجيل مدير</button>
                        
                        
                    </form>
                </div>
            </div>
        </div>
      </div>
      </div>
        </div>
      </div>
       
      