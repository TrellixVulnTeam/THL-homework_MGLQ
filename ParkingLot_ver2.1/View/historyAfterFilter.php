<?php
    $filter_selct=$_GET['filter_select'];
    $txt=$_GET['txt'];
    if($filter_selct==null || $txt==null) { //This page can not be opened directly which means the user has to open it after filtering.
        header("location:Main.php");
    }

//include Owner class and Car class in ;
    function __autoload($a){
        $file=$a.'.php';
        if(!class_exists(($file)))
            include '../Model/'.$a.'.php';
    }
$link=DBConnector::getConnection();
if(!$link){
        exit('fail to connect the database');
    }
    mysqli_set_charset($link,'uft8');
    mysqli_select_db($link,'parkinglot_manager');

    $sql;
    if($filter_selct=="ByCar_ID"){
        $sql="select count(*) as count from parking_history where car_id='$txt'";
    }else if($filter_selct=="$txt"){
        $sql="select count(*) as count from parking_history where out_time like %'$text'%";
    }

    $result=mysqli_query($link,$sql);
    $pageRes=mysqli_fetch_assoc($result);
    $count=$pageRes['count'];
    $num=5;
    $pageCount=ceil($count/$num);
    $page=1;
    if (!empty($_GET['pageNum'])) {
        $page=$_GET['pageNum'];
    }
    if($page==null)
        $page=1;
    $offset=($page-1)*$num;
    $next=$page+1;
    if($next>$pageCount) {
        $next = $pageCount;
    }
    $pre=$page-1;
    if($pre<1) {
        $pre = 1;
    }
    $sql="select * from parking_history order by out_time desc  limit $offset  ,$num ";
    if($filter_selct=="ByCar_ID"){
        $sql="select * from parking_history where car_id='$txt' order by out_time desc  limit $offset  ,$num ";
    }else if($filter_selct=="$txt"){
        $sql="select * from parking_history where out_time like %'$txt'% order by out_time desc  limit $offset  ,$num ";
    }
    echo '<div class="top">';
    echo 'History After Filter';
    echo '</div>';

/**
 * Same functionality as the paging querying in main page line 51-73
 */
    $res=mysqli_query($link,$sql);
    echo '<table width="1000" border="1"  class="altrowstable" id="table">';
    echo '<th>Car_id</th><th>Owner_Name</th><th>Owner_id</th><th>Car_Brand</th><th>Car_color</th><th>Owner_tele</th><th>Position</th>
                        <th>In_time</th><th>out_time</th>';
    while($rows=mysqli_fetch_assoc($res)){
        $ownerTemp=new Owner($rows['owner_id'],$rows['owner_name'],$rows['owner_tele']);
        $carTemp=new Car($rows['car_id'],$rows['car_Brand'],$rows['car_color']);
        echo '<tr>';
        echo   '<td>'.$carTemp->getCarId().'</td>';
        echo   '<td>'.$ownerTemp->getOwnerName().'</td>';
        echo   '<td>'.$ownerTemp->getOwnerId().'</td>';
        echo   '<td>'.$carTemp->getCarBrand().'</td>';
        echo   '<td>'.$carTemp->getCarColor().'</td>';
        echo   '<td>'.$ownerTemp->getOwnerTele().'</td>';
        echo   '<td>'.$rows['position'].'</td>';
        echo   '<td>'.$rows['in_time'].'</td>';
        echo   '<td>'.$rows['out_time'].'</td>';
        echo    '<td><a href="../Control/del_Filter_History.php?stamp='.$rows['stamp'].'&filter_select='.$filter_selct.'&txt='.$txt.'">delete</a> </td>';
        echo    '</tr>';
    }
    echo '</table>';
    echo'<div class="d1">';
    
    echo 'page :  '.$page.'/'.$pageCount.'';
    echo '<br>';
    echo'</div>';
?>
<html>
<head>
<link href="../css/historyAfterFilter.css" rel='stylesheet' type='text/css' />
</head>
<body>
<div class="main"> 
<br/>
<a href="historyAfterFilter.php?pageNum=1&filter_select=<?=$filter_selct?>&txt=<?=$txt?>" >First page</a> &nbsp;&nbsp;&nbsp;<a href="historyAfterFilter.php?pageNum=<?=$pre?>&filter_select=<?=$filter_selct?>&txt=<?=$txt?>" >Pre page</a> &nbsp;&nbsp;&nbsp;<a href="historyAfterFilter.php?pageNum=<?=$next?>&filter_select=<?=$filter_selct?>&txt=<?=$txt?>" >Next page</a>
<br/><br/>
<a href="history.php">Back to History Page</a>
<br/><br/>
<a href="Main.php"> Back to MainPage</a>
</div>
</body>
</html>

