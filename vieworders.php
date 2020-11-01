<?php
// view orders
require 'Header.php';
require 'Class/ordersoprations.inc';

$vieworders = new orderoprations;


if (isset($_POST['editmoneyinfo'])) {
   
    $orderhashid = strip_tags($_POST['orderhashid']);
    $editprice = strip_tags($_POST['editprice']);
    $editbank = strip_tags($_POST['editbank']);
    $editsender = strip_tags($_POST['editsender']);
    $editmoneystatus = strip_tags($_POST['editmoneystatus']);
    $vieworders->updatemoney($connectbd,$editsender,$editbank,$editprice,$editmoneystatus,$orderhashid);

   
}
if (isset($_POST['editorderinfo'])) {

    $orderhashid = strip_tags($_POST['orderhashid']);
    $editstatus = strip_tags($_POST['editstatus']);
    $editquntity = strip_tags($_POST['editquntity']);
    $editnumstart = strip_tags($_POST['editnumstart']);
    $editlink = strip_tags($_POST['editlink']);
    $editnote = strip_tags($_POST['editnote']);
    $vieworders->updateorder($connectbd,$orderhashid,$editquntity,$editnumstart,$editlink,$editnote,$editstatus);
    
}


if (isset($_POST['editmoney'])) {
    
    $orderhashid = strip_tags($_POST['orderhashid']);
    $sender = strip_tags($_POST['sender']);
    $bank = strip_tags($_POST['bank']);
    $price = strip_tags($_POST['price']);
    $statusmoney = strip_tags($_POST['statusmoney']);
    if ($statusmoney == 0) {
        $statusimg = 'pending';
        $stringstatusmoney = 'غير مؤكدة';
    }
    if ($statusmoney == 1) {
        $statusimg = 'complete';
        $stringstatusmoney = 'مؤكدة';
    }
    if ($statusmoney == 2) {
        $statusimg = 'pending';
        $stringstatusmoney = 'مشكلة في الحوالة';
    }
    echo '<input type="hidden" id="moneyeditbutton" data-toggle="modal" data-target="#moneyedit"/>';
}


