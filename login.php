<?php
require 'config.php';
require 'Class/AdminReg.inc';




if(isset($_POST['login']))
{
     //check if pass is empty
     if(empty($_POST['password']))
     {
          echo 'يرجى ملئ جميع الحقول';
     }else
     {
     $username=strip_tags( $_POST['username']);
     $password=md5( $_POST['password']);
   
     $loginadmin = new AdminOpration;
     $loginadmin->Username=$username;
     $loginadmin->Password=$password;

    $loginadmin->LoginAdmin($connectbd);
     }
}
?>

<html dir="rtl">
    <head>
        
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    
    <meta name="viewport" content="width=device-width, initial-scale=1">



        <title>Add Admin</title>
        
     <meta charset="UTF-8"/>
	 
    </head>
    
       <body>
       <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form  action="login.php" method="POST">
                        <div class="form-group">
                            <label>اسم المستخدم</label>
                            <input type="text" name="username" class="form-control" placeholder="اسم المستخدم">
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password" name ="password" class="form-control" placeholder="كلمة المرور">
                        </div>
                    
                        <button name="login" type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">تسجيل الدخول</button>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
      </html>