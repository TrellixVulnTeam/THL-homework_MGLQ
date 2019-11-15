var aspect = 99;
var sum = 0;

function getAspect(a) {
    aspect = a.value;
    return aspect;
}

function setQuestion() {
    var num1 = 0;
    var num2 = 0;
    if (aspect == 99) {
        alert("Please choose an aspect first!");
    } else {
        level = document.getElementById("Level").selectedIndex;
        if (level == 0) {
            num1 = Math.floor(Math.random() * (10 - 0 + 1)) + 0;
            num2 = Math.floor(Math.random() * (10 - 0 + 1)) + 0;
        }
        if (level == 1) {
            num1 = Math.floor(Math.random() * (100 - 10 + 1)) + 10;
            num2 = Math.floor(Math.random() * (100 - 10 + 1)) + 10;
        }
        if (level == 2) {
            num1 = Math.floor(Math.random() * (1000 - 100 + 1)) + 100;
            num2 = Math.floor(Math.random() * (1000 - 100 + 1)) + 100;
        }
    }
    if (aspect == "0") {
        sum = num1 + num2;
        document.getElementById("Question").value = num1 + " + " + num2 + " =";
    }
    if (aspect == "1") {
        sum = num1 - num2;
        document.getElementById("Question").value = num1 + " - " + num2 + " =";
    }
    if (aspect == "2") {
        sum = num1 * num2;
        document.getElementById("Question").value = num1 + " * " + num2 + " =";
    }
    if (aspect == "3") {
        sum = num1 % num2;
        document.getElementById("Question").value = num1 + " % " + num2 + " =";
    }
    return sum;
}

function checkAnswer() {
    if (document.getElementById("Question").value == "") {
        alert("Please generate a question first!");
    } else {
        var answer =
            parseInt(document.getElementById("Answer").value);
        if (Number.isInteger(answer) == false) {
            alert("Please input an integer!")
        } else if (answer == sum) {
            alert("Your answer " + answer + " is correct!");
        } else if (answer != sum) {
            alert("Your answer " + answer + " is wrong, " + "the correct result is " + sum + "!");
        }
    }
}