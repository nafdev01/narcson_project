<?php
session_start();

if (isset($_SESSION['employeeId'])) {
    header("location: test.php?error=alreadyloggedin");
    exit();
}
// check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get the user inputs
    $employeeName = $_POST["employee-name"];
    $idNumber = $_POST["signup-id-number"];
    $password = $_POST["signup-psw"];

    require_once "db-conn.php";

    // hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // check if the user already exists in the database
    $query = "SELECT * FROM employees WHERE id_number='$idNumber'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        // if user already exists, display an error message
        header("location: index.php?error=userexists");
        exit();
    } else {
        // if user does not exist, insert user information into the database
        $query = "INSERT INTO employees (id_number, employee_name, password) VALUES ('$idNumber', '$employeeName', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            header("location: index.php?success=employeecreated");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }

    // close the database connection
    mysqli_close($conn);
}