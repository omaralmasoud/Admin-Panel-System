<?php



// Add new customer

Class CustomersOpration
{   

    
    // id auto addded
    private $Name;
    private $Phone;
    private $status;
    private $editcustomername;
    private $editcustomerphone;
    
    // datatime auto add from database

    // Get access to Varibales

    function __set($name, $value)
    {
        switch ($name)
        {
            case 'Name':
            $this->Name=$value;
          
            break;
            case 'Phone':
            $this->Phone=$value;
           
            break;
            case 'editcustomername':
                $this->editcustomername=$value;
               
                break;
           
            case 'editcustomerphone':
                $this->editcustomerphone=$value;
               
                break;
        }
        return $value;
        
    }
    function __get($name)
    {
        switch($name)
        {
            case 'Name':
               return $this->Name;
            case 'Phone':
                return $this->Phone;
                case 'editcustomername':
                    return $this->editcustomername;
                    case 'editcustomerphone':
                        return $this->editcustomerphone;
        }
    }

    // function connect with db
    public function ViewCustomers($Conndb)
    {
       // connect with database to get info.
       $viewcustomers = mysqli_query($Conndb,'SELECT * FROM `customers`') or die(mysqli_error($Conndb));
       // check connection
       if($viewcustomers)
       {
           // connection work

           while($FetchCustomers = mysqli_fetch_assoc($viewcustomers)){
           
           $CustomerID = $FetchCustomers['id'];
           $CustomerHashID = $FetchCustomers['hashid'];
           $customerName = $FetchCustomers['name'];
           $customerPhone = $FetchCustomers['phone'];
           $customerNumOrders = $FetchCustomers['numoforders'];
           $customerDate = $FetchCustomers['date'];
           $customerstatus = $FetchCustomers['status'];
           $statusimg = '';
           // convert status 
           if ($customerstatus == 0)
           {
                $this->status = 'غير فعال';
                $statusimg = 'pending';
           } if ($customerstatus == 1)
           {
                $this->status = 'فعال';
                $statusimg = 'complete';
           }
          
           
           echo ' <tr>
           <td class="serial">'.$CustomerID.'.</td>
           
           </td>
           <td> #'.$CustomerHashID.' </td>
           <td>  <span class="name" name="customername"><a name="editcustomer" type="submit" href="editcustomer.php?CustomerHashID='.$CustomerHashID.'" > '.$customerName.' </a></span> </td>
           <td name="customerphone"> <span class="product">'.$customerPhone.'</span> </td>
           <td><span class="count">'.$customerNumOrders.'</span></td>
           <td>
               <span class="badge badge-'.$statusimg.'">'.$this->status.'</span>
           </td>
       </tr>';
    }
       }else
       {
           echo 'حدث خطأ اثناء عملية الاتصال يرجى المحاولة لاحقا';
       }
    }
   
    // edit customer oprtation
    public function ShowCustomer($Conndb,$CustomerHashid)
    {
        // to edit customer we need to get his info and check it for empty
        $GetCustomerinfo = mysqli_query($Conndb,'SELECT * FROM `customers` WHERE hashid="'.$CustomerHashid.'"') or die(mysqli_error($Conndb));
        if($GetCustomerinfo)
        {
            // connection work
            if(mysqli_num_rows($GetCustomerinfo)>0)
            {
                //fetch customer onfo
                $fecthcustomerinfo = mysqli_fetch_assoc($GetCustomerinfo);
                // we could just update the name and phone and status.
                
                $hisname= $fecthcustomerinfo['name'];
                $hisphone = $fecthcustomerinfo['phone'];
                $hisstatus = $fecthcustomerinfo['status'];

                //check
               $this->editcustomername = $hisname;
               $this->editcustomerphone = $hisphone;
               
            }
        }else
        {
            // connection down
        }

    }

    public function EditCustomer($Conndb,$NewName,$NewPhone,$Hashid)
    {
        if(!is_numeric($NewPhone))
        {
            // Not Numeric erorr msg
            echo 'يرجى ادخال رقم الهاتف بشكل صحيح';
        }else{
        $UpdateCustomer = mysqli_query($Conndb,'UPDATE `customers` SET `name`="'.$NewName.'",`phone`="'.$NewPhone.'" WHERE hashid="'.$Hashid.'"') or die(mysqli_error($Conndb));
        // check connetion 
        if($UpdateCustomer)
        {
            //connection work edit done
            echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">نجحت العملية</span>
            تم تعديل بيانات العميل بنجاح
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            $this->editcustomername = $NewName;
               $this->editcustomerphone = $NewPhone;
        }else
        {
            // connection down
        }}
    }


    public function AdduserOpration($Conndb)
    {
        // Call Varibels 

        $UserName = $this->Name;
        $UserPhone = $this->Phone;
        
        // We need to check if there is empty text.
        if(empty($UserName) or empty($UserPhone))
        {
            echo 'يرجى ملئ جميع الحقول';
        }
        else
        {
            if(!is_numeric($UserPhone))
            {
                // Not Numeric erorr msg
                echo 'يرجى ادخال رقم الهاتف بشكل صحيح';
            }else
            {
                // Now we can go throw database opration.

                //check if phone alrady in.
                $checkphone = mysqli_query($Conndb,'SELECT * FROM `customers` WHERE phone = "'.$UserPhone.'"') or die(mysqli_error($Conndb));
                if(mysqli_num_rows($checkphone)>= 1)
                {
                    // Phone is registered befoer.
                   
                    echo '<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">فشل</span>
                    رقم الهاتف مسجل لدينا بالفعل لا يمكن تسجيل رقم الهاتف اكثر من مرة
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                }else
                {
                    // Generate random number for customer
                    $randomNumber = rand(1000,9999); 
                    $hashid = $randomNumber;
                    // We can add this Customer
                    $addcustomer = mysqli_query($Conndb,'INSERT INTO `customers`(`name`, `phone`,`hashid`,`status`) VALUES ("'.$UserName.'","'.$UserPhone.'","'.$hashid.'",1)') or die(mysqli_error($Conndb));
                    //Check Connection
                    if($addcustomer)
                    {
                        // connection great
                        echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                        <span class="badge badge-pill badge-success">نجحت العملية</span>
                        تمت اضافة العميل بنجاح
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }else
                    {
                        // connection failed
                        echo 'لقد حدث خطأ اثناء الاتصال يرجى المحاولة لاحقا';
                    }
                }
            }
        }
    }


}