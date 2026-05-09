function changeText() {
    const text = document.getElementById("text");

    if (text.innerText === "Hello, World!") {
        text.innerText = "Привет, мир!";
    } else {
        text.innerText = "Hello, World!";
    }
}