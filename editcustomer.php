<?php

require 'Header.php';
require 'Class/customer.inc';

$GetCustomerinfo = new CustomersOpration;

if(isset($_GET['CustomerHashID']))
{
$CustomerHashID=strip_tags( $_GET['CustomerHashID']);



}
if(isset($_GET['CustomerHashID']))
{
$CustomerHashID=strip_tags( $_GET['CustomerHashID']);



}

$GetCustomerinfo->ShowCustomer($connectbd,$CustomerHashID);
if(isset($_POST['edit']))
{
$NewName=strip_tags( $_POST['newname']);
$NewPhone=strip_tags( $_POST['newphone']);

$GetCustomerinfo->EditCustomer($connectbd,$NewName,$NewPhone,$CustomerHashID);
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
                            <li class="active">تعديل عميل</li>
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
                        <div class="card-header">تعديل بيانات العميل</div>
                        <div class="card-body card-block">
                            <form action="#" method="post" class="">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="username" name="newname" value="<?php echo $GetCustomerinfo->editcustomername; ?>" placeholder="الاسم" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="phone" id="phone" name="newphone" value="<?php echo $GetCustomerinfo->editcustomerphone; ?>" placeholder="رقم الهاتف" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-actions form-group"><button type="submit" name="edit" class="btn btn-success btn-sm">تعديل</button></div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>