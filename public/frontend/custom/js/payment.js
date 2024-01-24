$(function() {
    var options = {
        "key": "rzp_test_Fou50mEQERxqwz",
        "currency": "INR",
        "amount": totalAmount * 100,
        "name": "Place Order",
        "description": "Buy products",
        "order_id": "",
        "modal": {
            // "ondismiss": function () {
            //     window.location.replace(base_url('/cart'));
            // }
        },
        "handler": function(response) {
            $('#payment_id').val(response.razorpay_payment_id);
            $('#payment-form').submit();
        },
        "theme": {
            "color": "#2f3478"
        }
    };
    var rzp1 = new Razorpay(options);
    document.getElementById('rzp-button').onclick = function(e) {
        rzp1.open();
        e.preventDefault();
    }
})