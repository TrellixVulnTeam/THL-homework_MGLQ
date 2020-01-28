
<?php
/**
 *   This page is also a transmit page which will not be displayed when using the website, it is used to identify the user.
 *
 *  @Author: Zijian Xiao
 */
header('Content-type:text/html');

$id = $_GET['id'];
$password = $_GET['password'];
session_start();
function __autoload($a){  //include Owner class and Car class in ;
    $file=$a.'.php';
    if(!class_exists(($file)))
        include '../Model/'.$a.'.php';
}

$link=DBConnector::getConnection();
if(!$link){
    exit('fail to connect the database');
}
mysqli_set_charset($link,'uft8');
mysqli_select_db($link,'parkinglot_manager');
//to see if it is an existing account
$sql="select * from manager where id='$id' and password='$password'";
$res=mysqli_query($link,$sql);
$row=mysqli_fetch_assoc($res);

$sql2="select * from manager where id='$id'";
$res2=mysqli_query($link,$sql2);
$row2=mysqli_fetch_assoc($res2);
if($row) {
   
        header('Location:Main.php');
        $_SESSION['id'] = $id;
    
}
//if it does not exist, then go back to login window
else if($row2){
    
    echo '<script language="JavaScript">;alert("password is wrong!");location.href="login.php";</script>;';
    
}
else{ 
    
    echo '<script language="JavaScript">;alert("Account does not exist");location.href="login.php";</script>;';
  
}




?>
