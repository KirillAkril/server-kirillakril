const priceInput =
    document.getElementById('price');

const discountInput =
    document.getElementById('discount');

const result =
    document.getElementById('preview-result');

function updateCalculator() {

    const price =
        Number(priceInput.value);

    const discount =
        Number(discountInput.value);

    const total =
        price -
        (price * discount / 100);

    if (!isNaN(total)) {

        result.textContent =
            total.toFixed(2) + ' ₽';
    }
}

priceInput.addEventListener(
    'input',
    updateCalculator
);

discountInput.addEventListener(
    'input',
    updateCalculator
);