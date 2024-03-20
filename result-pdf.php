<?php

require_once('TCPDF/tcpdf.php');
require_once 'db-conn.php';


// Start the session
function slugify($string)
{
    // Replace spaces with dashes
    $slug = str_replace(' ', '-', $string);

    // Convert to lowercase
    $slug = strtolower($slug);

    // Remove special characters
    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

    return $slug;
}

session_start();
$employeeId = $_SESSION['employeeId'];

if (!isset($employeeId)) {
    header("location: login.php?next=result.php");
    exit();
} else {
    // get the users name from the database
    // Create the SQL query to fetch the user's name from the database
    $sql = "SELECT employee_name FROM employees WHERE id_number = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("s", $employeeId);

    // Execute the statement
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($employeeName);

    // Fetch the result
    $stmt->fetch();

    // Close the statement
    $stmt->close();

    // Check if the employee name is retrieved successfully
    if (empty($employeeName)) {
        // If the user's name is not found, display an error message
        echo "Error: User not found.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get the file-password from the form
    $user_password = $_POST['user-pass'];
    $owner_password = $_POST['owner-pass'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $recommendation = $_POST['recommendation'];

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

    // 
class RESULTPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $image_file = K_PATH_IMAGES . 'logo_example.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'Employee Due Diligence Results', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new RESULTPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator("Narcson Mutua");
$pdf->SetAuthor('Narcson Mutua');
$pdf->SetTitle('Employee Due Diligence Test Result');
$pdf->SetSubject('Test Result');
$pdf->SetKeywords('TCPDF, PDF, test, result');


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// add a page
$pdf->AddPage();

// set font
$pdf->SetFont('helvetica', '', 12);

$pdf->writeHTML('<p style="text-align:center; font-style:italic; font-size:23">You have a ' . $category . ' style</p><br>', true, false, true, false, '');
$pdf->writeHTML('<h2 style="text-align:center;">Description</h2><p>' . $description . '</p>', true, false, true, false, '');
$pdf->writeHTML('<h2 style="text-align:center">Recommendation</h2><p>' . $recommendation . '</p>', true, false, true, false, '');

// write code for a place where someone can sign and a data on the same line and make it be at the bottom of the last page
$pdf->writeHTML('<p style="text-align:center; position: absolute; bottom: 0; left: 0; right: 0; margin-bottom: 20px; margin-top: 100px; padding-bottom: 0; padding-top: 100px;">   Signature  ________________________________________    <span style="margin-left: 50px;">' . '<span>   Date:</span>'. date('Y-m-d') . '</span></p>', true, false, true, false, '');

$permissions = array('print', 'modify', 'copy', 'annot-forms');

$pdf->SetProtection($permissions, $user_password, $owner_password);

//  download pdf with custom name
$pdf->Output($slug = slugify($employeeName) . "_test_results.pdf", 'D');
}
else {
    header("location: result.php?error=unauthorized-access");
    exit();
}