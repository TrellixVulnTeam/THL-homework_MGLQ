<?php
/** To show the parking history in database, In addition, user can search data by car's id,
 *  Ajax is used to request the server, if input is wrong, a error message wil be responded in current page,
 * otherwise the page "historyAfterFilter.php" will open.
 *
 * @author Mengke Qiu
 */
    function __autoload($a){  //include Owner class and Car class in ;
        $file=$a.'.php';
        if(!class_exists(($file)))
            include '../Model/'.$a.'.php';
    }

    
    session_start();
    
    if(!isset($_SESSION['id'])){
        header('Location:login.php');
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
/**
 * Same functionality as the paging querying in main page line 51-73
 */
    $sql="select count(*) as count from parking_history ";
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
    
    echo '<div class="top">';
    echo 'Parking History';
    echo '</div>';
    
    $sql="select * from parking_history order by out_time desc  limit $offset  ,$num ";
    $res=mysqli_query($link,$sql);
    echo '<table width="900" border="1" class="altrowstable" id="table">';
    echo '<th>Car_id</th><th>Owner_Name</th><th>Owner_id</th><th>Car_Brand</th><th>Car_color</th><th>Owner_tele</th><th>Position</th>
                    <th>In_time</th><th>out_time</th><th>Option</th>';
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
       
        echo    '<td><a href="javascript:void(0);" onclick ="judge(\''. $carTemp->getCarId() .'\')">delete</a> </td>';
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
    <link href="../css/history.css" rel='stylesheet' type='text/css' />
        <script type="text/javascript" src="//cdn.bootcss.com/jquery/3.0.0-alpha1/jquery.min.js"></script>
        <script>
            /*
               User can search car's information by inputting car's id.
               Therefore Ajax is used to response the request from history page asynchronously.

               @Author Mengke Qiu;
            */
            $(function () {
                $('#filter').click(function () {
                    var txt=$('#txt').val();
                    var filter_selct=$('#filter_selct').val();
                    console.log(txt);
                    console.log(filter_selct);
                    $.ajax({
                            type: "post",
                            url: "../Control/history_ajaxHandler.php",
                            data: {fs: filter_selct,text: txt},
                            dataType: "json",
                            success: function (msg) {
                                $('#text').empty();                     //clear the div at first
                                var data ='';
                                if (msg =='') {
                                    $('#text').html("The data does not exist!");
                                }
                                else if(msg!='') {
                                    console.log(44);
                                   window.location.href="historyAfterFilter.php?filter_select="+filter_selct+"&txt="+txt;
                                }
                            },
                            error: function (msg) {
                                console.log(msg);
                            }
                        }
                    )
                });
            });
        </script>
        
         
 
<script type="text/javascript">
	/*
	A judge window will jump out to confirm the users' operation
	@Author Xiao zijian;
	*/
   function judge($a) 
   {
	   if(confirm('delete for sure?')){
		   window.location.href='../Control/del_history.php?id='+$a+'';
		   return true;
		 }return false;
   }

   </script>
</head>
    <body>
    <br/>
    <div class="main">
    <a href="history.php?pageNum=1" >Home page</a> &nbsp;&nbsp;&nbsp;<a href="history.php?pageNum=<?=$pre?>" >Pre page</a> &nbsp;&nbsp;&nbsp;<a href="history.php?pageNum=<?=$next?>" >Next page</a>
    <br/>
    <a href="Main.php">Back to MainPage</a>
    <br/>
    <div class="option">
    &nbsp;&nbsp;&nbsp;&nbsp;
        <select name="filter_selct" id="filter_selct">
            <option value="select" >--select--</option>
            <option value="ByCar_ID" >--ByCar_ID--</option>
<!--            <option value="ByDate"  >--ByDate--</option>-->
        </select>
        <div class="opRight">
            <input type="text" name="txt" id="txt"> &nbsp;&nbsp;<input type="button" id="filter" name="filter" value="filter">

        <span id="text" style="color: white" ></span>
         </div>
         </div>
        </div>
        </body>
        </html>