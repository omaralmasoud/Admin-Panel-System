<?php

//Order opration

class orderoprations
{
    // add order section
    // Get customer information
    function getcustomers($conn)
    {
        // connect to db to get info
        $getcustomers = mysqli_query($conn, 'SELECT * FROM `customers`') or die(mysqli_error($conn));
        //check connection
        if ($getcustomers) {
            // connection work
            // check from ruslts 
            if (mysqli_num_rows($getcustomers) > 0) {
                // found ruslt 
                //fetch data
                while ($fetchcustomer = mysqli_fetch_assoc($getcustomers)) {
                    $hashid = $fetchcustomer['hashid'];
                    $customername = $fetchcustomer['name'];
                    // print ruslt to html
                    echo '<option value="' . $hashid . '">' . $customername . '</option>';
                }
            } else {
                // no rsult
                echo 'لا يوجد عملاء يرجى اضافة عملاء اولا';
            }
        } else {
            // connection down   
            echo 'حدث خطأ اثناء الاتصال يرجى المحاولة لاحقا';
        }
    }

    // get services 
    function getservices($conn)
    {
        // connect to bd to get data
        $getservices = mysqli_query($conn, 'SELECT * FROM `services`') or die(mysqli_error($conn));
        // check connection
        if ($getservices) {
            //connection work
            // check num ruslt
            if (mysqli_num_rows($getservices) > 0) {
                // founded ruslts
                // fetch data
                while ($fetchservices = mysqli_fetch_assoc($getservices)) {
                    $id = $fetchservices['id'];
                    $status = $fetchservices['status'];
                    $service = $fetchservices['service'];
                    $categoryname = $fetchservices['categoryname'];
                    $desoffer = $fetchservices['desoffer'];
                    $desquality = $fetchservices['desquality'];
                    //check status
                    if ($status == 0) {
                        // this serviec not unavialable print nothing
                    } elseif ($status == 1) {
                        // service avalabile
                        echo '<option value="' . $id . '">(ID : ' . $id . ')  [' . $categoryname . '] [' . $desoffer . '] ' . $service . '  [' . $desquality . ']</option>';
                    }
                }
            } else {
                // no rults
            }
        } else {
            //connection down
        }
    }

