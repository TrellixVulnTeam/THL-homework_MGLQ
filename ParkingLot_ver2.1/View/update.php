<?php
function __autoload($a){  //include Owner class and Car class in ;
    $file=$a.'.php';
    if(!class_exists(($file)))
        include '../Model/'.$a.'.php';
}
    $id=$_GET['id'];
    if($id==null){
        header('location:Main.php');
    }
/**
 * Build a connection with database.
 *
 * @author Mengke Qiu
 */
$link=DBConnector::getConnection();
    mysqli_select_db($link,'parkinglot_manager');
    $sql="select * from current_parkinglot where car_id='$id'";
    $res=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($res);
    ?>
<html>
<head>
 <link href="../css/update.css" rel='stylesheet' type='text/css' />
</head>
<body>
    <form action="../Control/doUpdate.php" class="font">
        Car_id:  <?=$row['car_id']?><input type="text" style="display:none" value="<?=$row['car_id']?>" name="Car_id"><br>
        Owner_Name: <?=$row['owner_name']?><input type="text" style="display:none" value="<?=$row['owner_name']?>" name="owner_name"><br>
        Owner_id: <?=$row['owner_id']?><input type="text" style="display:none" value="<?=$row['owner_id']?>" name="Owner_id"><br>
        Car_Brand: <?=$row['car_Brand']?><input type="text" style="display:none" value="<?=$row['car_Brand']?>" name="Car_Brand"><br>
        Car_Color: <?=$row['car_color']?><input type="text" style="display:none" value="<?=$row['car_color']?>" name="Car_Color"><br>
        Owner_tele: <?=$row['owner_tele']?><input type="text" style="display:none" value="<?=$row['owner_tele']?>" name="Owner_tele"><br>
        <br><br>
        <div class="two">
        Position:<input type="text" value="<?=$row['position']?>" name="Position"><br>
        In_time:<input type="text" value="<?=$row['in_time']?>" name="In_time"><br>
        </div>
        <input type="submit" value="Update"><br>
    </form>
    <div>
	<br>
	<a href="Main.php">Back to MainPage</a>
	</div>
    </body>
</html>