if (isset($_POST['editorder'])) {
    // Get values
    $orderhashid = strip_tags($_POST['orderhashid']);
    $orderlink = strip_tags($_POST['orderlink']);
    $orderstatus = strip_tags($_POST['orderstatus']);
    $orderquntity = strip_tags($_POST['orderquntity']);
    $ordernumstart = strip_tags($_POST['ordernumstart']);
    $ordernote = strip_tags($_POST['ordernote']);

    if ($orderstatus == 0) {
        $statusicon = 'pending';
        $stringstatus = 'قيد الانتظار';
    }
    if ($orderstatus == 1) {
        $statusicon = 'pending';
        $stringstatus = 'جاري التنفيذ';
    }
    if ($orderstatus == 2) {
        $statusicon = 'complete';
        $stringstatus = 'مكتمل';
    }
    if ($orderstatus == 3) {
        $statusicon = 'complete';
        $stringstatus = 'مكتمل جزئي';
    }
    if ($orderstatus == 4) {
        $statusicon = 'pending';
        $stringstatus = 'ملغي';
    }


    echo ' <input type="hidden" id="editorders" data-toggle="modal" data-target="#editorder"/>';
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
                            <li class="active">استعراض الطلبات</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($logins == 'is alive') { ?>
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="table-stats order-table ov-h">
                    <div class="card-header">
                        <strong class="card-title">الطلبات</strong>
                    </div>
                    <table id="orders" class="table table-striped table-bordered">
                        <thead>
                            <tr>

                                <th class="serial"># رقم الطلب </th>
                                <th>تاريخ الطلب</th>

                                <th>معلومات الطلب</th>

                                <th>الخدمة</th>
                                <th>معلومات العميل</th>
                                <th>معلومات المالية</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $vieworders->vieworders($connectbd); ?>

                        </tbody>
                    </table>
                </div> <!-- /.table-stats -->
            </div>

            <?php


            if (isset($_POST['editorder']))
             {
                                                    
                echo '<form action="vieworders.php"   method="POST">
                 <div class="modal fade" id="editorder" tabindex="-1" role="dialog" aria-labelledby="editorder" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editorder">تعديل طلب</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    <div class="card">
                    <div class="card-header">
                        <strong class="card-title">تعديل الحالة</strong>
                    </div>
                    <div class="card-body">
    
                    <select name="editstatus" data-placeholder="تعديل الحالة" class="standardSelect" tabindex="1">
                        <option value="' . $orderstatus . '" label="default">( الافتراضي )  ' . $stringstatus . '</option>
                        <option value="0" >قيد الانتظار</option>
                        <option value="1" >جاري التنفيذ</option>
                        <option value="2" >مكتمل</option>
                        <option value="3" >مكتمل جزئي</option>
                        <option value="4" >ملغي</option>
                    
                    </select>
                </div>
            </div>
                        
    
                    <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">الكمية الفعلية</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="text-input" value="' . $orderquntity . '" name="editquntity" placeholder="اضف الكمية" class="form-control"><small class="form-text text-muted">مثال 1000 او 2000 .. الخ ،ارقام فقط</small></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">عدد البدأ</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="text-input" value="' . $ordernumstart . '" name="editnumstart" placeholder="اضف عدد البدأ" class="form-control"><small class="form-text text-muted">مثال 1000 او 2000 .. الخ ،ارقام فقط</small></div>
                    </div> 
            
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">الرابط المطلوب</label></div>
                    <div class="col-12 col-md-9"><input type="text" value="' . $orderlink . '" id="text-input" name="editlink" placeholder="اضف العنوان المطلوب" class="form-control"><small class="form-text text-muted">الرابط المطلوب كما هو موضح بوصف الخدمة</small></div>
                </div>          
                <div class="row form-group">
                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">ملاحظات</label></div>
                    <div class="col-12 col-md-9"><textarea name="editnote" id="textarea-input" rows="9" placeholder="اضف ملاحظات للطلب" class="form-control">' . $ordernote . '</textarea></div>
                </div>
                    </p>
                </div>
                <input type="hidden" name="orderhashid" value="' . $orderhashid . '"/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    
                    <button name="editorderinfo" type="submit" class="btn btn-primary">تعديل</button>
                   
                   
                    </div>
            </div>
        </div>
    </div> </form>
   
        ';
            }
            if (isset($_POST['editmoney'])) {
                echo '
                <form action="vieworders.php"   method="POST">        
                            <div class="modal fade" id="moneyedit" tabindex="-1" role="dialog" aria-labelledby="editorder" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editorder">تعديل المعلومات المالية للطلب</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                        <div class="card">
                                        <div class="card-header">
                                            <strong class="card-title">تعديل حالة الحوالة المالية</strong>
                                        </div>
                                        <div class="card-body">
                        
                                        <select name="editmoneystatus" data-placeholder="تعديل الحالة" class="standardSelect" tabindex="1">
                                            <option value="' . $statusmoney . '" label="default">( الافتراضي ) ' . $stringstatusmoney . '</option>
                                            <option value="0" >غير مؤكدة</option>
                                            <option value="1" >مؤكدة</option>
                                            <option value="2" >مشكلة بالحوالة</option>
                                           
                                        
                                        </select>
                                    </div>
                                </div>
                        
                        
                                        <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">اسم المحول</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" value="' . $sender . '" name="editsender" placeholder="اسم المحول للمبلغ" class="form-control"><small class="form-text text-muted">اسم المحول الثلاثي</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">بنك الاستلام</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" value="' . $bank . '" name="editbank" placeholder="اسم البنك المستلم" class="form-control"><small class="form-text text-muted">اسم البنك الذي تم التحويل اليه</small></div>
                                    </div>    

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">المبلغ</label></div>
                                        <div class="col-12 col-md-9"><input type="text" value="' . $price . '" id="text-input" name="editprice" placeholder="ارقام فقط" class="form-control"><small class="form-text text-muted">المبلغ الذي تم تحويله ارقام فقط</small></div>
                                    </div>
                                
                                
                                    <input type="hidden" name="orderhashid" value="' . $orderhashid . '"/>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                        <button type="submit" name="editmoneyinfo" class="btn btn-primary">تعديل</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        ';
            }
            ?>



        <?php } else {
        echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">خطأ</span>
                    يرجى العودة لصفحة البداية وتسجيل الدخول
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    } ?>
        </div>
    </div>
    </div>
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>

    
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#orders').DataTable();
        });
    </script>
    <script type="text/javascript">
        document.getElementById("editorders").click();
    </script>
    <script type="text/javascript">
        document.getElementById("moneyeditbutton").click();
    </script>