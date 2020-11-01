<?php 
//Ordars 
require 'Header.php';
require 'Class/ordersoprations.inc';

$orderopration = new orderoprations;

if(isset($_POST['addorder']))
{
    // Get values
    $customer = strip_tags($_POST['customer']);
    $service = strip_tags($_POST['service']);
    $orderquntity = strip_tags($_POST['orderquntity']);
    $ordernumstart = strip_tags($_POST['ordernumstart']);
    $orderprice = strip_tags($_POST['orderprice']);
    $orderlink = strip_tags($_POST['orderlink']);
    $ordernote = strip_tags($_POST['ordernote']);
    $moneysender = strip_tags($_POST['moneysender']);
    $moneybank = strip_tags($_POST['moneybank']); 

    $orderopration->addorder($connectbd,$customer,$service,$orderquntity,$ordernumstart,$orderprice,$orderlink,$ordernote,$moneysender,$moneybank);
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
                            <li><a href="#">الطلبات</a></li>
                            <li class="active">اضافة طلب</li>
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
            <div class="card-header">
                <strong>اضافة خدمة</strong>
            </div>
            <div class="card-body card-block">
                <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">الخدمات</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static">اضاقة خدمة جديدة</p>
                        </div>
                    </div>
                       
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">اختيار العميل</strong>
                            </div>
                            <div class="card-body">

                              <select name="customer" data-placeholder="يرجى اختيار العميل" class="standardSelect" tabindex="1">
                                <option value="" label="default"></option>
                               <?php $orderopration->getcustomers($connectbd) ?>
                            </select>
                        </div>
                    </div>
                        
                    <div class="card">
                            <div class="card-header">
                                <strong class="card-title">اختيار الخدمة</strong>
                            </div>
                            <div class="card-body">

                              <select name="service" data-placeholder="يرجى اختيار الخدمة" class="standardSelect" tabindex="1">
                                <option value="" label="default"></option>
                                <?php $orderopration->getservices($connectbd) ?>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">الكمية الفعلية</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="orderquntity" placeholder="اضف الكمية" class="form-control"><small class="form-text text-muted">مثال 1000 او 2000 .. الخ ،ارقام فقط</small></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">عدد البدأ</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="ordernumstart" placeholder="اضف عدد البدأ" class="form-control"><small class="form-text text-muted">مثال 1000 او 2000 .. الخ ،ارقام فقط</small></div>
                    </div>
                        <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">السعر</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="orderprice" placeholder="اضف السعر" class="form-control"><small class="form-text text-muted">اضف ارقام فقط</small></div>
                    </div>
                   
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">الرابط المطلوب</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="orderlink" placeholder="اضف العنوان المطلوب" class="form-control"><small class="form-text text-muted">الرابط المطلوب كما هو موضح بوصف الخدمة</small></div>
                    </div>
                   
                   
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">ملاحظات</label></div>
                        <div class="col-12 col-md-9"><textarea name="ordernote" id="textarea-input" rows="9" placeholder="اضف ملاحظات للطلب" class="form-control"></textarea></div>
                    </div>
                    <div class="card-header">
                <strong>اضافة المعلومات المالية</strong>
            </div>
            <br/>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">اسم محول المبلغ</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="moneysender" placeholder="اضف اسم المحول الثلاثي" class="form-control"><small class="form-text text-muted">اسم المحول الثلاثي على الاقل</small></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">البنك الذي تم التحويل اليه</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="moneybank" placeholder="اضف اسم البنك فقط" class="form-control"><small class="form-text text-muted">اضافة اسم البنك فقط</small></div>
                    </div>
                    
                    <div class="card-footer">
                <button type="submit" name="addorder" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Submit
                </button>
                <button type="reset" class="btn btn-danger btn-sm">
                    <i class="fa fa-ban"></i> Reset
                </button>
            </div>
                </form>
            </div>
           
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
   
   <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
 
<script src="assets/js/main.js"></script>
<script src="assets/js/lib/chosen/chosen.jquery.min.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "لا يوجد نتائج!",
            width: "100%"
        });
    });
</script>