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

// Validate DNI
function validateDNI(dni) {
    var dniRegex = /^[0-9]{8}[A-Z]$/;

    return dniRegex.test(dni);
}

function validateForm() {
    var dniInput = document.getElementById('dni');
    var divDNI = document.getElementById('divDNI');
    var dniValue = dniInput.value.trim();

    var isValid = true;

    // Validar el DNI
    if (!validateDNI(dniValue)) {
        divDNI.style.borderBottomColor = 'red';
        divDNI.focus();
        isValid = false;
    } else {
        divDNI.style.borderBottomColor = 'black';
    }

    return isValid;
}