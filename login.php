<?php
require_once "login-functions.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <div class="header"></div>
    <div class="login">
        <div class="form-header">
            <p class="form-title">Log in</p>
            <p class="form-info">Please fill in this form to sign in.</p>
        </div>
        <form method="post" action="login.php">
            <label for="login-id-number"><b>ID Number</b></label>
            <input id="login-id-number" type="text" placeholder="Enter ID NUmber" name="login-id-number" required>
            <label for="login-psw"><b>Password</b></label>
            <input id="login-psw" type="password" placeholder="Enter Password" name="login-psw" required>
            <input type="hidden" value="<?php echo $nextPage ?>" name="next-page">
            <button type="submit" id="login-btn">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>&nbsp;Login</span>
            </button>
        </form>
        <div class="signup-option">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="assets/js/login.js"></script>

</body>

</html>