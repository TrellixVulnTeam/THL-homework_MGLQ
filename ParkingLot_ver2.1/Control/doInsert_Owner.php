<?php
/** Response the request from add_owner.html, then insert a new owner data to car_owner_info in database
 *
 *@author Mengke Qiu
 */
function __autoload($a){  //include "Owner class" and "Car class" in ;
    $file=$a.'.php';
    if(!class_exists(($file)))
        include '../Model/'.$a.'.php';
}

$carTemp=new Car($_GET['Car_ID'],$_GET['Car_Brand'],$_GET['Car_Color']);
$ownerTemp=new Owner($_GET['ownerID'],$_GET['owner_name'],$_GET['Owner_Tele']);
$Car_id=$carTemp->getCarId();
$Owner_id=$ownerTemp->getOwnerId();
$ownerName=$ownerTemp->getOwnerName();
$Car_Brand=$carTemp->getCarBrand();
$Car_Color=$carTemp->getCarColor();
$Owner_tele=$ownerTemp->getOwnerTele();
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
$sql = "insert into car_owner_info (ownerID,Owner_name,car_id,car_Brand,car_color,Owner_tele)
            values ( $Owner_id,'$ownerName' ,'$Car_id','$Car_Brand','$Car_Color','$Owner_tele')";
$res = mysqli_query($link, $sql);
if($res) {
    echo '<script language="JavaScript">;alert("Successfully insert");location.href="../View/Owner_table.php";</script>;';
   
}else{
    echo '<script language="JavaScript">;alert("The car_id already exist at table, try again!");location.href="../View/Owner_table.php";</script>;';

}