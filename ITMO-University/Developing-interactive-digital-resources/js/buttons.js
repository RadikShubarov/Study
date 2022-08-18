function changeY(button){
    document.getElementById('y_field').value=button.value;
    let buttons = document.getElementsByClassName('y-button');
    for(let i = 0; i < buttons.length; i++) {
      buttons[i].classList.remove('btn-selected');
    }
    button.classList.add('btn-selected');
}

function changeX(button){
    document.getElementById('x_field').value=button.value;
    let buttons = document.getElementsByClassName('r-button');
    for(let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('btn-selected');
    }
    button.classList.add('btn-selected');
}