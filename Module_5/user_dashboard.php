<?php
session_start();

if(!isset($_SESSION["role"]) || $_SESSION["role"] !='user'){ 
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Dashboard</title>
  <link rel = 'stylesheet' href = '/Assignment/Module_5/Style/user_dashboard.css'>
</head>
<body>
  <div id="dashboard">
    <h1>User Dashboard</h1>
    <div id="user-welcome">Welcome <?php echo $_SESSION['firstname']; ?> </div>
    <form action="logout.php" method="post">
      <button id="logout-button" type="submit" name="logout">Logout</button>
    </form>
  </div>
</body>
</html>