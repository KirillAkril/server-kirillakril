// поле калькулятора
const display = document.getElementById("display");


function addValue(value) {

    display.value += value;

}

// очистка поля
function clearDisplay() {

    display.value = "";

}

// поддержка клавиатуры
document.addEventListener("keydown", function(event) {

    const key = event.key;

    // разрешенные символы
    const allowed = [
    "0","1","2","3","4","5",
    "6","7","8","9",
    "+","-","*","/",
    ".","(",")","^","!",

    "s","i","n",
    "c","o","t",
    "a"
];

    if (allowed.includes(key)) {

        display.value += key;

    }


    if (key === "Backspace") {

        display.value = display.value.slice(0, -1);

    }

});