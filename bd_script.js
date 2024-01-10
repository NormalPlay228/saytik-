function getUserInfo() {
    // AJAX запрос для получения информации о пользователе
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "update_session.php", true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Вывод информации о пользователе
                document.getElementById("user-info").innerHTML = xhr.responseText;
            } else {
                console.log("Произошла ошибка при получении информации о пользователе.");
            }
        }
    };

    xhr.send();
}
