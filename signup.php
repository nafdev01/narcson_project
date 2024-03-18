<?php
require_once "signup-functions.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <div class="header"></div>
    <div class="login">
        <div class="form-header">
            <p class="form-title">Sign Up</p>
            <p class="form-info">Please fill in this form to create an account.</p>
        </div>
        <form method="post" action="" onsubmit="signupEmployee(event, this)">
            <label for="employee-name"><b>Employee Name</b></label>
            <input id="employee-name" type="text" placeholder="Enter Employee Name" name="employee-name" required>

            <label for="signup-id-number"><b>ID Number</b></label>
            <input id="signup-id-number" type="text" placeholder="Enter ID Number" name="signup-id-number" required>

            <label for="signup-psw"><b>Password</b></label>
            <input id="signup-psw" type="password" placeholder="Enter Password" name="signup-psw" required>

            <label for="signup-confirm-psw"><b>Confirm Password</b></label>
            <input id="signup-confirm-psw" type="password" placeholder="Confirm Password" name="signup-confirm-psw" required>

            <button type="submit" id="signup-btn">
                <i class="fa-solid fa-user-plus"></i>
                <span>&nbsp;Sign Up</span>
            </button>
        </form>
        <div class="login-option">
            <p>Already have an account? <a href="login.php">Log In</a></p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="assets/js/login.js"></script>

</body>

</html>