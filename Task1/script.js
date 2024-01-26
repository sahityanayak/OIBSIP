let display = document.getElementById('display');

function appendToDisplay(value) {
  display.value += value;
}

function clearDisplay() {
  display.value = '';
}

function deleteLast() {
  display.value = display.value.slice(0, -1);
}

function calculate() {
  try {
    let result = eval(display.value.replace(/sqrt/g, 'Math.sqrt'));
    display.value += `                                     ${result}`;
  } catch (error) {
    display.value = 'Error';
  }
}
