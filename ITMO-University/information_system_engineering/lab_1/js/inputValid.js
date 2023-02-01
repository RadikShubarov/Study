let form = document.querySelector('.forms');
let inp = document.querySelector('.field');





$('.forms').on('submit', function(event) {
    //event.preventDefault();
    if (validate()) {


        return true
    } else {
        $('.field').addClass("is-invalid")
    }

    return false

})


function validate() {

    if ((inp.value <= 5) && (inp.value >= -5)) {
        return true
    }

    return false
}