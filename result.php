<?php
require_once "result-functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/result.css">
</head>

<body>
    <div class="header">
        <p>Employee Due Diligence Test Result</p>
        <button class="logout" id="logout-button" onclick="logoutConfirm()">
            <span>Logout&nbsp;</span>
            <i class="fa-solid fa-person-walking-arrow-right"></i>
        </button>
    </div>

    <!-- First Part -->
    <div class="first-part">
        <div class="display-4 text-center mb-4">Here are your results</div>
        <div class="category-text">You have a <?php echo $category; ?> style</div>
        <div class="description-text"><?php echo $description; ?></div>
    </div>

    <!-- Horizontal Line -->
    <hr>

    <!-- Second Part -->
    <div class="second-part">
        <div class="title">Recommendations</div>
        <div class="recommendation-text"><?php echo $recommendation; ?></div>
        <div class="footer">
            <button class="print-button" type="button" data-bs-toggle="modal" data-bs-target="#passwordModal">Print</button>
            <div class="thank-you-text">Thank you for using our service</div>
            <button class="close-button">Close</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal modal-sm fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="./result-pdf.php" class="formName" method="post" id="password-form">
                        <div class="form-group mb-3">
                            <label>Create a user password for your file</label>
                            <input id="user-pass" type="text" name="user-pass" placeholder="User Password" class="user-password form-control" required style="padding: 10px; font-size: 16px; border-radius: 5px;" required />
                        </div>
                        <div class="form-group mb-3">
                            <label>Create an owner password for your file</label>
                            <input type="text" id="owner-pass" name="owner-pass" placeholder="Owner Password" class="owner-password form-control" required style="padding: 10px; font-size: 16px; border-radius: 5px;" required />
                        </div>
                        <div class="hidden-fields">
                            <input type="hidden" name="category" value="<?php echo $category; ?>">
                            <input type="hidden" name="description" value="<?php echo $description; ?>">
                            <input type="hidden" name="recommendation" value="<?php echo $recommendation; ?>">
                        </div>
                        <div class="d-flex justify-content-evenly mb-3">
                            <button type="submit" class="btn btn-primary" id="submit-password">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="assets/js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <script src="assets/js/result.js"></script>

</body>

</html>