<?php

session_start();

if(!isset($_SESSION["email"])){
    header("Location: login.php");
}
elseif ($_SESSION['role']=='user' ) {
    header("Location: user_dashboard.php");
}
elseif($_SESSION['role']=='admin' ){
    header("Location: admin_dashboard.php");
}
elseif($_SESSION['role']=='manager' ){
    header("Location: manager_dashboard.php");
}
