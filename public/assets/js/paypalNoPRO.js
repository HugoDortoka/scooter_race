var paypalButtonContainer = document.getElementById('paypal-button-container');
var paypalButtonInitialized = false;

document.getElementById('registerNoPRO-button').addEventListener('click', function(event) {
    event.preventDefault();

    if (paypalButtonContainer.style.display === 'block' && paypalButtonInitialized) {
        paypalButtonContainer.style.display = 'none';
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
        var totalPrice = parseFloat(selectedPrice) + parseFloat(price);
        if (typeof discount !== 'undefined') {
            var discountAmount = (parseFloat(discount) / 100) * totalPrice;
            totalPrice -= discountAmount;
        }
        return actions.order.create({
        purchase_units: [{
            amount: {
            value: totalPrice.toFixed(2),
            }
        }]
        })
    },
    onApprove: function(data, actions){
        actions.order.capture().then(function (details){
            document.getElementById('registerNoPRO-form').submit();
        })
    }
    }).render('#paypal-button-container');

    paypalButtonInitialized = true;
    paypalButtonContainer.style.display = 'block';
});