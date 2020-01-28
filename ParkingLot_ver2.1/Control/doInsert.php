<?php
/** This page will response the request from "Add.html", then use the data from "Add.html",then insert
 *  the data to the database, the parameter include "id" means the Car_id in database, and "position" means,the
 * position in parking lot.
 *
 *@author Mengke Qiu
 */
    function __autoload($a){  //include "Owner class" and "Car class" in ;
        $file=$a.'.php';
        if(!class_exists(($file)))
            include '../Model/'.$a.'.php';
    }
    $id=$_GET['id'];
    $position=$_GET['position'];
   
    /*
     * This page can not be opened directly, which means it only can be opened from "Add.html",
     * once it is opened directly,the function below will let redirect the page to "Main.php".
     *
     */
    if($id==null || $position==null ){
       header('location:../View/Main.php');
    }
    /*
     * if the car is already in current parking lot, therefore an error message will alert. The user will be asked to insert again
     */
    $link=DBConnector::getConnection();
    mysqli_select_db($link,'parkinglot_manager');
    $sql="select * from current_parkinglot where car_id='$id'";
    $res = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($res);
    if($row!=null){
        echo '<script language="JavaScript">;alert("The car is already in parking lot");location.href="../View/Add.html";</script>;';
        exit();
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
    mysqli_select_db($link,'parkinglot_manager');
    /*
     * The function below will assess whether the position is empty or not,
     * if the position is already reserved, the user would be ask to select another position again.
     */
    $sql="select * from current_parkinglot where position='$position'";
    $res=mysqli_query($link,$sql);
    $check=mysqli_num_rows($res);
    if($check!=0){
        echo '<script language="JavaScript">;alert("The position in parking lot is reserved,please choose another one");location.href="../View/Add.html";</script>;';
        exit();
    }
        $sql = "select * from car_owner_info where car_id='$id'";
        $res = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($res);
        $ownerTemp = new Owner($row['ownerID'], $row['Owner_name'], $row['Owner_tele']);
        $carTemp = new Car($row['car_id'], $row['car_Brand'], $row['car_color']);
        $ownerName = $ownerTemp->getOwnerName();
        $ownerID = $ownerTemp->getOwnerId();
        $car_id = $carTemp->getCarId();
        $car_Brand = $carTemp->getCarBrand();
        $car_color = $carTemp->getCarColor();
        $owner_tele = $ownerTemp->getOwnerTele();
        /**
         * If the user input a wrong car's id, the error message will be show,otherwise the "successfully insert" message will be exhibited.
         *
         */
        if (!$row) {
            echo '<script language="JavaScript">;alert("ID does not exist");location.href="../View/Add.html";</script>;';
            
        } else {
            $sql = "insert into current_parkinglot (owner_id,owner_name,car_id,car_Brand,car_color,owner_tele, position)
            values ( $ownerID,'$ownerName' ,'$car_id','$car_Brand','$car_color',$owner_tele , '$position')";
            $res = mysqli_query($link, $sql);
            echo '<script language="JavaScript">;alert("successfully insert");location.href="../View/Main.php";</script>;';         
    }
    