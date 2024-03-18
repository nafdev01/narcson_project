<?php
require_once "test-functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Take Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <link rel="stylesheet" href="assets/css/test.css">
</head>

<body>
    <div class="header">
        <p>Employee Due Diligence Test</p>
        <button class="logout" id="logout-button" onclick="logoutConfirm()">
            <span>Logout&nbsp;</span>
            <i class="fa-solid fa-person-walking-arrow-right"></i>
        </button>
    </div>

    <form class="swiper mySwiper" action="" method="post">
        <!-- Swiper -->
        <div class="swiper-wrapper">
            <?php if (!empty($questionsWithOptions)) : ?>
                <?php foreach ($questionsWithOptions as $question) : ?>
                    <div class="swiper-slide">
                        <div class="question-box">
                            <p class="question-text"><?php echo "{$question['question_id']}. {$question['question_text']}"; ?></p>
                            <div class="option-box">
                                <?php foreach ($question["options"] as $key => $option) : ?>
                                    <div class="radio-group">
                                        <input type="radio" class="option-input" id="<?php echo $option['id']; ?>" name="<?php echo $question['question_id']; ?>" onclick="setAble()" value="<?php echo $option['id']; ?>">
                                        <label class="option-label" for="<?php echo $option['id']; ?>"><?php echo "{$option['choice_letter']}. {$option['option_text']}"; ?></label><br>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="swiper-slide">No questions added yet.</div>
            <?php endif; ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>

        <div class="submit-button-box">
            <button type="submit" class="submit-btn" disabled>
                <div class="tooltip">Submit
                    <span class="tooltiptext">
                        Answer all the <?php echo count($questionsWithOptions); ?> questions first
                    </span>
                </div>
            </button>
        </div>

    </form>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="assets/js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <script src="assets/js/test.js"></script>

</body>

</html>