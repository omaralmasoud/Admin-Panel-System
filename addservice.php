<?php
// add service

require 'Header.php';
require 'Class/servicesopration.inc';

$serviceopration = new ServicesOpration;
// get all data from form
    // check if there is a post data
    if(isset($_POST['addservice']))
    {
        $selectcategory = strip_tags($_POST['selectcategory']);
        $servicename = strip_tags($_POST['servicename']);
        $servicequntity = strip_tags($_POST['servicequntity']);
        $serviceprice = strip_tags($_POST['serviceprice']);
        $serviceoffer = strip_tags($_POST['serviceoffer']);
        $servicelink = strip_tags($_POST['servicelink']);
        $servicequality = strip_tags($_POST['servicequality']);
        $servicedrop = strip_tags($_POST['servicedrop']);
        $servicespeed = strip_tags($_POST['servicespeed']);
        $servicestart = strip_tags($_POST['servicestart']);
        $servicedes = strip_tags($_POST['servicedes']);
        $servicesstatus = strip_tags($_POST['servicesstatus']);

        $serviceopration->addservice($connectbd,$selectcategory,$servicename,$servicequntity,$serviceprice
        ,$serviceoffer,$servicelink,$servicequality,$servicedrop,$servicespeed,$servicestart,$servicedes,$servicesstatus);
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
                            <li class="active">اضافة خدمة</li>
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
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="select" class=" form-control-label">التصنيف</label></div>
                        <div class="col-12 col-md-9">
                            <select name="selectcategory" id="select" class="form-control">
                                <option value="0">يرجى اختيار التصنيف</option>
                                <?php $serviceopration->getcategory($connectbd) ?>

                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">الخدمة</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="servicename" placeholder="اضف اسم الخدمة" class="form-control"><small class="form-text text-muted">خدمات تويتر ، انستقرام ؟</small></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">الباقة</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="servicequntity" placeholder="اضف الكمية" class="form-control"><small class="form-text text-muted">مثال 1000 او 2000 .. الخ ،ارقام فقط</small></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">السعر</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="serviceprice" placeholder="اضف السعر" class="form-control"><small class="form-text text-muted">اضف ارقام فقط</small></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">العرض</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="serviceoffer" placeholder="اضف عرض" class="form-control"><small class="form-text text-muted">مثال : عرض خاص ، عرض لمدة محدودة .. الخ</small></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">الرابط المطلوب</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="servicelink" placeholder="اضف المطلوب" class="form-control"><small class="form-text text-muted">الرابط او اسم المستخدم فقط ماذا تريد ؟</small></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">جودة الخدمة</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="servicequality" placeholder="اضف الجودة" class="form-control"><small class="form-text text-muted">عالي الجودة ، حقيقي ، وهمي ، ..الخ</small></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">مدة التعويض</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="servicedrop" placeholder="اضف المدة" class="form-control"><small class="form-text text-muted">مثال : 30 يوم ، 60 يوم او لا يوجد تعويض</small></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">سرعة التنفيذ</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="servicespeed" placeholder="اضف المدة" class="form-control"><small class="form-text text-muted">مثال : معدل الارسال او الاضافة 1000 لكل يوم</small></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label"> بدأ التنفيذ</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="servicestart" placeholder="اضف وقت بدأ التنفيذ" class="form-control"><small class="form-text text-muted">مثال : يبدأ التنفيذ خلال ساعة ... الخ</small></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">وصف اضافي</label></div>
                        <div class="col-12 col-md-9"><textarea name="servicedes" id="textarea-input" rows="9" placeholder="اضف وصف اضافي للخدمة..." class="form-control"></textarea></div>
                    </div>
                    <div class="row form-group">
                                        <div class="col col-md-3"><label class=" form-control-label">حالة الخدمة</label></div>
                                        <div class="col col-md-9">
                                            <div class="form-check-inline form-check">
                                                <label for="inline-radio1" class="form-check-label ">
                                                    <input type="radio" id="inline-radio1" name="servicesstatus" value="1" class="form-check-input" checked>فعالة
                                                </label>
                                                <label for="inline-radio2" class="form-check-label ">
                                                    <input type="radio" id="inline-radio2" name="servicesstatus" value="2" class="form-check-input">غير فعالة
                                                </label>
                                                
                                            </div>
                                        </div>
                                    </div>

                    <div class="card-footer">
                <button type="submit" name="addservice" class="btn btn-primary btn-sm">
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
