// В случае, если введен некорректный пароль, выводится alert
var urlParams = new URLSearchParams(window.location.search);
var pass = urlParams.get('password');
if (pass= 'uncorrect') {
    alert ("Вы ввели неправльный пароль. Попробуйте еще раз или войдите с другим логином.");
} 