function uploadPhoto(event) {
    event.preventDefault();

    var form = document.getElementById('upload_form');
    var formData = new FormData(form);

    var request = new XMLHttpRequest();
    request.open('POST', 'usercab2.php', true);

    request.onload = function () {
        if (request.status === 200) {
            alert('Фото успешно загружено');
            location.reload();
        } else {
            alert('Произошла ошибка при загрузке фото');
        }
    };

    request.send(formData);
}

function getUserData() {
    var request = new XMLHttpRequest();
    request.open('GET', 'usercab2.php', true);

    request.onload = function () {
        if (request.status === 200) {
            var data = request.responseText;

            var placeholder = document.getElementById('data_placeholder');
            placeholder.innerHTML = data;
        } else {
            alert('Произошла ошибка при получении данных о пользователях');
        }
    };

    request.send();
}

var uploadForm = document.getElementById('upload_form');
uploadForm.addEventListener('submit', uploadPhoto);

window.onload = function () {
    getUserData();
};

