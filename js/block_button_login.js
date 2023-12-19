function toggleButtonState() {
    var loginValue = document.getElementById('login').value;
    var passwordValue = document.getElementById('password').value;
    var loginButton = document.getElementById('btn_login');

    if (loginValue && passwordValue) {
        loginButton.removeAttribute('disabled');
        loginButton.style.cursor = 'pointer'; // Изменение стиля курсора на pointer, когда кнопка активна
    } else {
        loginButton.setAttribute('disabled', 'disabled');
        loginButton.style.cursor = 'not-allowed'; // Изменение стиля курсора на not-allowed, когда кнопка отключена
    }
}

document.getElementById('login').addEventListener('input', toggleButtonState);
document.getElementById('password').addEventListener('input', toggleButtonState);
