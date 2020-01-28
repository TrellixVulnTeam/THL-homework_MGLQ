<?php
/**Response the request from "history.php" page, and do the delete function.
 *
 * @author Mengke Qiu
 */
function __autoload($a){  //include Owner class and Car class in ;
    $file=$a.'.php';
    if(!class_exists(($file)))
        include '../Model/'.$a.'.php';
}
$Car_id=$_GET['id'];
if($Car_id==null){
    header('location:history.php');
}

/**
 * Build a connection with database.
 *
 * @author Mengke Qiu
 */
$link=DBConnector::getConnection();

mysqli_set_charset($link,'uft8');
mysqli_select_db($link,'parkinglot_manager');
$sql="delete from parking_history where car_id='$Car_id'";
$boolean=mysqli_query($link,$sql);
if($boolean)
    echo '<script language="JavaScript">;alert("Successfully delete");location.href="../View/history.php";</script>;';
else{
    echo '<script language="JavaScript">;alert("error");location.href="../View/history.php";</script>;';
}
echo '<br/>';
