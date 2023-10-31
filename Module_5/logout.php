<?php
session_start(); 

session_unset();
if (isset($_POST['logout'])) {

    setcookie('admin_name', '', time() - 3600, '/');
    header("Location: login.php");
    exit();
}
if (isset($_POST['logout_manager'])) {

    setcookie('manager_name', '', time() - 3600, '/');
    header("Location: login.php");
    exit();
}

header("Location: login.php");
exit();
