var g = new Array();

g[0] = parseInt(localStorage.p1);
g[1] = parseInt(localStorage.p2);
g[2] = parseInt(localStorage.p3);
g[3] = parseInt(localStorage.p4);
g[4] = parseInt(localStorage.p5);
g[5] = parseInt(localStorage.p6);
g[6] = parseInt(localStorage.p7);
g[7] = parseInt(localStorage.p8);
g[8] = parseInt(localStorage.p9);
g[9] = parseInt(localStorage.p10);

window.onload = function insertResult() {
    var sum = 0;
    var j = new Array();
    var l = new Array();
    var ul = document.getElementById("result");
    for (i = 0; i < g.length; i++) {
        if (g[i] == 0) {
            j[i] = "bad";
        } else if (g[i] == 1) {
            j[i] = "good";
        } else if (g[i] == 2) {
            j[i] = "perfect";
        }
        l[i] = document.createElement("li");
        if (i < 9) {
            l[i].innerHTML = "Question" + (i + 1) + ".........................." + j[i];
        } else {
            l[i].innerHTML = "Question" + (i + 1) + "........................." + j[i];
        }
        ul.appendChild(l[i]);
        sum += g[i];
    }
    var div = document.getElementById("result-sum");
    var score = document.createElement("p");
    score.style = "font-family:monospace;font-size:30px;";
    if (sum <= 6) {
        score.innerHTML = "Maybe you just didn't take it seriously.";
    } else if (sum <= 15) {
        score.innerHTML = "Average level.<br>Mind small stuffs and you will do better in the future.";
    } else {
        score.innerHTML = "High EQ crew.<br>High level of empathy.<br>You know what other people are thinking.";
    }
    div.appendChild(score);
}