<?php

/** Update the data in car_owner_info, the function is similar to main page "update.php"
 *
 * @author Mengke Qiu
 */
function __autoload($a)
{ // include Owner class and Car class in ;
    $file = $a . '.php';
    if (! class_exists(($file)))
        include '../Model/' . $a . '.php';
}
$id = $_GET['id'];
if ($id == null) {
    header('location:Main.php');
}

/**
 * Build a connection with database.
 *
 * @author Mengke Qiu
 */
$link = DBConnector::getConnection();

mysqli_set_charset($link, 'uft8');
mysqli_select_db($link, 'parkinglot_manager');
$sql = "select * from car_owner_info where car_id='$id'";
$res = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($res);
?>
<html xmlns:visibility="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript">

// <!---This page is used to update owner information and for boundary test------>
// <!----@author Xiao zijian----->
	function testI(a) {
		var reg = /^[1-9]\d{0,8}$/;
		return reg.test(a);

	}
	/**
	 *   A new button is created to hide the submit button, since the action of form is always triggered at first!
	 *
	 *  @Author: Zijian Xiao
	 */
	function test() {
		var a = document.getElementsByName("ownerID")[0].value;
		if (document.getElementsByName("ownerID")[0].value == ''
				|| document.getElementsByName("owner_name")[0].value == ''
				|| document.getElementsByName("car_id")[0].value == ''
				|| document.getElementsByName("Owner_tele")[0].value == ''
				|| document.getElementsByName("Car_Brand")[0].value == ''
				|| document.getElementsByName("Car_Color")[0].value == '') 
			{
			alert("cannot be empty");

		} else if (testI(a) == false) {
			console.log(a);
			alert("ownerID must be a 0-8 bits digit");
		} else {
			document.add.bt2.click();
		}
	}
</script>
<link href="../css/update_Owner.css" rel='stylesheet' type='text/css' />
</head>
<body>
	<div class="form">
		<form name="add" id="add" action="../Control/doUpdate_Owner.php">
			OwnerID:<input type="text" value="<?=$row['ownerID']?>" name="ownerID"><br>
            Owner Name:<input type="text" value="<?=$row['Owner_name']?>" name="owner_name"><br>
            Car ID:<input type="text" value="<?=$row['car_id']?>" name="car_id"><br>
            Car Brand:<input type="text" value="<?=$row['car_Brand']?>" name="Car_Brand"><br>
            Car Color:<input type="text" value="<?=$row['car_color']?>" name="Car_Color"><br>
            Owner telephone:<input type="text" value="<?=$row['Owner_tele']?>" name="Owner_tele"><br>
            <input type="button" name="bt1" value="update" onclick=" test()"> <input type="submit" name="bt2" visibility: hidden value="update">
		</form>
		<div>
			<br> <a href="Main.php">Back to MainPage</a>
		</div>
	</div>
</body>
</html>