$(document).ready(function () {
    // Store User
    $('#registerForm').submit(function (event) {
        event.preventDefault()
        const url = '/controllers/user/user_store.php'
        const email = $('#email').val()
        const password = $('#password').val()
        $.post(url, { email: email, password: password }, function (response) {
            response.status === 'success' ?
                window.location.href = '/resources/views/guest/login.php' :
                $('#message').text(response.message)
        }, 'json')
    })
    // Login User
    $('#loginForm').submit(function (event) {
        event.preventDefault()
        const url = '/controllers/user/user_login.php'
        const email = $('#email').val()
        const password = $('#password').val()
        $.post(url, { email: email, password: password }, function (response) {
            response.status === 'success' ?
                window.location.href = '/resources/views/app/tasks.php' :
                $('#message').text(response.message)
        }, 'json')
    })
})