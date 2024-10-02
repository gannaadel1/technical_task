<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>

    <style>
        /* Basic styling for the form and Stripe Elements */
        form {
            max-width: 400px;
            margin: 50px auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .stripe-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        #card-errors {
            color: red;
            margin-top: 12px;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @elseif (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
        @csrf
        <div class="form-group">
            <label for="amount">Amount (in USD):</label>
            <input type="number" name="amount" required min="1" placeholder="Enter amount in USD" />
        </div>

        <!-- Card Number Field -->
        <div class="form-group">
            <label for="card-number-element">Card Number:</label>
            <div id="card-number-element" class="stripe-input"></div> <!-- Stripe Elements card number input -->
        </div>

        <!-- Expiry Date Field -->
        <div class="form-group">
            <label for="card-expiry-element">Expiry Date:</label>
            <div id="card-expiry-element" class="stripe-input"></div> <!-- Stripe Elements expiry date input -->
        </div>

        <!-- CVC Field -->
        <div class="form-group">
            <label for="card-cvc-element">CVC:</label>
            <div id="card-cvc-element" class="stripe-input"></div> <!-- Stripe Elements CVC input -->
        </div>

        <!-- Display card errors -->
        <div id="card-errors" role="alert"></div>

        <button type="submit">Pay Now</button>
    </form>

    <script>
        // Initialize Stripe
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();

        // Style options for Stripe Elements
        var style = {
            base: {
                fontSize: '16px',
                color: '#32325d',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create the cardNumber, cardExpiry, and cardCvc elements
        var cardNumber = elements.create('cardNumber', { style: style });
        var cardExpiry = elements.create('cardExpiry', { style: style });
        var cardCvc = elements.create('cardCvc', { style: style });

        // Mount Stripe Elements into the respective DOM elements
        cardNumber.mount('#card-number-element');
        cardExpiry.mount('#card-expiry-element');
        cardCvc.mount('#card-cvc-element');

        // Handle real-time validation errors from Stripe Elements
        cardNumber.on('change', function(event) {
            var errorElement = document.getElementById('card-errors');
            if (event.error) {
                errorElement.textContent = event.error.message;
            } else {
                errorElement.textContent = '';
            }
        });

        // Handle form submission and token creation
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardNumber).then(function(result) {
                if (result.error) {
                    // Display error message
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to the server
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Function to handle token submission to the server
        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
</body>
</html>
