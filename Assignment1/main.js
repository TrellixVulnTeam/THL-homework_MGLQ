function showResource(e) {
    var x, y;
    x = e.clientX;
    y = e.clientY;
    document.getElementById("layer").style.left = x + 10 + 'px';
    document.getElementById("layer").style.top = y + 10 + 'px';
    document.getElementById("layer").innerHTML = "http://grafotronic.se/wp-content/uploads/photo-gallery/AM_2016/_DSC3026.jpg";
    document.getElementById("layer").style.display = "";
}

function hideResource() {
    document.getElementById("layer").innerHTML = "";
    document.getElementById("layer").style.display = "none";
}

function closeWindow() {
    if (confirm("Are you sure to leave?")) {
        window.opener = null;
        window.open('', '_self');
        window.close();
    } else {}
}

function openWindow() {
    window.location.href = "./questionnaire/questionnaire.html";
}