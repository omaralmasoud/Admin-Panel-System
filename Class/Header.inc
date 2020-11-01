<?php

//  Opration on Headers

// Cookies Save and Get



Class CookiesOpration
{
   protected $AccessToken;

 
    public function CookiesCall($Conn)
    {
        

        //check username in database from cookies
        $access_token = $_COOKIE['access_token'];
        $access_secret = $_COOKIE['access_secret'];
       $this->AccessToken = $access_token;
        $CheckCookies = mysqli_query($Conn,'SELECT * FROM authentication WHERE access_token="'.$access_token.'" AND access_secret="'.$access_secret.'" ') or die(mysqli_error($Conn));
        if($CheckCookies)
        {
            // check if Cookies the same
            if(mysqli_num_rows($CheckCookies)>=1)
            {
            // everything is Okay 
            $FetchCookies = mysqli_fetch_assoc($CheckCookies);
            $AdminID= $FetchCookies['id'];
           
            // make a new query to get admin info.
            $GetAdminInfo = mysqli_query($Conn,'SELECT * FROM admins WHERE id = "'.$AdminID.'"') or die(mysqli_error($Conn));
           if($GetAdminInfo)
           {
            $FetchAdminInfo = mysqli_fetch_assoc($GetAdminInfo);
            $AdminRealID = $FetchAdminInfo['id'];
            $AdminUserName = $FetchAdminInfo['username'];

           }
            }
            else 
            {
                $this->DestroyCookies($Conn);
            }
        }
        else
        {
            
            // Delete authentication 
                $DeletePastAuthentication = mysqli_query($Conn,'DELETE FROM `authentication` WHERE id="'.$AdminID.'"') or die(mysqli_error($Conn));           
        
                $DeleteAuthentication = mysqli_query($Conn,'DELETE FROM `authentication` WHERE access_token="'.$this->AccessToken.'"') or die(mysqli_error($Conn));           
            // Destroy cookies and logout
                setcookie('access_token',null,time()-60*60*24);
                setcookie('access_secret',null,time()-60*60*24);
                setcookie('login',null,time()-60*60*24);     
                header('Location: index.php');

            // here we can send to clint he is underrisck and should change his password
        }
    }
    public function DestroyCookies ($Conn)
    {
            // Delete authentication 
                $DeleteAuthentication = mysqli_query($Conn,'DELETE FROM `authentication` WHERE access_token="'.$this->AccessToken.'"') or die(mysqli_error($Conn));           
            // Destroy cookies and logout
                setcookie('access_token',null,time()-60*60*24);
                setcookie('access_secret',null,time()-60*60*24);
                setcookie('login',null,time()-60*60*24);     
                header('Location: index.php');

    }
}