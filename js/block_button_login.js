document.getElementById('login').addEventListener('input', function() {
    if (document.getElementById('login').value && document.getElementById('password').value) {
        document.getElementById('btn_login').removeAttribute('disabled');
    } else {
        document.getElementById('btn_login').setAttribute('disabled', 'disabled');
    }
});

document.getElementById('password').addEventListener('input', function() {
    if (document.getElementById('login').value && document.getElementById('password').value) {
        document.getElementById('btn_login').removeAttribute('disabled');
    } else {
        document.getElementById('btn_login').setAttribute('disabled', 'disabled');
    }
});