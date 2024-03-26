document.getElementById('PRO_OPEN').addEventListener('change', function () {
    var federationInput = document.getElementById('federation');
    if (this.value === 'PRO') {
        federationInput.required = true;
        document.getElementById('federationInput').style.display = 'block';
    } else {
        federationInput.required = false;
        document.getElementById('federationInput').style.display = 'none';
    }
});