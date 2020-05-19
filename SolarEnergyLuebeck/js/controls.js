// Declare details button function
var details = document.querySelector('.second-screen');
var back = document.querySelector('.first-screen');

function showDetails() {
    details.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    })
}

function backTop() {
    back.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    })
}