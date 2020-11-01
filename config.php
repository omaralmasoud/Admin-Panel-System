<?php

//connect to database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'controlpanl';

$connectbd = mysqli_connect($host,$username,$password,$database) or die(mysqli_connect_error());

if(mysqli_connect_error())
{
    echo 'There is no connection with database erorr :' . mysqli_connect_error();
}else
{
    // connect Great
  //  echo 'Great Connection'. '<br />';
}



?>