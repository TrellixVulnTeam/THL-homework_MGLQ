<?php
/**Handler the ajax request from the history page, and search the data from database,and response asynchronously
 * @author Mengke Qiu
 */
    function __autoload($a){  //include Owner class and Car class in ;
        $file=$a.'.php';
        if(!class_exists(($file)))
            include '../Model/'.$a.'.php';
    }
    $fs=null;
    $text=null;
    if($_POST['fs']=='select' || $_POST['text']==''){
       echo json_encode("");
    }else{
        $fs=$_POST['fs'];
        $text=$_POST['text'];
    }
/**
 * Build a connection with database.
 *
 * @author Mengke Qiu
 */
    $link=DBConnector::getConnection();
    if(!$link){
        exit('fail to connect the database');
    }
    mysqli_set_charset($link,'uft8');
    mysqli_select_db($link,'parkinglot_manager');
    $sql=null;
    if($fs=="ByCar_ID") {
        $sql = "select * from parking_history where car_id='$text' ";
    }else if($fs=="ByDate"){
        $sql="select * from parking_history where out_time like %'$text'%";
    }
    $res=mysqli_query($link,$sql);
    $check=mysqli_num_rows($res);
    if($check==0)//if the data does not exist, the a "" json data will be responded to history.php, otherwise "pass" json data will be responded.
        echo json_encode("");
    else{
        echo json_encode("pass");
    }
    ?>