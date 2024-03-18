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

