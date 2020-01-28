<?php
/** The current parking lot deleting will be realized as below, due to there is another table,"history", relate to the current
 * parking lot table, therefore before deleting the data, the data should be inserted into "history" table at first.
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
        header('location:../View/Main.php');
    }
/**
 * Build a connection with database.
 *
 * @author Mengke Qiu
 */
$link=DBConnector::getConnection();

mysqli_set_charset($link,'uft8');
    mysqli_select_db($link,'parkinglot_manager');

    /**
     * The data which gonna be deleted will add to history table at first, then delete action will be done as follow
     */
    $sql="select * from current_parkinglot where car_id='$Car_id'";
    $res=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($res);
    $ownerTemp=new Owner($row['owner_id'],$row['owner_name'],$row['owner_tele']);
    $carTemp=new Car($row['car_id'],$row['car_Brand'],$row['car_Brand']);
    $owner_name=$ownerTemp->getOwnerName();
    $owner_id=$ownerTemp->getOwnerId();
    $car_id =$carTemp->getCarId();
    $car_Brand =$carTemp->getCarBrand();
    $car_color =$carTemp->getCarColor();
    $owner_tele =$ownerTemp->getOwnerTele();
    $position=$row['position'];
    $in_time =$row['in_time'];

    //insert function
    $sql="insert into parking_history (owner_id,owner_name,car_id,car_Brand,car_color,owner_tele, position,in_time) 
            values ( $owner_id, '$owner_name','$car_id','$car_Brand','$car_color','$owner_tele' , '$position','$in_time')";
    $res=mysqli_query($link,$sql);
    //delete function
    $sql="delete from current_parkinglot where car_id='$Car_id'";
        $boolean=mysqli_query($link,$sql);
        if($boolean)
            echo '<script language="JavaScript">;alert("Successfully delete");location.href="../View/Main.php";</script>;';
        
        else{
            echo '<script language="JavaScript">;alert("error");location.href="../View/Main.php";</script>;';
          
        }
    echo '<br/>';
  

