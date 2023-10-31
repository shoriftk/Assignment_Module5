<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['email'])) {
    $editEmail = base64_decode($_GET['email']);

    $users = json_decode(file_get_contents('users.json'), true);

    if (isset($users[$editEmail])) {
        $user = $users[$editEmail];
    } else {
        header("Location: admin_dashboard.php");
        exit();
    }
} else {
    header("Location: admin_dashboard.php");
    exit();
}

if (isset($_POST['update'])) {

    $editFirstName = $_POST['firstname'];
    $editLastName = $_POST['lastname'];
    $editRole = $_POST['role'];

    $users[$editEmail]['firstname'] = $editFirstName;
    $users[$editEmail]['lastname'] = $editLastName;
    $users[$editEmail]['role'] = $editRole;


    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

    header("Location: admin_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit User</h2>
        <form method="post">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" class="form-control" id="role">
                    <option value="admin" <?php if ($user['role'] == 'admin') { echo'selected'; }?>>Admin</option>
                    <option value="manager" <?php if ($user['role'] =='manager') { echo'selected'; }?>>Manager</option>
                    <option value="user" <?php if ($user['role'] == 'user') { echo'selected'; }?>>User</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>