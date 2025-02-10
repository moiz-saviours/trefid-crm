document.getElementById('card_number').addEventListener('input', function (e) {
    const cardTypeLogo = document.getElementById('card_type_logo');
    let cardNumber = e.target.value.replace(/\D/g, '');

    const formattedCardNumber = cardNumber.replace(/(\d{4})(?=\d)/g, '$1-');
    e.target.value = formattedCardNumber;

    const type = detectCardType(cardNumber);
    if (type) {
        cardTypeLogo.className = `cctype ${type}`;
        cardTypeLogo.style.display = 'block';
    } else {
        cardTypeLogo.style.display = 'none';
    }
});

function detectCardType(cardNumber) {
    const cardTypes = {
        visa: /^4/,
        mastercard: /^5[1-5]|^22[2-9][0-9]|^2[3-6][0-9]{2}|^27[01][0-9]|^2720/,
        amex: /^3[47]/,
        discover: /^6(?:011|5|4[4-9])/,
        diners: /^3(?:0[0-5]|[68])/,
        jcb: /^(?:2131|1800|35)/
    };

    for (const [type, regex] of Object.entries(cardTypes)) {
        if (regex.test(cardNumber)) {
            return type;
        }
    }
    return null;
}
document.getElementById('paymentForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form submission

    // Validate all fields
    const isValidCardNumber = validateCardNumber();
    const isValidCVV = validateCVV();
    const isValidExpiry = validateExpiry();
    const isValidFirstName = validateFirstName();
    const isValidLastName = validateLastName();
    const isValidEmail = validateEmail();
    const isValidPhone = validatePhone();
    const isValidCountry = validateCountry();
    const isValidAddress = validateAddress();
    const isValidCity = validateCity();
    const isValidZip = validateZip();
    const isValidState = validateState();

    // If all fields are valid, submit the form
    if (
        isValidCardNumber &&
        isValidCVV &&
        isValidExpiry &&
        isValidFirstName &&
        isValidLastName &&
        isValidEmail &&
        isValidPhone &&
        isValidCountry &&
        isValidAddress &&
        isValidCity &&
        isValidZip &&
        isValidState
    ) {
        this.submit(); // Submit the form
    }
});

// Validation functions
function validateCardNumber() {
    const cardNumber = document.getElementById('card_number').value.replace(/-/g, '');
    const errorElement = document.getElementById('card_number_error');

    if (!/^\d{13,19}$/.test(cardNumber)) {
        errorElement.textContent = 'Invalid card number. Must be 13 to 19 digits.';
        return false;
    } else if (!luhnCheck(cardNumber)) {
        errorElement.textContent = 'Invalid card number. Please check again.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validateCVV() {
    const cvv = document.getElementById('cvv').value;
    const errorElement = document.getElementById('cvv_error');

    if (!/^\d{3,4}$/.test(cvv)) {
        errorElement.textContent = 'Invalid CVV. Must be 3 or 4 digits.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validateExpiry() {
    const expiry = document.getElementById('expiry').value;
    const errorElement = document.getElementById('expiry_error');

    if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)) {
        errorElement.textContent = 'Invalid expiry date. Use MM/YY format.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validateFirstName() {
    const firstName = document.getElementById('first_name').value;
    const errorElement = document.getElementById('first_name_error');

    if (!firstName.trim()) {
        errorElement.textContent = 'First name is required.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validateLastName() {
    const lastName = document.getElementById('last_name').value;
    const errorElement = document.getElementById('last_name_error');

    if (!lastName.trim()) {
        errorElement.textContent = 'Last name is required.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validateEmail() {
    const email = document.getElementById('email').value;
    const errorElement = document.getElementById('email_error');

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        errorElement.textContent = 'Invalid email address.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validatePhone() {
    const phone = document.getElementById('phone').value;
    const errorElement = document.getElementById('phone_error');

    if (!/^\d{10,15}$/.test(phone)) {
        errorElement.textContent = 'Invalid phone number. Must be 10 to 15 digits.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validateCountry() {
    const country = document.getElementById('country').value;
    const errorElement = document.getElementById('country_error');

    if (!country) {
        errorElement.textContent = 'Country is required.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validateAddress() {
    const address = document.getElementById('address').value;
    const errorElement = document.getElementById('address_error');

    if (!address.trim()) {
        errorElement.textContent = 'Address is required.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validateCity() {
    const city = document.getElementById('city').value;
    const errorElement = document.getElementById('city_error');

    if (!city.trim()) {
        errorElement.textContent = 'City is required.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validateZip() {
    const zip = document.getElementById('zip').value;
    const errorElement = document.getElementById('zip_error');

    if (!/^\d{5,10}$/.test(zip)) {
        errorElement.textContent = 'Invalid ZIP code. Must be 5 to 10 digits.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validateState() {
    const state = document.getElementById('state').value;
    const errorElement = document.getElementById('state_error');

    if (!state.trim()) {
        errorElement.textContent = 'State is required.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

// Luhn Algorithm for card number validation
function luhnCheck(cardNumber) {
    let sum = 0;
    for (let i = 0; i < cardNumber.length; i++) {
        let digit = parseInt(cardNumber[cardNumber.length - 1 - i]);
        if (i % 2 === 1) {
            digit *= 2;
            if (digit > 9) digit -= 9;
        }
        sum += digit;
    }
    return sum % 10 === 0;
}
