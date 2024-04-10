document.getElementById('PRO_OPEN').addEventListener('change', function () {
    var federationInput = document.getElementById('federation');
    var insurerInput = document.getElementById('insurerId');
    if (this.value === 'PRO') {
        federationInput.required = true;
        document.getElementById('federationInput').style.display = 'block';
        insurerInput.required = false;
        document.getElementById('insurerInput').style.display = 'none';
    } else {
        federationInput.required = false;
        document.getElementById('federationInput').style.display = 'none';
        insurerInput.required = true;
        document.getElementById('insurerInput').style.display = 'block';
    }
});