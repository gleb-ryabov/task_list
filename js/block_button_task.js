document.getElementById('description').addEventListener('input', function() {
    var descriptionValue = document.getElementById('description').value;
    var newTaskButton = document.getElementById('btn_new_task');

    if (descriptionValue) {
        newTaskButton.removeAttribute('disabled');
        newTaskButton.style.cursor = 'pointer';
    } else {
        newTaskButton.setAttribute('disabled', 'disabled');
        newTaskButton.style.cursor = 'not-allowed';
    }
});



