<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment Integration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<style>
    :root {
        --bs-primary: #2F502DFF;
    }

    .test{
        color: var(--bs-primary);
    }
    .btn{
        background-color: var(--bs-primary);
    }
</style>
<body>
<div class="container mt-5">
    <h2 class="test">Stripe Payment Integration</h2>
    <div id="payment-errors" class="alert alert-danger d-none"></div>
    <form id="payment-form">
        @csrf
        <div id="card-element" class="form-control mb-3">
            <!-- Stripe Elements will create a card input field here -->
        </div>
        <button type="submit" class="btn btn-primary">Pay</button>
    </form>
</div>

<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}'); // Your Stripe publishable key
    const elements = stripe.elements();

    // Create an instance of the card Element
    const card = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#32325d',
                '::placeholder': {
                    color: '#aab7c4',
                },
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a',
            },
        },
    });

    // Mount the card Element to the card-element div
    card.mount('#card-element');

    // Handle form submission
    document.getElementById('payment-form').addEventListener('submit', async (e) => {
        e.preventDefault();

        // Create a token using the card Element
        const { token, error } = await stripe.createToken(card);

        if (error) {
            showError(error.message);
        } else {
            await submitPayment(token.id);
        }
    });

    // Function to show error messages
    function showError(message) {
        const errorDiv = document.getElementById('payment-errors');
        errorDiv.textContent = message;
        errorDiv.classList.remove('d-none');
    }

    // Function to submit the token to your backend
    async function submitPayment(token) {
        try {
            let cardNumber = document.querySelector('input[name="cardnumber"]').value;

            const response = await fetch('{{ route('stripe.custom.submit') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify({ token, cardNumber }), // Send card_number with the token
            });

            const result = await response.json();

            if (result.success) {
                alert('Payment successful!');

                reload();
            } else {
                showError(result.message || 'Payment failed.');
            }
        } catch (error) {
            showError('An error occurred. Please try again.');
        }
    }
</script>
</body>
</html>
