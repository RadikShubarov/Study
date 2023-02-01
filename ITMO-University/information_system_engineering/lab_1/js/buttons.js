function changeY(button) {
    document.getElementById('y_field').value = button.value;
    let buttons = document.getElementsByClassName('y-button');
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('btn-selected');
    }
    button.classList.add('btn-selected');
}

function changeX(button) {
    document.getElementById('x_field').value = button.value;
    let buttons = document.getElementsByClassName('r-button');
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('btn-selected');
    }
    button.classList.add('btn-selected');
}

function myFunction1() {
    window.location = "http://lab/lab1.php";
}

function myFunction2() {
    window.location = "http://lab/index.php";
}