    //add order oprations
    function addorder($conn, $customer, $service, $orderquntity, $ordernumstart, $orderprice, $orderlink, $ordernote, $moneysender, $moneybank)
    {
        // make it tow section because we have tow tables
        // check values
        if (
            empty($customer) or empty($service) or empty($orderquntity) or empty($orderprice) or empty($orderlink)
            or empty($moneysender) or empty($moneybank)
        ) {
            // there is an empty values 
            echo 'هناك بيانات ناقصة يرجى ملئ جميع الحقول';
        } elseif (is_numeric($orderquntity) and is_numeric($orderprice)) {
            // Get customer data
            $getcustomer = mysqli_query($conn, 'SELECT * FROM `customers` WHERE `hashid`="' . $customer . '"') or die(mysqli_error($conn));
            if ($getcustomer) {
                //  connection work
                // check result
                if (mysqli_num_rows($getcustomer) > 0) {
                    // founded results
                    // fecth data
                    $fecthcustomer = mysqli_fetch_assoc($getcustomer);
                    $hashid = $fecthcustomer['hashid'];
                    $name = $fecthcustomer['name'];
                } else {
                    // no results
                }
            } else {
                // connection down 
                echo 'حدث خطأ اثناء الاتصال يرجى المحاولة لاحقا';
            }
            // add order section

            $randomNumber = rand(10000, 99999);
            $orderhashid = $randomNumber;
            $addorder = mysqli_query($conn, 'INSERT INTO `orders`(`customername`, `hashid`,`orderhashid`, `serviceid`, `quantity`,`numstart`, `link`,`notes`)
         VALUES ("' . $name . '","' . $hashid . '","' . $orderhashid . '","' . $service . '","' . $orderprice . '","' . $ordernumstart . '","' . $orderlink . '","' . $ordernote . '")') or die(mysqli_error($conn));
            //check connection
            if ($addorder) {
                // connection work


                // user orderhashid
                // add money section
                $addmoney = mysqli_query($conn, 'INSERT INTO `money`(`sendername`, `bankname`, `price`, `status`, `orderid`, `hashid`)
            VALUES ("' . $moneysender . '","' . $moneybank . '","' . $orderquntity . '",0,"' . $orderhashid . '","' . $hashid . '")') or die(mysqli_error($conn));
                // check connection
                if ($addmoney) {
                    // connection work
                    echo 'تم اضافة الطلب بنجاح';
                } else {
                    // connection down
                    echo 'حدث خطأ اثناء الاتصال يرجى المحاولة لاحقا';
                }
            } else {
                // connection down
                echo 'حدث خطأ اثناء الاتصال يرجى المحاولة لاحقا';
            }
        } else {
            // not numric
            echo 'يرجى ملئ الحقول بشكل صحيح واضافة ارقام فقط للسعر والكمية';
        }
    }


    // view orders oprations
    function vieworders($conn)
    {
        // check if there is a data
        $checkorders = mysqli_query($conn, 'SELECT * FROM `orders`') or die(mysqli_error($conn));
        // check connctions
        if ($checkorders) {
            // connction work
            // check num rows
            if (mysqli_num_rows($checkorders) > 0) {
                // result founded
                // fetching data
                while ($fetchorders = mysqli_fetch_assoc($checkorders)) {

                    $id = $fetchorders['id'];
                    $customername = $fetchorders['customername'];
                    $hashid = $fetchorders['hashid'];
                    $orderhashid = $fetchorders['orderhashid'];
                    $serviceid = $fetchorders['serviceid'];

                    $quantity = $fetchorders['quantity'];
                    $numstart = $fetchorders['numstart'];
                    $link = $fetchorders['link'];
                    $date = $fetchorders['date'];
                    $notes = $fetchorders['notes'];
                    $status = $fetchorders['status'];
                    $stringstatus = '';
                    $statusicon = '';
                    if ($status == 0) {
                        $statusicon = 'pending';
                        $stringstatus = 'قيد الانتظار';
                    }
                    if ($status == 1) {
                        $statusicon = 'pending';
                        $stringstatus = 'جاري التنفيذ';
                    }
                    if ($status == 2) {
                        $statusicon = 'complete';
                        $stringstatus = 'مكتمل';
                    }
                    if ($status == 3) {
                        $statusicon = 'complete';
                        $stringstatus = 'مكتمل جزئي';
                    }
                    if ($status == 4) {
                        $statusicon = 'pending';
                        $stringstatus = 'ملغي';
                    }

                    // Get money transfer data
                    $getmoney = mysqli_query($conn, 'SELECT * FROM `money` WHERE orderid="' . $orderhashid . '"') or die(mysqli_errno($conn));
                    if ($getmoney) {
                        //  connection work
                        // check num rows
                        if (mysqli_num_rows($getmoney) > 0) {
                            // we have a result
                            // we can fetch data
                            $fecthmoney = mysqli_fetch_assoc($getmoney);
                            $sendername = $fecthmoney['sendername'];
                            $bankname = $fecthmoney['bankname'];
                            $price = $fecthmoney['price'];
                            $dateofsend = $fecthmoney['dateofsend'];
                            $statusmoney = $fecthmoney['status'];
                            $stringstatusmoney = '';
                            $statusimg = '';
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
                        } else {
                            // no results
                            echo 'لا يوجد معلومات مالية لهذا الطلب';
                        }
                    } else {
                        // connction down
                        echo 'حدث خطأ اثناء الاتصال يرجى المحاولة لاحقا';
                    }

                    // Get service data
                    $getservice = mysqli_query($conn, 'SELECT * FROM `services` WHERE id="' . $serviceid . '"') or die(mysqli_error($conn));
                    if ($getservice) {
                        # connection work
                        #check num rows
                        if (mysqli_num_rows($getservice) > 0) {
                            # results founded
                            #fecth data
                            $fetchservices = mysqli_fetch_assoc($getservice);

                            $categoryname = $fetchservices['categoryname'];
                            $service = $fetchservices['service'];
                            $packag = $fetchservices['packag'];

                            $desoffer = $fetchservices['desoffer'];
                            $deslink = $fetchservices['deslink'];
                            $desquality = $fetchservices['desquality'];
                            $desdrop = $fetchservices['desdrop'];
                            $desspeed = $fetchservices['desspeed'];
                            $desstart = $fetchservices['desstart'];
                            $desnote = $fetchservices['desnote'];
                        } else {
                            # no results...
                            echo 'لا يوجد معلومات لهذه الخدمة';
                        }
                    } else {
                        # connection down...
                    }

                    // Get customer info
                    $getcustomer = mysqli_query($conn, 'SELECT * FROM `customers` WHERE hashid="' . $hashid . '"') or die(mysqli_error($conn));
                    if ($getcustomer) {
                        #connection work
                        # check num rows
                        if (mysqli_num_rows($getcustomer) > 0) {
                            # reslut founded
                            #fetching data
                            $fecthcustomerinfo = mysqli_fetch_assoc($getcustomer);

                            $hisname = $fecthcustomerinfo['name'];
                            $hisphone = $fecthcustomerinfo['phone'];
                        } else {
                            #  no results...
                            echo 'لا يوجد معلومات لهذا العميل';
                        }
                    } else {
                        # connection down...
                    }

                    // html side

                    echo ' <tr>
                                <td width="3%" class="serial">' . $orderhashid . '#</td>
                                <td width="10%"><i  class="fa fa-calendar"></li>  <span >' . $date . '</span></td>
                               
                                
                                <td width="25%">
                                <form action="vieworders.php"   method="POST">
                                <i  class="fa fa-link"><input type="hidden" name="orderlink" value="' . $link . '"/> الرابط : ' . $link . ' </i> <br/>
                                <i class="fa fa-coffee"><input type="hidden" name="ordernumstart" value="' . $numstart . '"/> عدد البدأ : ' . $numstart . ' </i> <br/>
                                <i class="fa fa-flask"><input type="hidden" name="orderquntity" value="' . $quantity . '"/> الكمية  : ' . $quantity . ' </i> <br/>
                                <i class="fa fa-pencil-square-o"><input type="hidden" name="ordernote" value="' . $notes . '"/> ملاحظات  : ' . $notes . ' </i> <br/>
                                <span class="badge badge-' . $statusicon . '"><input type="hidden" name="orderstatus" value="' . $status . '"/>' . $stringstatus . '</span>                                                   
                                <input type="hidden" name="orderhashid" value="' . $orderhashid . '"/>
                                <button name="editorder" type="submit" class="btn btn-success btn-flat m-b-30 m-t-30"><i class="fa  fa-edit"> </i> تعديل  </button>
                               
                                </form>

                                </td>
                                
                                
                                
                                
                                <td width="12%">  (' . $serviceid . ') [' . $categoryname . '] [' . $desoffer . '] ' . $service . '  [' . $desquality . '] <br/>
                                
                                
                                </td>
                                
                                <td>
                                
                                <i class="fa fa-user"> اسم العميل : ' . $hisname . ' </i> <br/>
                                <i class="fa fa-phone"> رقم هاتف العميل  : ' . $hisphone . ' </i> <br/>     
                                </td>
                                
                                
                                <td> 
                                <form action="vieworders.php"   method="POST">
                                <i class="fa fa-user"><input type="hidden" name="sender" value="' . $sendername . '"/> اسم محول المبلغ : ' . $sendername . ' </i> <br/>
                                <i class="fa fa-credit-card"><input type="hidden" name="bank" value="' . $bankname . '"/> بنك الاستلام  : ' . $bankname . ' </i> <br/>
                                <i class="fa fa-money"><input type="hidden" name="price" value="' . $price . '"/> المبلغ : ' . $price . ' ريال </i> <br/>
                                <input type="hidden" name="orderhashid" value="' . $orderhashid . '"/>
                                 <span class="badge badge-' . $statusimg . '"><input type="hidden" name="statusmoney" value="' . $statusmoney . '"/> حالة الحوالة : ' . $stringstatusmoney . '</span>
                                <button name="editmoney" type="submit" class="btn btn-success btn-flat m-b-30 m-t-30"><i class="fa  fa-edit"> </i> تعديل  </button>
                               
                                </form>
                               
                                </td>
                                
                            </tr>

                            
                            ';
                }
            } else {
                # no results
                echo 'لا يوجد طلبات';
            }
        } else {
            // connction down
        }
    }


    function updateorder($conn, $orderhashid, $orderquntity, $ordernumstart, $orderlink, $ordernote, $orderstatus)
    {
        // edit order informations

        // check from order connect DB
        $checkorder = mysqli_query($conn, 'SELECT `orderhashid` FROM `orders` WHERE orderhashid="' . $orderhashid . '"') or die(mysqli_error($conn));
        // check connecton
        if ($checkorder) {
            // connection working
            // check num rows
            if (mysqli_num_rows($checkorder) > 0) {
                // we find the order 
                // here we can update our info
                $updateorder = mysqli_query($conn, 'UPDATE `orders` SET `quantity`="' . $orderquntity . '",
                `numstart`="' . $ordernumstart . '",`link`="' . $orderlink . '",`status`="' . $orderstatus . '",`notes`="' . $ordernote . '" WHERE orderhashid="' . $orderhashid . '"') or die(mysqli_error($conn));
                if ($updateorder) {
                    // connection work
                    echo 'تم تعديل البينات بنجاح';
                } else {
                    echo 'حدث خطأ اثناء الاتصال يرجى المحاولة لاحقا';
                    // connection down
                }
            } else {
                // no results
                echo 'هذا الطلب غير موجود';
            }
        } else {
            // connection down
            echo 'حدث خطأ ما اثناء الاتصال';
        }
    }
    function updatemoney($conn, $sendername, $bankname, $price, $status, $orderhashid)
    {
        // edit order informations

        // check from order connect DB
        $checkmoney = mysqli_query($conn, 'SELECT `hashid` FROM `money` WHERE orderid="' . $orderhashid . '"') or die(mysqli_error($conn));
        // check connecton
        if ($checkmoney) {
            // connection working
            // check num rows
            if (mysqli_num_rows($checkmoney) > 0) {
                // we find the order 
                // here we can update our info
                $updatemoney = mysqli_query($conn, 'UPDATE `money` SET `sendername`="'.$sendername.'",`bankname`="'.$bankname.'",`price`="'.$price.'",`status`="'.$status.'" WHERE orderid="' . $orderhashid . '"') or die(mysqli_error($conn));
                if ($updatemoney) {
                    // connection work
                    echo 'تم تعديل البينات بنجاح';
                } else {
                    echo 'حدث خطأ اثناء الاتصال يرجى المحاولة لاحقا';
                    // connection down
                }
            } else {
                // no results
                echo 'هذا الطلب غير موجود';
            }
        } else {
            // connection down
            echo 'حدث خطأ ما اثناء الاتصال';
        }
    }
}
