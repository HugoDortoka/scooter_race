// Validate CIF
function validateCIF2(cif) {
    var cifRegex = /^[A-Z][0-9]{8}$/;

    return cifRegex.test(cif);
}

function validateCIF() {
    var cifInput = document.getElementById('cif');
    var cifValue = cifInput.value.trim();

    if (!validateCIF2(cifValue)) {
        cifInput.style.backgroundColor = 'red';
        cifInput.focus();
        return false;
    }

    cifInput.style.backgroundColor = '#0DCAF0';
    return true;
}