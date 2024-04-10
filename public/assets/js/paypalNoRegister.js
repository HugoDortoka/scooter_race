var paypalButtonContainer = document.getElementById('paypal-button-container');
var paypalButtonInitialized = false;

document.getElementById('registerNoRegister-button').addEventListener('click', function(event) {
    event.preventDefault();

    if (paypalButtonContainer.style.display === 'block' && paypalButtonInitialized) {
        paypalButtonContainer.style.display = 'none';
        return;
    }

    var requiredFields = document.querySelectorAll('[required]');

    var isValidForm = true;
    requiredFields.forEach(function(field) {
        if (!field.value.trim()) {
            isValidForm = false;
        }
    });

    if (!isValidForm) {
        alert('Please complete all required fields');
        return;
    }
    
    var isValidDNI = window.validateForm();
    
    if (!isValidDNI) {
        return;
    }

    var selectElement = document.getElementById('insurerId');
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var selectedPrice = selectedOption.getAttribute('data-price');

    paypalButtonContainer.innerHTML = '';

    paypal.Buttons({
    style:{
        color:  'blue',
        shape:  'pill',
        label:  'pay',
        layout: 'horizontal',
        tagline: false
    },
    createOrder: function(data, actions){
        return actions.order.create({
        purchase_units: [{
            amount: {
            value: parseFloat(selectedPrice) + parseFloat(price),
            }
        }]
        })
    },
    onApprove: function(data, actions){
        actions.order.capture().then(function (details){
            document.getElementById('registerNoRegister-form').submit();
        })
    }
    }).render('#paypal-button-container');

    paypalButtonInitialized = true;
    paypalButtonContainer.style.display = 'block';
});