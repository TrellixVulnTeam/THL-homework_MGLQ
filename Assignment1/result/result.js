window.onload = function insertResult() {
    var sum = 0; //calculate the sum of points.
    var p = new Array(); //record and translate points into grade.
    var ul = document.getElementById("result");
    var l = new Array(); //list grades of each question.
    for (i = 0; i < 10; i++) {
        p[i] = parseInt(localStorage.p.substr(i, 1));
        l[i] = document.createElement("li");
        if (p[i] == 0) {
            l[i].innerHTML = "Question" + (i + 1) + "..........................bad";
        } else if (p[i] == 1) {
            l[i].innerHTML = "Question" + (i + 1) + "..........................good";
        } else if (p[i] == 2) {
            l[i].innerHTML = "Question" + (i + 1) + "..........................perfect";
        }
        ul.appendChild(l[i]);
        sum += p[i];
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