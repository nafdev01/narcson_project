var swiper = new Swiper(".mySwiper", {
    keyboard: {
        enabled: true,
    },
    effect: "cards",
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + "</span>";
        },
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },

});


function checkAllAnswered() {
    var allAnswered = true;
    var questions = document.querySelectorAll('.question-box');
    questions.forEach(function (question) {
        var options = question.querySelectorAll('.option-input');
        var answered = Array.from(options).some(radio => radio.checked);
        if (!answered) {
            allAnswered = false;
        }
    });
    return allAnswered;
}

function setAble() {
    if (checkAllAnswered()) {
        var submitBtn = document.querySelector(".submit-btn");
        submitBtn.innerHTML = "Submit";
        submitBtn.disabled = false;
    }
}

function logoutConfirm() {
    $.confirm({
        icon: 'fa fa-warning',
        useBootstrap: false,
        title: 'Confirm!',
        content: 'Are you sure you want to log out?',
        buttons: {
            confirm: {
                text: 'Log Out!',
                btnClass: 'btn-red',
                keys: ['enter'],
                action: function () {
                    window.location.href = 'logout.php';
                },
            },
            cancel: {
                text: 'Cancel',
                keys: ['esc'],
                action: function () {
                    "...";
                },
            },
        }
    });
}
