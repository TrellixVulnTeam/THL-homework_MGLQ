var point = null; //record values of each choice.
var result = new Array(); //record all the point.
var flag = 0; //determine which page to show or hide.

function getValue(p) {
    point = parseInt(p.value);
} //pass values when users' clicking.

function clearRadioStatus(Name) {
    for (i = 0; i < 3; i++) {
        document.getElementsByName(Name)[i].checked = false;
    }
}

function goBack() {
    if (flag == 0) {
        history.back(-1);
    } else if (flag < 10) {
        result.pop();
        clearRadioStatus("choice" + (flag + 1));
        document.getElementById("q" + (flag + 1)).style.visibility = 'hidden';
        document.getElementById("q" + flag).style.visibility = 'visible';
        flag--;
    } else {
        result = [];
        document.getElementById("q11").style.visibility = "hidden";
        document.getElementById("q1").style.visibility = "visible";
        flag = 0;
    }
}

function goNext() {
    if (point == null) {
        if (flag == 10) {
            localStorage.p = result.join("");
            window.open('../result/result.html');
        } else {
            alert("Please choose an answer!");
        }
    } else {
        result.push(point);
        point = null;
        clearRadioStatus("choice" + (flag + 1));
        document.getElementById("q" + (flag + 1)).style.visibility = 'hidden';
        document.getElementById("q" + (flag + 2)).style.visibility = 'visible';
        flag++;
    }
}