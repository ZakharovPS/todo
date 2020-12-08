$('#authButton').click(function () {
    let login = $('#login').val().trim();
    let pass = $('#pass').val().trim();
    if (login == "") {
        $('#error').text("Введите логин");
    } else if (pass == "") {
        $('#error').text("Введите пароль");
    } else {
        $.ajax({
            url: "php/auth.php",
            type: "POST",
            data: ({ login: login, pass: pass }),
            dataType: "html",
            success: function (data) {
                if (data == false) {
                    $('#error').text("Неверный логин или пароль");
                }
                else {
                    document.location.href = "index.php"
                }
            }
        });
    }
})