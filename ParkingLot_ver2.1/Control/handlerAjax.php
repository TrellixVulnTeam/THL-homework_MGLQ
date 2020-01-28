<?php
/**Handler the ajax request from the Main.php page, and search the data from database,and response asynchronously
 *
 * @author Mengke Qiu
 */
    header('Content-type:text/json;charset=utf-8');
    function __autoload($a){  //include Owner class and Car class in ;
        $file=$a.'.php';
        if(!class_exists(($file)))
            include '../Model/'.$a.'.php';
    }
    $car_id=$_POST['car_id'];
    $car_id=strtoupper($car_id);

/**
 * Build a connection with database.
 *
 * @author Mengke Qiu
 */
    $link=DBConnector::getConnection();

    if(!$link){
        exit('fail to connect the database');
    }
//build a connection with database.
    mysqli_set_charset($link,'uft8');
    mysqli_select_db($link,'parkinglot_manager');
    $sql="select * from current_parkinglot where car_id='$car_id'";
    $res=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($res);

    $ownerTemp=new Owner($row['owner_id'],$row['owner_name'],$row['owner_tele']);
    $carTemp=new Car($row['car_id'],$row['car_Brand'],$row['car_color']);
    $position=$row['position'];
    $in_time=$row['in_time'];
    if($ownerTemp->getOwnerId()==null){
        echo json_encode("");
    }else {
        $data = '{ownerName:"' . $ownerTemp->getOwnerName() . '",ownerID:"' . $ownerTemp->getOwnerId() . '",car_id:"' . $carTemp->getCarId() . '",car_Brand:"' . $carTemp->getCarBrand() . '",car_color:"' . $carTemp->getCarColor(). '",position:"' . $position . '",in_time:"' . $in_time . '"}';
        echo json_encode($data);//output json data to main.php
    }
    ?>