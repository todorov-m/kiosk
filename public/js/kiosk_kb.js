const Keyboard = window.SimpleKeyboard.default;

let selectedInput;

let keyboard = new Keyboard({
    onChange: input => onChange(input),
    onKeyPress: button => onKeyPress(button),
    layout: {
        default: ["1 2 3", "4 5 6", "7 8 9", ". 0 {bksp}", "{clear}"]

    },
    theme: "hg-theme-default hg-layout-numeric numeric-theme"
});


document.querySelectorAll(".input").forEach(input => {
    input.addEventListener("focus", onInputFocus);
    // Optional: Use if you want to track input changes
    // made without simple-keyboard
    input.addEventListener("input", onInputChange);
});

function onInputFocus(event) {
    selectedInput = `#${event.target.id}`;

    keyboard.setOptions({
        inputName: event.target.id
    });
}

function onInputChange(event) {
    keyboard.setInput(event.target.value, event.target.id);
}

function onChange(input) {
    console.log("Input changed", input);
    document.querySelector(selectedInput || ".input").value = input;
    document.querySelector(selectedInput || ".input").dispatchEvent(new Event('input'));
}

function onKeyPress(button) {
    console.log("Button pressed", button);
    if (button === "{clear}") handleClear();

}

function handleClear() {
    keyboard.clearInput();

}
