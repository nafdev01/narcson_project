<?php
session_start();

if (isset($_SESSION['employeeId'])) {
    header("location: test.php?error=alreadyloggedin");
    exit();
}

$nextPage = isset($_GET['next']) ? $_GET['next'] : 'test.php';

// check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get the user inputs
    $idNumber = $_POST["login-id-number"];
    $password = $_POST["login-psw"];
    $nextPageInput = $_POST["next-page"];

    require_once "db-conn.php";

    // query the database to retrieve the user information
    $query = "SELECT * FROM employees WHERE id_number='$idNumber'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row["password"];

        if (password_verify($password, $hashed_password)) {
            // if password is correct, log the user in
            $_SESSION['employeeId'] = $row["id_number"];
            header("location: $nextPageInput?success=successfullogin");
            exit();
        } else {
            // if password is incorrect, display an error message
            header("location: login.php?error=invalidcredentials");
            exit();
        }
    } else {
        // if user does not exist, display an error message
        header("location: login.php?error=invalidcredentials");
        exit();
    }

    // close the database connection
    mysqli_close($conn);
}
