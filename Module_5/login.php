<?php
session_start();

if (isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $users = json_decode(file_get_contents('users.json'), true);

    if (isset($users[$email]) && $users[$email]['password'] === $password) {

        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $users[$email]['firstname'];
        $_SESSION['lastname'] = $users[$email]['lastname'];
        $_SESSION['role'] = $users[$email]['role'];


        if (isset($_POST['remember_me'])) {

            $rememberEmail = base64_encode($email);
            setcookie('remember_email', $rememberEmail, time() + 10, '/');
        }

        header("Location: index.php");
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}


if (isset($_COOKIE['remember_email'])) {
    $rememberedEmail = base64_decode($_COOKIE['remember_email']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Assignment/Module_5/Style/login.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <h2 class="text-center mb-4">Login</h2>
                    <form action="login.php" method="POST">
                        <span class="error" style="color: #FF0001;">
                            <?php if (isset($error_message)) {
                                echo $error_message;
                            } ?>
                        </span>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email"
                                value="<?php echo isset($rememberedEmail) ? $rememberedEmail : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="remember_me">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>

                    <p class="text-center mt-3">Don't have an account? <a href="sign_up.php">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>