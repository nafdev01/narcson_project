<?php
if (!isset($_SESSION['employeeId'])) {
	header("location: login.php?next=test.php");
	exit();
} else {
	header("location: test.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
</body>

</html>