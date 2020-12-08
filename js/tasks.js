$('#addButton').click(function () {
    let name = $('#name').val().trim();
    let description = $('#description').val().trim();
    if (name == "") {
        $('#error').text("Введите название задачи");
    } else if (description == "") {
        $('#error').text("Введите описание задачи");
    }
})

$('.deleteButton').click(function (event) {
    event.preventDefault();
    let task = $(this).parent().parent().parent();
    let id = task.data('id');
    $.ajax({
        url: "php/delete.php",
        type: "POST",
        data: ({ id: id }),
        dataType: "html",
        success: function (data) {
            task.remove();
        }
    });
})

$('.statusButton').click(function (event) {
    event.preventDefault();
    let button = $(this);
    let id = button.parent().parent().data('id');
    let status;
    if (button.text() == 'Выполнена')
        status = 0;
    else
        status = 1;
    $.ajax({
        url: "php/change-status.php",
        type: "POST",
        data: ({ id: id, status: status }),
        dataType: "html",
        success: function (data) {
            if (status) {
                button.text('Выполнена');
                button.removeClass("btn-danger");
                button.addClass("btn-success");
            }
            else {
                button.text('Не выполнена');
                button.removeClass("btn-success");
                button.addClass("btn-danger");
            }
        }
    });
})