<?php
session_start();
$employeeId = $_SESSION['employeeId'];

if (!isset($employeeId)) {
    header("location: login.php?error=notloggedin?next=test.php");
    exit();
}

require_once "db-conn.php";

$sql = "SELECT * FROM employee_responses WHERE employee = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $employeeId);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        header("location: result.php?error=alreadyanswered");
        exit();
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    exit();
}


$sql = "SELECT * FROM questions";
$questions = $conn->query($sql);

$questionsWithOptions = array();

$alreadyfilled = false;

if ($questions->num_rows > 0) {
    while ($question = $questions->fetch_assoc()) {
        $sql = "SELECT id, choice_letter, option_text FROM question_options WHERE question = " . $question["id"];
        $options = $conn->query($sql);

        $optionsArray = array();
        if ($options->num_rows > 0) {
            while ($option = $options->fetch_assoc()) {
                $optionsArray[] = $option;
            }
        }

        $questionsWithOptions[] = array(
            "question_id" => $question["id"],
            "question_text" => $question["question_text"],
            "options" => $optionsArray
        );
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a session or a way to get the current logged in employee's id

    foreach ($questionsWithOptions as $question) {
        if (isset($_POST[$question['question_id']])) {
            $option_id = $_POST[$question['question_id']];
            $question_id = $question['question_id'];

            // Get the option letter from the selected option
            $option_letter = '';
            foreach ($question["options"] as $option) {
                if ($option['id'] == $option_id) {
                    $option_letter = $option['choice_letter'];
                    break;
                }
            }
            // 

            try {
                $sql = "INSERT INTO employee_responses (employee, question, option, option_letter) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("siis", $employeeId, $question_id, $option_id, $option_letter);

                if (!$stmt->execute() === TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    exit();
                }
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) {
                    $alreadyfilled = TRUE;
                    continue;
                } else {
                    // Handle other errors
                    echo "An error occurred: " . $e->getMessage();
                    exit();
                }
            }
        }
    }
    if ($alreadyfilled) {
        header("location: test.php?error=alreadyfilled");
        exit();
    } else {
        header("location: test.php?success=successfulsubmission");
        exit();
    }
}

$conn->close();
