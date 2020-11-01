<?php

// view catogery

require 'Header.php';
require 'Class/servicesopration.inc';
$viewcatogery = new ServicesOpration;
// check if there is a new requst from get
if(isset($_GET['delcatogeryid']))
{
  $deletecategory =strip_tags( $_GET['delcatogeryid']);
     $viewcatogery->deletecatogery($connectbd,$deletecategory);
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
                            <li><a href="#">التصنيفات</a></li>
                            <li class="active">استعراض التصنيفات</li>
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
                                            
                                            
                                            <th>التصنيف</th>
                                            <th>وصف التصنيف</th>
                                            <th>عدد الخدمات</th>
                                            <th>ادوات</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php $viewcatogery->viewcatogery($connectbd);  ?>
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