const inputContainer = document.getElementById('inputs-container');

function addInputNumber() {
    const newInput = document.createElement('input');
    newInput.type = 'number';
    newInput.placeholder = 'Digite um Número...';
    newInput.name = "number[]"
    newInput.min = 0;

    inputContainer.appendChild(newInput);
};
