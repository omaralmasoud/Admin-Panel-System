<?php

require 'Class/customer.inc';

require 'Header.php';

if(isset($types))
    {
        if($types == 'logout')
        {
            $CookiesCheck->DestroyCookies($connectbd);
        }
    }
   


if ($logins == null)
{
    require 'Login.php';
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
                            <li><a href="#">الرئيسية</a></li>
                            <li class="active">الصفحة الرئيسية</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

