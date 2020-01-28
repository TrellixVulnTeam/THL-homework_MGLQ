
<?php
    /**
     *  This is the main page of our parking-management system. In this page, all the cars currently in the parking lot
     *  will be exhibited by a template, and user, the parking lot manager, will use it to manage the cars by it, manager
     *  can control the cars into the parking lot and out parking lot. The target audience could be the parking lot manager
     *  who works for our college;
     *
     *  @Author: Mengke Qiu
    */
    session_start();

    
    if (! isset($_SESSION['id'])) {
        header('Location:login.php');
    }

    if(!isset($_SESSION['Sort'])) //The session key will be set as a default value 'sortByTime', when user first time to open main page.
        $_SESSION['Sort']='SortByTime';

    function __autoload($a){  //include Owner class and Car class in ;
        $file=$a.'.php';
        if(!class_exists(($file)))
            include '../Model/'.$a.'.php';
    }
    $filter_option=null;
    $res=null;
    //$filter_option=$_GET['filter_selct'];

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
     *The paging query functionality will is the code below, there are five row in each page;
     *
     * parameter: "$count": means all the parking information in Current_parkinglot table;
     *             "$num": refer to how many rows data will be show in one page;
     *             "$page":current page number;
     *             "$offset": It determine table will start at which row.
     * @author Mengke Qiu
     */
    $sql="select count(*) as count from current_parkinglot ";
    $result=mysqli_query($link,$sql);
    if($result==null)
        echo("haha");
    $pageRes=mysqli_fetch_assoc($result);
    $count=$pageRes['count'];
    $num=5; //5 entries will be exhibited in one page
    $pageCount=ceil($count/$num); //Counting the total page's number, for instance, if the $count is 16,therefore $pageCount is 4 and only one entry in last page.
    $page=1;  //default page number is 1.
    if (!empty($_GET['pageNum'])) { // add a judge can prevent from throwing error if the url do not contain 'pageNum' parameter.
        $page=$_GET['pageNum']; //if there is pageNum parameter on url, $page will be update.
    }
//    if($page==null)
//        $page=1;
    $offset=($page-1)*$num; //value $offset is the initial index of current page, it will be used in line 90.
    $next=$page+1;//next page num.
    if($next>$pageCount) {//if $next page num is out range of total page number, $next will stay in last page.
        $next = $pageCount;
    }
    $pre=$page-1; //previous page num
    if($pre<1) {   //same functionality as $next, $pre will stay first page at the initial page.
        $pre = 1;
    }

