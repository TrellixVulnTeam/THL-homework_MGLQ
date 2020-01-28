<?php

/**
 *  This is the logout page of the website, this page is just a transmit page which will not be displayed when using the website. Only if
 *  users click the logout button in the main page will it be called.
 *
 *  @Author: Zijian Xiao
 */
header('Content-type:text/html');
session_start();
var_dump($_SESSION['id']);
if (isset($_SESSION['id'])) {

    session_unset();
    session_destroy();
    setcookie(session_name, '', time() - 3600, '/');
    echo 'logout';
    header('Location:login.php?info=successful logout');
} 
else {
    echo 'e';
}

?>