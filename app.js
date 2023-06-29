$(document).ready(function () {

    // Login
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

    // Store Task
    $('#taskInsertForm').submit(function (event) {

        event.preventDefault()

        const user_id = $('#user_id').val()
        const title = $('#title').val()
        const description = $('#description').val()

        $.post('task_store.php', { user_id: user_id, title: title, description: description }, function (response) {

            if (response.status === 'success') {
                window.location.href = 'tasks.php'
            }

        }, 'json')

    })

    // List Tasks
    $(document).ready(function () {

        var userId = $('.tasksList').data('user')

        $.ajax({
            url: 'tasks_list.php',
            method: 'GET',
            data: { user_id: userId },
            dataType: 'json',

            success: function (tasks) {

                tasks.forEach(function (task) {

                    var taskDiv = $('<div class="task"></div>').attr('data-task', task.id)

                    if (task.status === 'pending') {
                        taskDiv.addClass('pending')
                    } else if (task.status === 'done') {
                        taskDiv.addClass('done')
                    }

                    var checkElement = $('<div class="markTask">O</div>')
                    var titleElement = $('<h3></h3>').text(task.title)
                    var descriptionElement = $('<p></p>').text(task.description)
                    var deleteElement = $('<span class="deleteTask">X</span>')

                    taskDiv.append(checkElement)
                    taskDiv.append(titleElement)
                    taskDiv.append(descriptionElement)
                    taskDiv.append(deleteElement)

                    $('.tasksList').append(taskDiv)

                })

            }

        })

    })

    // Delete Task
    $(".tasksList").on("click", ".deleteTask", function() {

        var taskDiv = $(this).closest(".task")
        var taskId = taskDiv.data("task")

        taskDiv.remove()

        $.ajax({
            url: "task_delete.php",
            method: "POST",
            data: { task_id: taskId },
        })

    })

    // Check Task
    $(".tasksList").on("click", ".markTask", function() {

        var taskElement = $(this).closest('.task')
        var taskId = taskElement.data('task')
        var status = taskElement.hasClass('pending') ? 'done' : 'pending'

        $.ajax({
            url: 'task_check.php',
            method: 'POST',
            data: {
                taskId: taskId,
                status: status
            },

            success: function (response) {
                taskElement.removeClass('pending done').addClass(response.status)
            },

        })

    })

})