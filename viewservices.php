<?php

//View services

require 'Header.php';
require 'Class/servicesopration.inc';
$viewservice = new ServicesOpration;

// check if there is data resived from GET
if(isset($_POST['delete']))
{
    $delservice = strip_tags($_POST['delete']);
    $viewservice->deleteservice($connectbd,$delservice);
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
                            <li><a href="#">الخدمات</a></li>
                            <li class="active">استعراض الخدمات</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($logins == 'is alive'){ ?>
 <div class="content">
 <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            
                                            <th>العرض والتصنيف والاسم</th>
                                            <th> الباقة الكمية</th>
                                            <th>السعر</th>
                                            <th>الوصف</th>
                                            <th>حالة الخدمة</th>
                                            <th>ادوات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php $viewservice->viewservices($connectbd);  ?>
                                       <td>
                                      
                                      
        

                                       </td>
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                            </div>
                            
<?php }else{echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">خطأ</span>
                    يرجى العودة لصفحة البداية وتسجيل الدخول
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';} ?>  