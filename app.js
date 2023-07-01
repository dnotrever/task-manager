$(document).ready(function () {

    // List Tasks
    var userId = $('.tasksList').data('user')

    $.ajax({
        url: 'tasks_list.php',
        method: 'GET',
        data: { user_id: userId },
        dataType: 'json',

        success: function (tasks) {

            tasks.forEach(function (task) {

                var taskElement = $('<div class="task"></div>').attr('data-task', task.id)

                var taskInfos = $('<div class="taskInfos"></div>')

                task.status === 'pending' ?
                    taskElement.addClass('pending') :
                    taskElement.addClass('done')

                var checkElement = $('<div class="markTask"></div>')
                var titleElement = $('<h3></h3>').text(task.title)
                var descriptionElement = $('<p></p>').text(task.description)
                var updateElement = $('<span class="updateTask">✎</span>')
                var deleteElement = $('<span class="deleteTask">✖</span>')

                taskElement.hasClass('done') ?
                    checkElement.text('✓') :
                    checkElement.text('')

                taskInfos.append(titleElement)
                taskInfos.append(descriptionElement)
 
                taskElement.append(checkElement)
                taskElement.append(taskInfos)
                taskElement.append(updateElement)
                taskElement.append(deleteElement)

                $('.tasksList').append(taskElement)

            })

        }

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

    // Delete Task
    $(".tasksList").on("click", ".deleteTask", function () {

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
    $(".tasksList").on("click", ".markTask", function () {

        var taskElement = $(this).closest('.task')
        var taskId = taskElement.data('task')
        var status = taskElement.hasClass('pending') ? 'done' : 'pending'

        taskElement.removeClass('pending done').toggleClass(status)

        status === 'done' ? $(this).closest('.markTask').text('✓') : $(this).closest('.markTask').text('')

        $.ajax({
            url: 'task_check.php',
            method: 'POST',
            data: {
                taskId: taskId,
                status: status
            },

        })

    })

    // Update Task
    $(".tasksList").on("click", ".updateTask", function () {

        var taskElement = $(this).closest('.task')
        var title = taskElement.find('h3').text()
        var description = taskElement.find('p').text()

        taskElement.find('.markTask').remove()
        taskElement.find('h3').html('<input type="text" class="titleInput" value="' + title + '">')
        taskElement.find('p').html('<textarea class="descriptionInput">' + description + '</textarea>')
        taskElement.find('.updateTask').replaceWith('<button class="saveUpdate">Salvar</button>');

        taskElement.on("click", ".saveUpdate", function () {

            var updatedTitle = taskElement.find('.titleInput').val()
            var updatedDesc = taskElement.find('.descriptionInput').val()

            taskElement.find('.titleInput').replaceWith('<h3>' + updatedTitle + '</h3>')
            taskElement.find('.descriptionInput').replaceWith('<p>' + updatedDesc + '</p>')

            taskElement.find('.saveUpdate').replaceWith('<span class="updateTask">✎</span>')

            $.post('task_update.php', { task_id: taskElement.data('task'), title: updatedTitle, description: updatedDesc }, function (response) {

                if (response.status === 'success') {
                    window.location.href = 'tasks.php'
                }
    
            }, 'json')

        })

    })

})