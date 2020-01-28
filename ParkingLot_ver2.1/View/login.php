<?php
/**
 *  This is the login page of the website, if users have not logged in yet, then all request from other website will be 
 *  redirected to this page, users can also create new account in this page.
 *
 *  @Author: Zijian Xiao
 */
header('Content-type:text/html');
if (isset($_POST['submit'])) {
    //
    if (isset($_POST['id']) && isset($_POST['password'])) {
       

        $a = $_POST['id'];
        $b = $_POST['password'];
        header('Location:skipping.php?id=' . $a . '&password=' . $b . '');
    } else {
        echo 'Sorry, the information is wrong!';
    }
}

?>



<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta charset="utf-8">
<link href="../css/login.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="body">
	<!-----start-main---->
	<div class="main">
		<div class="login-form">
			<h1>Manager Login</h1>
			<div class="head">
				<img src="../images/user.png" alt="" />
			</div>
			<form method="post" action="login.php">
				<input type="text" class="text" name="id" value="USERNAME"
					onfocus="if(this.value == 'USERNAME') {this.value = '';}"
					onblur="if (this.value == '') {this.value = 'USERNAME';}"> <input
					type="password" name="password" value="Password"
					onfocus="if(this.value == 'Password') {this.value = '';}"
					onblur="if (this.value == '') {this.value = 'Password';}">
				<div class="submit">
					<input type="submit" name="submit" value="login">
				</div>
				<p>
					<a href="create.php">Create account</a>
				</p>
			</form>
		</div>

	</div>

</body>
</html>