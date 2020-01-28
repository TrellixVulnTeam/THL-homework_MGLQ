<?php

/**In this page, all the owner data will be exhibited in here, and the manager can do the CRUD function will owner table
 * Moreover, user can search owner information by owner id.
 * @author Mengke Qiu
 */
function __autoload($a)
{ // include Owner class and Car class in ;
    $file = $a . '.php';
    if (! class_exists(($file)))
        include '../Model/' . $a . '.php';
}

/**
 * Build a connection with database.
 *
 * @author Mengke Qiu
 */
$link = DBConnector::getConnection();

if (! $link) {
    exit('fail to connect the database');
}
/**
 * Same functionality as the paging querying in main page line 51-73
 */
mysqli_set_charset($link, 'uft8');
mysqli_select_db($link, 'parkinglot_manager');
$sql = "select count(*) as count from car_owner_info ";
$result = mysqli_query($link, $sql);
if ($result == null)
    echo ("haha");
$pageRes = mysqli_fetch_assoc($result);
$count = $pageRes['count'];
$num = 5;
$pageCount = ceil($count / $num);
$page = 1;
if (! empty($_GET['pageNum'])) {
    $page = $_GET['pageNum'];
}
if ($page == null)
    $page = 1;
$offset = ($page - 1) * $num;
$next = $page + 1;
if ($next > $pageCount) {
    $next = $pageCount;
}
$pre = $page - 1;
if ($pre < 1) {
    $pre = 1;
}

echo '<div class="top">';
echo 'Owner Table';
echo '</div>';

$sql = "select * from car_owner_info order by ownerID desc  limit $offset  ,$num ";
$res = mysqli_query($link, $sql);
echo '<table width="800" border="1" class="altrowstable" id="table">';
echo '<th>OwnerID</th><th>Owner_name</th><th>Car_id</th><th>Car_Brand</th><th>Car_color</th><th>Owner_tele</th><th>Option</th>';
while ($rows = mysqli_fetch_assoc($res)) {
    $ownerTemp = new Owner($rows['ownerID'], $rows['Owner_name'], $rows['Owner_tele']);
    $carTemp = new Car($rows['car_id'], $rows['car_Brand'], $rows['car_color']);
    echo '<tr>';
    echo '<td>' . $ownerTemp->getOwnerId() . '</td>';
    echo '<td>' . $ownerTemp->getOwnerName() . '</td>';
    echo '<td>' . $carTemp->getCarId() . '</td>';
    echo '<td>' . $carTemp->getCarBrand() . '</td>';
    echo '<td>' . $carTemp->getCarColor() . '</td>';
    echo '<td>' . $ownerTemp->getOwnerTele() . '</td>';

    echo '<td><a href="javascript:void(0);" onclick ="judge(\''. $carTemp->getCarId() .'\')">delete</a> 
                             <a href="update_Owner_table.php?id=' . $carTemp->getCarId() . '">Update</a>
                            </td>';
    echo '</tr>';
}
echo '</table>';
echo '<div class="d1">';

echo 'page :  ' . $page . '/' . $pageCount . '';
echo '<br>';
echo '</div>';
?>
<html>
<head>
<link href="../css/Owner_table.css" rel='stylesheet' type='text/css' />

<script type="text/javascript">
              /*
          	A judge window will jump out to confirm the users' operation
          	@Author Xiao zijian;
          	*/
   function judge($a) 
   {
	   if(confirm('delete for sure?')){
		   window.location.href='../Control/del_Owner_table.php?id='+$a+'';
		   return true;
		 }return false;
   }

   </script>
</head>
<body>
	<div class="main">
		<br /> <a href="Owner_table.php?pageNum=1">Home page</a>
		&nbsp;&nbsp;&nbsp;<a href="Owner_table.php?pageNum=<?=$pre?>">Pre page</a>
		&nbsp;&nbsp;&nbsp;<a href="Owner_table.php?pageNum=<?=$next?>">Next
			page</a> <br /> <br /> <a href="add_owner.html">Add</a> <br>
		<br> <a href="Main.php">Back to MainPage</a> <br>
	</div>
</body>

</html>
