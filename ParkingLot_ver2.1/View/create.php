<?php

/**
 *  This is the create page of the website, users can create new account in this page.
 *
 *  @Author: Zijian Xiao
 */
header('Content-type:text/html');
if (isset($_POST['submit'])) {
    if (isset($_POST['id']) && isset($_POST['password'])) {

        $a = $_POST['id'];
        $b = $_POST['password'];
        function __autoload($a){  //include Owner class and Car class in ;
            $file=$a.'.php';
            if(!class_exists(($file)))
                include '../Model/'.$a.'.php';
        }

        $link=DBConnector::getConnection();
        if (! $link) {
            exit('fail to connect the database');
        }
        mysqli_set_charset($link, 'uft8');
        mysqli_select_db($link, 'parkinglot_manager');
        $sql1 = "select * from manager where id='$a' and password='$b'";
        $res = mysqli_query($link, $sql1);
        $row = mysqli_fetch_assoc($res);
        if ($row) {
            echo "<script>alert('existed account!')</script>";
            // echo ("existed account!");
        } else if (! testI($a)) {
            echo "<script>alert('id must be a string of 6-16 characters which contains one letter and one digit at least')</script>";
            // echo ("id must be a string of 6-16 characters which contains one letter and one digit at least");
        } else if (! testP($b)) {
            echo "<script>alert('password must be a string contains 6 characters at least')</script>";
            // echo ("password must be a string contains 6 characters at least");
        } else {
            $sql2 = "insert into manager (id,password)
            values ( '$a', '$b')";
            $res = mysqli_query($link, $sql2);
            var_dump($res);
           
            echo '<script language="JavaScript">;alert("successfully create! ");location.href="../View/login.php";</script>;';
            // echo "successfully insert";
        }
    }
}

function testI($a)
{
    return preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,16}$/', $a);
}

function testP($b)
{
    return preg_match('/^.{6,}$/', $b);
}

?>


<!DOCTYPE html>
<html>
<head>
<title>Create</title>
<meta charset="utf-8">
<link href="../css/create.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="body">
	<!-----start-main---->
	<div class="main">
		<div class="login-form">
			<h1>Create account</h1>
			<div class="head">
				<img src="../images/image2.jpg" height="190" width="190"
					align="middle" alt="" />
			</div>
			<form method="post" action="create.php">
				<input type="text" class="text" name="id" value="USERNAME"
				onfocus="if(this.value == 'USERNAME') {this.value = '';}"
					onblur="if (this.value == '') {this.value = 'USERNAME';}"> <input
					type="password" name="password" value="Password"
					onfocus="if(this.value == 'Password') {this.value = '';}"
					onblur="if (this.value == '') {this.value = 'Password';}">
				<div class="submit">
					<input type="submit" name="submit" value="create">
				</div>
				<p>
					<a href="login.php">Back to login</a>
				</p>
			</form>
		</div>

	</div>

</body>
</html>