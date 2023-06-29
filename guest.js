$(document).ready(function () {

    // Login User
    $('#loginForm').submit(function (event) {

        event.preventDefault()

        const email = $('#email').val()
        const password = $('#password').val()

        $.post('login.php', { email: email, password: password }, function (response) {

            response.status === 'success' ?
                window.location.href = 'tasks.php' :
                $('#message').text(response.message)

        }, 'json')

    })

    // Store User
    $('#registerForm').submit(function (event) {

        event.preventDefault()

        const email = $('#email').val()
        const password = $('#password').val()

        $.post('register.php', { email: email, password: password }, function (response) {

            response.status === 'success' ?
                window.location.href = 'index.php' :
                $('#message').text(response.message)

        }, 'json')

    })

})