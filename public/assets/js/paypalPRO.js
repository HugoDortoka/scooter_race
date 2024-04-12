var paypalButtonContainer = document.getElementById('paypal-button-container');
var paypalButtonInitialized = false;

document.getElementById('registerPRO-button').addEventListener('click', function(event) {
    event.preventDefault();

    if (paypalButtonContainer.style.display === 'block' && paypalButtonInitialized) {
        paypalButtonContainer.style.display = 'none';
        return;
    }

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
        var totalPrice = price;
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
        window.location.href = registerPRO;
        })
    }
    }).render('#paypal-button-container');

    paypalButtonInitialized = true;
    paypalButtonContainer.style.display = 'block';
});