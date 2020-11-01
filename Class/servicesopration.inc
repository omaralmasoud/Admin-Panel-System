<?php

// services oprations 
// Services (add service , edit service , view service , delete service).

class ServicesOpration 
{

    // category section
    function addcategory($conn,$categoryname ,$categorydes) 
    {
        // check if empty
        if(empty($categoryname)){ echo 'يرجى ادخال اسم التصنيف'; }
        else
        {
            // check if there is the same name 
            $checkname = mysqli_query($conn,'SELECT * FROM `categorys` WHERE category="'.$categoryname.'"') or die(mysqli_error($conn));
            if($checkname)
            {
                // connection working
                if(mysqli_num_rows($checkname)>0)
                {
                    // there is a previous record
                    echo 'هناك تصنيف يحمل نفس الاسم بالفعل';
                }else
                {
                    // there is no records with same name.
                    $addcatogery = mysqli_query($conn,'INSERT INTO `categorys`(`category`, `description`) VALUES ("'.$categoryname.'","'.$categorydes.'")') or die(mysqli_error($conn));
                    if($addcatogery)
                    {
                        // connection working
                        echo 'تم اضافة التصنيف بنجاح';
                    }
                    else { echo 'حدث خطأ اثناء عملية الاتصال يرجى المحاولة لاحقا'; }
                }

            }else
            {
                // connection down
            }
        }
        

    }

    function viewcatogery($conn)
    {
        // connect to database 
        $viewcategory = mysqli_query($conn,'SELECT * FROM `categorys`') or die($conn);
        if($viewcategory)
        {
               // connection work
            // check from ruselt
                if(mysqli_num_rows($viewcategory)>0)
                {
                        // there is a data ready to show

                        // loop
                        while($fetchc = mysqli_fetch_assoc($viewcategory))
                        {
                        
                        //  get data from array
                        $catogeryid = $fetchc['id'];
                        $catogeryname = $fetchc['category'];
                        $catogerydes= $fetchc['description'];
                        $getservices = mysqli_query($conn,'SELECT * FROM `services` WHERE categoryname="'.$catogeryname.'"') or die($conn);
                            $numberofservices = mysqli_num_rows($getservices);
                        echo ' <tr>
                        <td class="serial">'.$catogeryid.'.</td>
                        
                        </td>
                        
                        <td>  <span class="name" name="customername">'.$catogeryname.'</span> </td>
                        
                        <td><span >'.$catogerydes.'</span></td>
                        <td><span class="count">'.$numberofservices.'</span></td>
                        <td><span ><i class="fa fa-trash-o"></i><a name="" type="submit" href="viewcategory.php?delcatogeryid='.$catogeryid.'" > حذف </a></span></td>
                        
                    </tr>';

                        }
                }
                else
                {
                        //  there is no data yet
                        echo 'لا يوجد تصنيفات بعد يرجى اضافة تصنيفات لاستعراضها';
                }
        }else 
        {
            // connection down
            echo 'حدث خطأ اثناء عملية الاتصال يرجى المحاولة لاحقا';            
        }
    }

    function deletecatogery ($conn,$categoryid)
    {
        // for more sucre check if admin who requst for delete
        
        // check if this category connected with service 
        
        // check if category in database
        $checkcategory = mysqli_query($conn,'SELECT * FROM `categorys` WHERE id="'.$categoryid.'"') or die(mysqli_error($conn));
        if($checkcategory)
        {
            // connection work
            if(mysqli_num_rows($checkcategory)>0)
            {
                // new query for delete 
                $deletecategory = mysqli_query($conn,'DELETE FROM `categorys` WHERE id="'.$categoryid.'"') or die(mysqli_error($deletecategory));
                if($deletecategory)
                {
                    // connection work delete done
                    echo 'تم حذف التصنيف';
                }
                else 
                {
                    //  connection down
                    echo 'حدث خطأ اثناء عملية الاتصال يرجى المحاولة لاحقا';
                }
            }
            else
            {
                // there is no records with same id
                echo 'لا يوجد تصنيف بهذا الاسم';

            }
        }
        else
        {
            // connection down
            echo 'حدث خطأ اثناء عملية الاتصال يرجى المحالة لاحقا';
        }
    }
   
    // service section
    function getcategory($conn)
    {
        // query for get category name for database
         // connect to database 
         $viewcategory = mysqli_query($conn,'SELECT * FROM `categorys`') or die($conn);
         if($viewcategory)
         {
             // connection work
             // check from ruselt
                 if(mysqli_num_rows($viewcategory)>0)
                 {
                     
                         // there is a data ready to show
 
                         // loop
                         while($fetchc = mysqli_fetch_assoc($viewcategory))
                         {
                         
                         //  get data from array
                         $catogeryid = $fetchc['id'];
                         $catogeryname = $fetchc['category'];
                         $catogerydes= $fetchc['description'];
 
                         echo '<option value="'.$catogeryname.'">'.$catogeryname.'</option>';
 
                         }
                 }
                 else
                 {
                         //  there is no data yet
                         echo 'لا يوجد تصنيفات بعد يرجى اضافة تصنيفات لاستعراضها';
                 }
         }else 
         {
             // connection down
             echo 'حدث خطأ اثناء عملية الاتصال يرجى المحاولة لاحقا';            
         }
    }

