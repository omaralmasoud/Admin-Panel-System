<?php
// catogery

require 'Header.php';
require 'Class/servicesopration.inc';

$serviceopration = new ServicesOpration;

if(isset($_POST['postcategory']))
{
$categoryname=strip_tags( $_POST['categoryname']);
$categorydes=strip_tags( $_POST['categorydes']);

$serviceopration->addcategory($connectbd,$categoryname,$categorydes);
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
                            <li class="active">اضافة تصنيف</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
<div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">اضافة تصنيف</div>
                        <div class="card-body card-block">
                            <form action="#" method="post" class="">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-star"></i></div>
                                        <input type="text" id="username" name="categoryname" value="" placeholder="اسم الصنف" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                        <input type="phone" id="phone" name="categorydes" value="" placeholder="وصف الصنف" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-actions form-group"><button type="submit" name="postcategory" class="btn btn-success btn-sm">اضافة</button></div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>