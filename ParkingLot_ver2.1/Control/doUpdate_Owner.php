<?php
/**Response the request from "update_Owner_table.php" page,the update the data to database.
 *
 * @author Mengke Qiu
 */
function __autoload($a){  //include "Owner class" and "Car class" in ;
    $file=$a.'.php';
    if(!class_exists(($file)))
        include '../Model/'.$a.'.php';
}
$carTemp=new Car($_GET['car_id'],$_GET['Car_Brand'],$_GET['Car_Color']);
$ownerTemp=new Owner($_GET['ownerID'],$_GET['owner_name'],$_GET['Owner_tele']);
$Car_id=$carTemp->getCarId();
$Owner_id=$ownerTemp->getOwnerId();
$ownerName=$ownerTemp->getOwnerName();
$Car_Brand=$carTemp->getCarBrand();
$Car_Color=$carTemp->getCarColor();
$Owner_tele=$ownerTemp->getOwnerTele();


if($carTemp->getCarId()==null|| $ownerTemp->getOwnerId()==null) //If the page was opened directly, which means it is not opened from the update_Owner_table.php page, this page will be redirected to Owner_table.php page
    header('location:../View/Owner_table.php');

/**
 * Build a connection with database.
 *
 * @author Mengke Qiu
 */
$link=DBConnector::getConnection();

mysqli_set_charset($link,'uft8');
mysqli_select_db($link,'parkinglot_manager');
$sql="update car_owner_info set car_id='$Car_id',Owner_name='$ownerName' ,ownerID=$Owner_id , car_Brand='$Car_Brand', 
        car_color='$Car_Color', Owner_tele='$Owner_tele' where car_id='$Car_id'";
$res=mysqli_query($link,$sql);
if($res){
    echo '<script language="JavaScript">;alert("Update successfully");location.href="../View/Owner_table.php";</script>;';
}else{
    echo '<script language="JavaScript">;alert("fail to update");location.href="../View/Owner_table.php";</script>;';
}