document.getElementById('description').addEventListener('input', function() {
    if (document.getElementById('description').value) {
        document.getElementById('btn_new_task').removeAttribute('disabled');
    } else {
        document.getElementById('btn_new_task').setAttribute('disabled', 'disabled');
    }
});



