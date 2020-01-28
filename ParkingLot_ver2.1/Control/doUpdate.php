<?php
/**Response the request from "update.php" page,the update the data to database.
 *
 * @author Mengke Qiu
 */
    function __autoload($a){  //include "Owner class" and "Car class" in ;
        $file=$a.'.php';
        if(!class_exists(($file)))
            include '../Model/'.$a.'.php';
    }
    $carTemp=new Car($_GET['Car_id'],$_GET['Car_Brand'],$_GET['Car_Color']);
    $ownerTemp=new Owner($_GET['Owner_id'],$_GET['owner_name'],$_GET['Owner_tele']);
    $Car_id=$carTemp->getCarId();
    $Owner_id=$ownerTemp->getOwnerId();
    $ownerName=$ownerTemp->getOwnerName();
    $Car_Brand=$carTemp->getCarBrand();
    $Car_Color=$carTemp->getCarColor();
    $Owner_tele=$ownerTemp->getOwnerTele();
    $Position=$_GET['Position'];
    $In_time=$_GET['In_time'];
  

    if($carTemp->getCarId()==null|| $ownerTemp->getOwnerId()==null) //If the page was opened directly, which means it is not opened from the update.php page, this page will be redirected to Main.php page
          header('location:../View/Main.php');
    //build a connection with database.
/**
 * Build a connection with database.
 *
 * @author Mengke Qiu
 */
          function testI($a)
          {
              return preg_match('/^[0-2]\d{2}$/', $a);
          }
          
          if(testI($Position)==false){
              echo '<script language="JavaScript">;alert("position must be set between 000 to 299 ");location.href="../View/main.php";</script>;';
             
          }
          else{
$link=DBConnector::getConnection();

    mysqli_set_charset($link,'uft8');
    mysqli_select_db($link,'parkinglot_manager');
    $sql="update current_parkinglot set car_id='$Car_id',owner_name='$ownerName' ,owner_id=$Owner_id , car_Brand='$Car_Brand', 
        car_color='$Car_Color', owner_tele='$Owner_tele', position='$Position', in_time='$In_time' where car_id='$Car_id'";
    $res=mysqli_query($link,$sql);
    
 
    
    
   
        if($res){
        echo '<script language="JavaScript">;alert("Update successfully");location.href="../View/Main.php";</script>;';
        //echo 'Update successfully <a href="../View/Main.php" >Home</a>';
    }
        else{
        echo '<script language="JavaScript">;alert("fail to update ");location.href="../View/Main.php";</script>;';
        //echo 'fail to update <a href="../View/Main.php" >Home</a>';
}
          }
