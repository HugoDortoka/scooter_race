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

// Valildate Federation number
function validateFederation(federation) {
    return federation.trim() !== '';
}

function validateForm() {
    var dniInput = document.getElementById('dni');
    var federationInput = document.getElementById('federation');
    var divDNI = document.getElementById('divDNI');
    var divFederation = document.getElementById('divFederation');

    var dniValue = dniInput.value.trim();
    var federationValue = federationInput.value.trim();

    var isValid = true;

    // Validar el DNI
    if (!validateDNI(dniValue)) {
        divDNI.style.borderBottomColor = 'red';
        divDNI.focus();
        isValid = false;
    } else {
        divDNI.style.borderBottomColor = 'black';
    }

    // Validar el número de federación solo si está visible
    if (federationInput.style.display !== 'none') {
        if (!validateFederation(federationValue)) {
            divFederation.style.borderBottomColor = 'red';
            divFederation.focus();
            isValid = false;
        } else {
            divFederation.style.borderBottomColor = 'black';
        }
    }

    return isValid;
}