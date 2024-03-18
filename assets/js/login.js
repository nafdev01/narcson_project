function signupEmployee(event, form) {
    event.preventDefault(); // Prevent form submission
    var password = document.getElementById('signup-psw').value;
    var confirmPassword = document.getElementById('signup-confirm-psw').value;

    if (password.length < 8) {
        alert('Password must be at least 8 characters long!');
    } else if (password !== confirmPassword) {
        alert('The two passwords do not match!');
    }
    else {
        form.submit();
    }
}

