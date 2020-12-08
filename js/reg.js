$('#regButton').click(function () {
    let login = $('#login').val().trim();
    let pass = $('#pass').val().trim();
    let repeatPass = $('#repeatPass').val().trim();
    if (login == "") {
        $('#error').text("Введите логин");
    } else if (pass == "") {
        $('#error').text("Введите пароль");
    } else if (pass != repeatPass) {
        $('#error').text("Введенные пароли не совпадают");
    } else {
        $.ajax({
            url: "php/check-login.php",
            type: "POST",
            data: ({ login: login }),
            dataType: "html",
            success: function (data) {
                if (data == false) {
                    $('#error').text("Такой логин уже занят");
                } else reg(login, pass);
            }
        });
    }
})

function reg(login, pass) {
    $.ajax({
        url: "php/reg.php",
        type: "POST",
        data: ({ login: login, pass: pass }),
        dataType: "html",
        success: function () {
            $('#error').text("");
            $('#success').text("Регистрация прошла успешно");
        }
    });
}
