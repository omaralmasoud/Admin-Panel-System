<?php


class AdminOpration
{
    protected $Username;
    protected $Password;
    protected $AccessToken;
    protected $AccessSecret;
    function __set($name, $value)
    {
        switch($name)
        {
            case 'Username':
                $this->Username=$value;
            break;
            case 'Password':
                $this->Password=$value;
            break;
            return $value;
            
        }
      
    }

    function __get($name)
    {
        switch($name)
        {
            case 'Username':
                return $this->Username;
            case 'Password':
                return $this->Password;    
            
        }
    }

public function AddAdmin($conn)
{
        // Opration Queue to add admin on database
        $user = $this->Username;
        $pass = $this->Password;
        
        // check if username and password is empty
        if(empty($user) or empty($pass))
        {
            echo 'يرجى ملئ جميع الحقول ';
        }
        else
        {
        //check username length 
        if(strlen($user)<4)
        {
            echo 'اسم المستخدم قصير جدا يرجى ادخال اسم مستخدم اكثر من 4 حروف';
        }else
        {
        // We should make sure there is now the same username
        $Checkuser = mysqli_query($conn,'SELECT * FROM admins WHERE username="'.$user.'"')or die();
        if(mysqli_num_rows($Checkuser)>1)
        {
            echo 'هذه العضوية مسجلة لدينا بالفعل';

        }
        else
        {

        
       
       $AddAdmin = mysqli_query($conn,'INSERT INTO admins (username,password)VALUES("'.$user.'","'.$pass.'")') or die();
        if($AddAdmin)
        {
            //A New record created successfully
            echo "New record created successfully";
        }else 
        {
            // erorr with connection
            echo "Error: <br> " .mysqli_error($conn) ;
        }
    }
    }}

}
function GenerateAccessToken($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $this->AccessToken = $randomString;
    
}

function GenerateAccessSecret($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $this->AccessSecret = $randomString;
    
}

public function LoginAdmin($conn)
{
    // Opration Queue to add admin on database
    $user = $this->Username;
    $pass = $this->Password;
    if(empty($user) or empty($pass))
        {
            echo 'يرجى ملئ جميع الحقول ';
        }
        else
        {
            $Checkuser = mysqli_query($conn,'SELECT * FROM admins WHERE username="'.$user.'" AND password="'.$pass.'"')or die(mysqli_error($conn));
            if(mysqli_num_rows($Checkuser)>=1)
            {
                $this->GenerateAccessToken();
                $this->GenerateAccessSecret();
                // echo 'تسجيل دخول ناجح';
                
                $FetchAdmin = mysqli_fetch_assoc($Checkuser);
                $AdminID= $FetchAdmin['id'];
                $AdminName =$FetchAdmin['username'];
                $cookiesdate = time()+ 60*60*24;
                // Delete Past authentication 
                $DeleteAuthentication = mysqli_query($conn,'DELETE FROM `authentication` WHERE id="'.$AdminID.'"') or die(mysqli_error($conn));           
        

                // Make a Query to add authentication
                $AddAuthentication = mysqli_query($conn,'INSERT INTO `authentication`(`access_token`, `access_secret`, `id`) VALUES ("'.$this->AccessToken.'","'.$this->AccessSecret.'","'.$AdminID.'")') or die(mysqli_error($conn));
                
                if($AddAuthentication)
                {
                    setcookie('access_token',$this->AccessToken,$cookiesdate);
                    setcookie('access_secret',$this->AccessSecret,$cookiesdate);
                    setcookie('login','is alive',$cookiesdate);
                    header('Location: index.php');
                }
                else
                {
                    echo 'هناك خطأ ما ';
                }
                
            }
            else
            {
                echo 'اسم المستخدم او كلمة المرور غير متطابقة';
            }
        }

}

}