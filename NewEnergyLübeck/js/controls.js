// First screen content reveal animate
ScrollReveal().reveal('#home_content', {
    delay: 100,
    duration: 2500,
    distance: '500px'
});
ScrollReveal().reveal('#intro_content', {
    delay: 100,
    duration: 2500,
    distance: '500px'
});
// Declare details button function
var details = document.querySelector('.second-screen');
var back = document.querySelector('.first-screen');

function showDetails() {
    details.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    })
}
//Declare back to top button function
function backTop() {
    back.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    })
}
//Declare signal button function
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://weatherbit-v1-mashape.p.rapidapi.com/current?lang=en&lon=10.69&lat=53.87",
    "method": "GET",
    "headers": {
        "x-rapidapi-host": "weatherbit-v1-mashape.p.rapidapi.com",
        "x-rapidapi-key": "7d66317eadmshc37b41f504ff1c7p1f42d9jsneee75038948b"
    }
}

function showSignal() {
    alert('please wait');
    $.ajax(settings).done(function (response) {
        var cur_ene;
        cur_ene = calSolar(response.data.solar_rad) + calWind(response.data.wind_spd);
        if (cur_ene >= 0 && cur_ene < 0.9 * calSolar(375) + 0.1 * calWind(2.78)) {
            document.getElementById('home_content').style.backgroundColor = "#a52a2a";
        } else if (cur_ene >= 0.9 * calSolar(375) + 0.1 * calWind(2.78) && cur_ene < 0.9 * calSolar(625) + 0.1 * calWind(5.23)) {
            document.getElementById('home_content').style.backgroundColor = "#ffd700";
        } else {
            document.getElementById('home_content').style.backgroundColor = "#2e8b57";
        }
    })
}