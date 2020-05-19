// Declare details button function
var details = document.querySelector('.second-screen');

function showDetails() {
    details.scrollIntoView({
        behavior: 'smooth',
        block:'start'
    })
}