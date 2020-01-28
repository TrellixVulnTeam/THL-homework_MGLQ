<?php
/**Response the request from "historyAfterFilter.php", and do the delete action.
 *
 * @param $stamp: this parameter is used to determine the exact single data in history table.
 * @author Mengke Qiu
 */
function __autoload($a){  //include Owner class and Car class in ;
    $file=$a.'.php';
    if(!class_exists(($file)))
        include '../Model/'.$a.'.php';
}
    $stamp=$_GET['stamp'];
    $filter_select=$_GET['filter_select'];
    $Car_id=$_GET['txt'];
    if($Car_id==null){
        header('location:../View/Main.php');
    }

/**
 * Build a connection with database.
 *
 * @author Mengke Qiu
 */
$link=DBConnector::getConnection();

/**
 * alert message and deliver the value back
 *
 * @author Xiao zijian
 */
    mysqli_select_db($link,'parkinglot_manager');
    $sql="delete from parking_history where car_id='$Car_id' and stamp=$stamp ";
    $boolean=mysqli_query($link,$sql);
    if($boolean)
        echo '<script language="JavaScript">alert("Successfully delete");
    window.location.href="../View/historyAfterFilter.php?filter_select='.$filter_select.'&txt='.$Car_id.'";
    </script>';
    else{
        echo "error";
    }
    echo '<br/>';
   