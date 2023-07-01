$(document).ready(function () {

    // List Tasks
    var userId = $('.tasksList').data('user')

    $.ajax({
        url: 'tasks_list.php',
        method: 'GET',
        data: { user_id: userId },
        dataType: 'json',

        success: function (tasks) {

            var tasksList = $('.tasksList')

            var doneTasks = $('.doneTasks')

            tasks.forEach(function(task) {

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

                if (task.status == 'done') {
                    doneTasks.append(taskElement)
                } else {
                    tasksList.prepend(taskElement)
                }

                doneTasks.find('#quantity').text(`(${doneTasks.children().length - 1})`)
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
    $(".showTasks").on("click", ".deleteTask", function () {

        var doneTasks = $('.doneTasks')
        var taskElement = $(this).closest(".task")

        var taskId = taskElement.data("task")

        taskElement.remove()

        doneTasks.find('#quantity').text(`(${doneTasks.children().length - 1})`)

        $.ajax({
            url: "task_delete.php",
            method: "POST",
            data: { task_id: taskId },
        })

    })

    // Check Task
    $(".showTasks").on("click", ".markTask", function () {

        var tasksList = $('.tasksList')
        var doneTasks = $('.doneTasks')
        var taskElement = $(this).closest('.task')

        var taskId = taskElement.data('task')
        var status = taskElement.hasClass('pending') ? 'done' : 'pending'

        taskElement.removeClass('pending done').toggleClass(status)

        if (status === 'done') {
            $(this).closest('.markTask').text('✓')
            taskElement.appendTo(doneTasks)
        } else {
            $(this).closest('.markTask').text('')
            taskElement.appendTo(tasksList)
        }

        doneTasks.find('#quantity').text(`(${doneTasks.children().length - 1})`)

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
    $(".showTasks").on("click", ".updateTask", function () {

        var taskElement = $(this).closest('.task')
        var title = taskElement.find('h3').text()
        var description = taskElement.find('p').text()

        taskElement.find('.markTask').remove()
        taskElement.find('h3').html('<input type="text" class="titleInput" value="' + title + '">')
        taskElement.find('p').html('<textarea class="descriptionInput" placeholder="Opcional">' + description + '</textarea>')
        taskElement.find('.updateTask').replaceWith('<button class="saveUpdate">Salvar</button>');

        taskElement.on("click", ".saveUpdate", function () {

            var updatedTitle = taskElement.find('.titleInput').val()
            var updatedDesc = taskElement.find('.descriptionInput').val()

            if (updatedTitle) {

                taskElement.find('.titleInput').replaceWith('<h3>' + updatedTitle + '</h3>')
                taskElement.find('.descriptionInput').replaceWith('<p>' + updatedDesc + '</p>')

                taskElement.find('.saveUpdate').replaceWith('<span class="updateTask">✎</span>')

                $.post('task_update.php', { task_id: taskElement.data('task'), title: updatedTitle, description: updatedDesc }, function (response) {

                    if (response.status === 'success') {
                        window.location.href = 'tasks.php'
                    }
        
                }, 'json')

            }

        })

    })

})