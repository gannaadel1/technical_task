# technical_task
payment with stripe:
Use Composer to install the Stripe library
In your .env file, add your Stripe API secret key 
create a config/stripe.php
create a migration for storing payment details
Generate a controller, StripeController, to handle payment actions.
index: Displays the payment form.
processPayment: Validates payment information, processes the payment using Stripe, and stores payment details in the database.
