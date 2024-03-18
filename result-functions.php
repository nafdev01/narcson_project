<?php
require_once "descriptions.php";
require_once "recommendations.php";

session_start();
$employeeId = $_SESSION['employeeId'];

if (!isset($employeeId)) {
    header("location: login.php?next=result.php");
    exit();
}

// Include your database configuration file
require_once 'db-conn.php';

// Create the SQL query
$sql = "SELECT er.question AS question_id, q.question_text, er.option AS option_id, er.option_letter, o.option_text
        FROM employee_responses er
        JOIN questions q ON er.question = q.id
        JOIN question_options o ON er.option = o.id
        WHERE er.employee = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param("s", $employeeId);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there are any results
if ($result->num_rows > 0) {
    // Create an array to store the results
    $responses = array();

    // Fetch the results into the array
    while ($row = $result->fetch_assoc()) {
        $responses[] = $row;
    }

    // Count the number of each option selected
    $optionCounts = array('A' => 0, 'B' => 0, 'C' => 0, 'D' => 0);

    foreach ($responses as $response) {
        $optionCounts[$response['option_letter']]++;
    }

    // Sort the options by count in descending order
    arsort($optionCounts);

    // Get the option with the highest count
    $highestOption = key($optionCounts);
    $highestCount = current($optionCounts);

    // Check if there are multiple options with the highest count
    $multipleHighest = false;
    foreach ($optionCounts as $count) {
        if ($count == $highestCount) {
            if ($multipleHighest) {
                $highestOption = 'D';
                break;
            }
            $multipleHighest = true;
        }
    }

    // Categorize the user
    $category = '';
    switch ($highestOption) {
        case 'A':
            $category = 'Anxious insecure Attachment';
            break;
        case 'B':
            $category = 'Secure attachment';
            break;
        case 'C':
            $category = 'Avoidant insecure attachment';
            break;
        case 'D':
            $category = 'Disorganized insecure attachment';
            break;
    }

    $description = '';
    switch ($category) {
        case 'Anxious insecure Attachment':
            $description = $anxiousDescription;
                        break;
        case 'Secure attachment':
            $description = $secureDescription;
            break;
        case 'Avoidant insecure attachment':
            $description = $avoidantDescription;
            break;
        case 'Disorganized insecure attachment':
            $description = $disorganizedDescription;
            break;
    };

    $recommendation = '';
    switch ($category) {
        case 'Anxious insecure Attachment':
            $recommendation = $anxiousRecommendation;
            break;
        case 'Secure attachment':
            $recommendation = $secureRecommendation;
            break;
        case 'Avoidant insecure attachment':
            $recommendation = $avoidantRecommendation;
            break;
        case 'Disorganized insecure attachment':
            $recommendation = $disorganizedRecommendation;
            break;
    };
} else {
    echo "No results found.";
}