/**
 * if the use has selected the sorting option, the $sql variable will be reset according to user's selection.
 *  Sorting function will be showed as below
 * @author Mengke Qiu
 */
    $sql=null;
    $temp='';
    if (!empty($_GET['Sorting'])) {
        if($_GET['Sorting']=='SortByPosition')  //if the manager has selected the sorting option, session key='Sort' will be updated.
            $_SESSION['Sort']='SortByPosition';
        else
            $_SESSION['Sort']='SortByTime'; //Sorting by time will be selected as a default option.
    }
    $temp=$_SESSION['Sort'];
    if($temp=='SortByPosition'){
        $sql="select * from current_parkinglot order by position desc  limit $offset  ,$num "; //if 'SortByPosition' was selected, the data will be sort by position
    }else {
        $sql = "select * from current_parkinglot order by in_time desc  limit $offset  ,$num ";// if 'SortByTime' was selected, the data will be sort by entry time.
    }

    echo '<div class="top">';
    echo 'Current Parking lot';
    echo '</div>';
    echo '<div class="top2">';
    echo '<a href="../View/history.php"> ParkingHistory </a>';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;';
    echo ' <a href="../View/Owner_table.php"> Owner Table </a>';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;';
    echo '<input id="logout" class="button1" type="button" value="logout">';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;';
    echo '</div>';

    $res=mysqli_query($link,$sql);
    echo '<table width="800" border="1"  class="altrowstable" id="table">';
    echo '<th>Car_id</th><th>Owner_name</th><th>Owner_id</th><th>Car_Brand</th><th>Car_color</th><th>Owner_tele</th><th>Position</th>
                <th>In_time</th><th>Option</th>';
    while ($rows = mysqli_fetch_assoc($res)) {
        $ownerTemp = new Owner($rows['owner_id'], $rows['owner_name'], $rows['owner_tele']);
        $carTemp = new Car($rows['car_id'], $rows['car_Brand'], $rows['car_color']);
        echo '<tr>';
        echo '<td>' . $carTemp->getCarId() . '</td>';
        echo '<td>' . $ownerTemp->getOwnerName() . '</td>';
        echo '<td>' . $ownerTemp->getOwnerId() . '</td>';
        echo '<td>' . $carTemp->getCarBrand() . '</td>';
        echo '<td>' . $carTemp->getCarColor() . '</td>';
        echo '<td>' . $ownerTemp->getOwnerTele() . '</td>';
        echo '<td>' . $rows['position'] . '</td>';
        echo '<td>' . $rows['in_time'] . '</td>';
        echo '<td><a href="javascript:void(0);" onclick ="judge(\''. $carTemp->getCarId() .'\')">Out</a>
                             <a href="update.php?id=' . $carTemp->getCarId() . '">Update</a>
                            </td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<div class="d1">';
    echo 'page :  ' . $page . '/' . $pageCount . '';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;';
    echo '<a href="add.html">Add</a>';
    echo '</div>';
        ?>
<html>
    <head>
    <link href="../css/main.css" rel='stylesheet' type='text/css' />
        <script type="text/javascript" src="//cdn.bootcss.com/jquery/3.0.0-alpha1/jquery.min.js"></script>
        <script>
            /**
                User can search car's information by inputting car's id.
                Therefore Ajax is used to response the request from main page asynchronously.

                @author Mengke Qiu;
             */
            $(function () {
                $('#filter').click(function () {
                    var car_id=$('#car_idd').val();
                    console.log(car_id);
                    $.ajax({
                            type: "post",
                            url: "../Control/handlerAjax.php",
                            data: {car_id: car_id},
                            dataType: "json",
                            success: function (msg) {
                                $('#text').empty();                     //remove the information at span
                                var data ='';
                                if (msg !='') {
                                    data = eval("(" + msg + ")");      //evaluate the json data
                                    $('#text').html("[Owner_Name]: "+data.ownerName+"[Owner_id] :"+data.ownerID+" [car_id] :"+data.car_id+" [car_Brand] :"+data.car_Brand+" [car_color] :"+data.car_color+" [Position] :"+data.position+" [in_time] :"+data.in_time);    //print out at html text
                                    var obj=document.getElementById("del_single");
                                    obj.href="../Control/del.php?id="+data.car_id;
                                    obj.innerText="delete";
                                    var obj2=document.getElementById("update_single");
                                    obj2.href="update.php?id="+data.car_id;
                                    obj2.innerText="update";
                                }else {
                                    $('#text').html("Car_id does not exist");   //This message will be showed once data can not be found at database.
                                    var obj=document.getElementById("del_single");
                                    obj.href="";
                                    obj.innerText="";
                                    var obj2=document.getElementById("update_single");
                                    obj2.href="";
                                    obj2.innerText="";
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
    </head>
    <body class="body">
    

	<div class="main">
		<a href="Main.php?pageNum=1">Home page</a> &nbsp;&nbsp;&nbsp;<a
			href="Main.php?pageNum=<?=$pre?>">Pre page</a> &nbsp;&nbsp;&nbsp;<a
			href="Main.php?pageNum=<?=$next?>">Next page</a> <br />

<br>
 <div class="option">  
    
    <form action="Main.php" method="get">
        <select name="Sorting" id="Sorting">
            <option value="<?=$_SESSION['Sort']?>">--Sorting at here--</option>
            <option value="SortByPosition">--Sort by Position--</option>
            <option value="SortByTime">--Sort by entry time--</option>
        </select>
        <input type="submit" value="Sort"/>
    </form>
</div>
        <script>
   document.getElementById("logout").onclick=function(){
	   alert('logout,wait for 3 seconds');
	 var timeoutId = setTimeout(function () {
		window.location.href="logout.php";
		
	    }, 1000);
	}
   </script>
   <script type="text/javascript">
   /**
	A judge window will jump out to confirm the users' operation
	@Author Xiao zijian;
	*/
   function judge($a) 
   {
	   if(confirm('delete for sure?')){
		   window.location.href='../Control/del.php?id='+$a+'';
		   return true;
		 }return false;
   }
   </script>
		<div class="bottom">
			Search car by car_id:<br> <input type="text" id="car_idd" />&nbsp;&nbsp;<input
				type="button" class="button2" id="filter" name="filter"
				value="filter"> <br> <span id="text"></span> <br> <a href=""
				id="del_single"></a> &nbsp;&nbsp;&nbsp; <a href=""
				id="update_single"></a> 
		</div>
		
	</div>
</body>
</html>
    
    
    