    function addservice($conn,$selectcategory,$servicename,$servicequntity,$serviceprice
    ,$serviceoffer,$servicelink,$servicequality,$servicedrop,$servicespeed,$servicestart,$servicedes,$servicesstatus)
    {
        // function to add service to database
        
        // we need to check some values to make sure it's not empty
        if(empty($selectcategory) or empty($servicename) or empty($serviceprice) or empty($servicequntity))
        {
            // this should have a value
            echo 'يرجى ملئ الحقول الاساسية';
           
        }
        else 
        {
             // some of this values should have a only numbers
             if(is_numeric($servicequntity) AND is_numeric($serviceprice))
             {
                // it's has only numbers here we going to work
                // add connection

                $addservice = mysqli_query($conn,'INSERT INTO `services`(`categoryname`, `service`, `packag`, `price`, `desoffer`, `deslink`, `desquality`, `desdrop`, `desspeed`, `desstart`, `desnote`,`status`) 
                VALUES ("'.$selectcategory.'","'.$servicename.'","'.$servicequntity.'","'.$serviceprice.'","'.$serviceoffer.'","'.$servicelink.'",
                "'.$servicequality.'","'.$servicedrop.'","'.$servicespeed.'","'.$servicestart.'","'.$servicedes.'","'.$servicesstatus.'")') or die(mysqli_error($conn));
              
                if($addservice)
                {
                    // connection work 
                    echo 'تم اضافة الخدمة بنجاح';
                }
                else
                {
                    // connection drop
                    echo 'حدث خطأ اثناء عملية الاتصال';
                }
             }
             else 
             {
                 // it's not a numbers
                 echo 'يرجى وضع ارقام فقط في خانة السعر والكمية';
             }
        }
    }

    function viewservices($conn)
    {
        // connect to database to get data
        $viewservices = mysqli_query($conn,'SELECT * FROM `services`') or die(mysqli_error($conn));
        // check connection
        if ($viewservices)
        {
            // connection work
            // check if there is a data in table
            if(mysqli_num_rows($viewservices)>0)
            {
                
                // there is a data and we can fetch it
                while( $fetchservices = mysqli_fetch_assoc($viewservices))
               {
                   
                $id =$fetchservices['id'];
                $categoryname = $fetchservices['categoryname'];
                $service = $fetchservices['service'];
                $packag = $fetchservices['packag'];
                $price = $fetchservices['price'];
                $desoffer = $fetchservices['desoffer'];
                $deslink = $fetchservices['deslink'];
                $desquality = $fetchservices['desquality'];
                $desdrop = $fetchservices['desdrop'];
                $desspeed = $fetchservices['desspeed'];
                $desstart = $fetchservices['desstart'];
                $desnote = $fetchservices['desnote'];
                $status = $fetchservices['status'];
                
                if ($status == 0)
           {
                $status = 'غير فعالة';
                $statusimg = 'pending';
           } if ($status == 1)
           {
                $status = 'فعالة';
                $statusimg = 'complete';
           }
                echo ' <tr>
                <td class="serial1" >'.$id.'.</td>
                <input type="hidden" value="" id="delete" name="delete" />
                </td>
                
                <td>  <span class="name" name="customername">['.$categoryname.'] ['.$desoffer.'] '.$service.'  ['.$desquality.']</span> </td>
                
               
                <td><span >'.$packag.'</span></td>
                <td><span class="count"><i class="fa fa-fa-money"> '.$price.' </i></span></td>
                <td><span >
                 <i class="fa fa-rocket"> العرض : '.$desoffer.' </i> <br/>
                 <i class="fa fa-clock-o"> وقت البدأ  : '.$desstart.' </i> <br/>
                 <i class="fa fa-tachometer"> معدل الاضافة : '.$desspeed.' </i> <br/>
                 <i class="fa fa-link"> نحتاج '.$deslink.' </i> <br/>
                 <i class="fa fa-thumbs-up"> الجودة : '.$desquality.' </i> <br/>
                 <i class="fa fa-times-circle"> التعويض : '.$desdrop.' </i> <br/>
                 <i class="fa fa-bullhorn"> ملاحظات : '.$desnote.' </i> <br/>

                </span></td>
                <td><span class="badge badge-'.$statusimg.'">'.$status.'</span></td>
                
                
               
                
            </div>
        </div>    
            </tr>';
           
               }
            }else
            { 
                // there is no data yet
                echo 'لا يوجد بيانات بعد يرجى اضافة خدمات لاستعراضها';
            }
        }
        else
        {
            // connection down
        }
    }
    function deleteservice($conn,$id)
    {
        // check if id of service in database
        $checkid = mysqli_query($conn,'SELECT * FROM `services` WHERE id="'.$id.'"') or die(mysqli_error($conn));
        if($checkid)
        {
            // connection work
            // check num arows
            if(mysqli_num_rows($checkid)>0)
            {
                // data there we can deleted
                $deleteservice = mysqli_query($conn,'DELETE FROM `services` WHERE id="'.$id.'"') or die(mysqli_error($conn));
                // check connection
                if($deleteservice)
                {
                    // connection work data deleted
                    echo 'تم حذف الخدمة بنجاح';
                }else
                {
                    // connection down
                    echo 'لا يوجد بيانات مسجلة لهذه الخدمة';
                }
            }else
            {
                // there is no data of this id
                echo 'لا يوجد بيانات مسجلة لهذه الخدمة';
            }
        }
        else
        {
            // connection down
            echo 'فشل الاتصال يرجى المحالة لاحقا';
        }
    }
}