var point = 0;
var flag = 0;
//var status = false;

function getValue(p) {
    point = parseInt(p.value);
}

function clearRadioStatus(Name) {
    for (i = 0; i < 3; i++) {
        document.getElementsByName(Name)[i].checked = false;
    }
}

function checkRadioStatus(Name) {
    var s = new Array();
    var defaultStatus = false;
    for (i = 0; i < 3; i++) {
        s[i] = document.getElementsByName(Name)[i].checked;
        if (s[i]) {
            return !defaultStatus;
        } else {
            continue;
        }
    }
}

function goBack() {
    if (flag == 0) {
        history.back(-1);
    }
    if (flag == 1) {
        clearRadioStatus("choice2");
        document.getElementById("q2").style.visibility = "hidden";
        document.getElementById("q1").style.visibility = "visible";
        flag--;
    }
    if (flag == 2) {
        clearRadioStatus("choice3");
        document.getElementById("q3").style.visibility = "hidden";
        document.getElementById("q2").style.visibility = "visible";
        flag--;
    }
    if (flag == 3) {
        clearRadioStatus("choice4");
        document.getElementById("q4").style.visibility = "hidden";
        document.getElementById("q3").style.visibility = "visible";
        flag--;
    }
    if (flag == 4) {
        clearRadioStatus("choice5");
        document.getElementById("q5").style.visibility = "hidden";
        document.getElementById("q4").style.visibility = "visible";
        flag--;
    }
    if (flag == 5) {
        clearRadioStatus("choice6");
        document.getElementById("q6").style.visibility = "hidden";
        document.getElementById("q5").style.visibility = "visible";
        flag--;
    }
    if (flag == 6) {
        clearRadioStatus("choice7");
        document.getElementById("q7").style.visibility = "hidden";
        document.getElementById("q6").style.visibility = "visible";
        flag--;
    }
    if (flag == 7) {
        clearRadioStatus("choice8");
        document.getElementById("q8").style.visibility = "hidden";
        document.getElementById("q7").style.visibility = "visible";
        flag--;
    }
    if (flag == 8) {
        clearRadioStatus("choice9");
        document.getElementById("q9").style.visibility = "hidden";
        document.getElementById("q8").style.visibility = "visible";
        flag--;
    }
    if (flag == 9) {
        clearRadioStatus("choice10");
        document.getElementById("q10").style.visibility = "hidden";
        document.getElementById("q9").style.visibility = "visible";
        flag--;
    }
    if (flag == 10) {
        document.getElementById("ending").style.visibility = "hidden";
        document.getElementById("q1").style.visibility = "visible";
        flag = 0;
    }
}

function goNext() {
    if (!(checkRadioStatus("choice1") || checkRadioStatus("choice2") || checkRadioStatus("choice3") || checkRadioStatus("choice4") || checkRadioStatus("choice5") || checkRadioStatus("choice6") || checkRadioStatus("choice7") || checkRadioStatus("choice8") || checkRadioStatus("choice9") || checkRadioStatus("choice10"))) {
        if (flag == 10) {
            window.open('../result/result.html');
        } else {
            alert("Please choose an answer!");
        }
    }
    if (checkRadioStatus("choice1")) {
        localStorage.p1 = point;
        flag++;
        clearRadioStatus("choice1");
        document.getElementById("q1").style.visibility = "hidden";
        document.getElementById("q2").style.visibility = "visible";
    }
    if (checkRadioStatus("choice2")) {
        localStorage.p2 = point;
        flag++;
        clearRadioStatus("choice2");
        document.getElementById("q2").style.visibility = "hidden";
        document.getElementById("q3").style.visibility = "visible";
    }
    if (checkRadioStatus("choice3")) {
        localStorage.p3 = point;
        flag++;
        clearRadioStatus("choice3");
        document.getElementById("q3").style.visibility = "hidden";
        document.getElementById("q4").style.visibility = "visible";
    }
    if (checkRadioStatus("choice4")) {
        localStorage.p4 = point;
        flag++;
        clearRadioStatus("choice4");
        document.getElementById("q4").style.visibility = "hidden";
        document.getElementById("q5").style.visibility = "visible";
    }
    if (checkRadioStatus("choice5")) {
        localStorage.p5 = point;
        flag++;
        clearRadioStatus("choice5");
        document.getElementById("q5").style.visibility = "hidden";
        document.getElementById("q6").style.visibility = "visible";
    }
    if (checkRadioStatus("choice6")) {
        localStorage.p6 = point;
        flag++;
        clearRadioStatus("choice6");
        document.getElementById("q6").style.visibility = "hidden";
        document.getElementById("q7").style.visibility = "visible";
    }
    if (checkRadioStatus("choice7")) {
        localStorage.p7 = point;
        flag++;
        clearRadioStatus("choice7");
        document.getElementById("q7").style.visibility = "hidden";
        document.getElementById("q8").style.visibility = "visible";
    }
    if (checkRadioStatus("choice8")) {
        localStorage.p8 = point;
        flag++;
        clearRadioStatus("choice8");
        document.getElementById("q8").style.visibility = "hidden";
        document.getElementById("q9").style.visibility = "visible";
    }
    if (checkRadioStatus("choice9")) {
        localStorage.p9 = point;
        flag++;
        clearRadioStatus("choice9");
        document.getElementById("q9").style.visibility = "hidden";
        document.getElementById("q10").style.visibility = "visible";
    }
    if (checkRadioStatus("choice10")) {
        localStorage.p10 = point;
        flag++;
        clearRadioStatus("choice10");
        document.getElementById("q10").style.visibility = "hidden";
        document.getElementById("ending").style.visibility = "visible";
    }
}

//-----------------------------------------使用全局变量验证单选框表单选中情况
//-------------------------------------------使用计数器循环函数隐藏和显示题目