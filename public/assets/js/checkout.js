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
    const isValidExpiryMonth = validateExpiryMonth();
    const isValidExpiryYear = validateExpiryYear();
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
        isValidExpiryMonth &&
        isValidExpiryYear &&
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

function validateExpiryMonth() {
    const expiryMonth = document.getElementById('expiry_month').value;
    const errorElement = document.getElementById('expiry_month_error');

    if (!expiryMonth) {
        errorElement.textContent = 'Please select a valid expiry month.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validateExpiryYear() {
    const expiryYear = document.getElementById('expiry_year').value;
    const errorElementYear = document.getElementById('expiry_year_error');
    const errorElement = document.getElementById('expiry_error');

    if (!expiryYear) {
        errorElementYear.textContent = 'Please select a valid expiry year.';
        return false;
    }
    const currentYear = new Date().getFullYear();
    const currentMonth = new Date().getMonth() + 1;
    const selectedMonth = parseInt(document.getElementById('expiry_month').value, 10);

    if (parseInt(expiryYear, 10) === currentYear && selectedMonth < currentMonth) {
        errorElement.textContent = 'Card expiry date is invalid.';
        return false;
    }

    errorElement.textContent = '';
    return true;
}

function validateFirstName() {
    const firstName = document.getElementById('first_name').value;
    const errorElement = document.getElementById('first_name_error');

    if (!firstName.trim()) {
        errorElement.textContent = 'First name is required.';
        return false;
    } else if (/\d/.test(firstName)) {
        errorElement.textContent = 'First name should not contain numbers.';
        return false;
    } else if (/[^a-zA-Z ]/.test(firstName)) {
        errorElement.textContent = 'First name should not contain special characters.';
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
    } else if (/\d/.test(lastName)) {
        errorElement.textContent = 'Last name should not contain numbers.';
        return false;
    } else if (/[^a-zA-Z ]/.test(lastName)) {
        errorElement.textContent = 'Last name should not contain special characters.';
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
    } else if (!/^\S+@\S+\.\S+$/.test(email)) {
        errorElement.textContent = 'Invalid email format.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}

function validatePhone() {
    const phone = document.getElementById('phone').value;
    const errorElement = document.getElementById('phone_error');

    if (/[a-zA-Z]/.test(phone)) {
        errorElement.textContent = 'Phone number should not contain alphabets or invalid characters.';
        return false;
    }
    const digitsOnly = phone.replace(/\D/g, '');
    if (!/^\d{10,15}$/.test(digitsOnly)) {
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
        errorElement.textContent = 'Please select a country.';
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

// function validateZip() {
//     const zip = document.getElementById('zip').value;
//     const errorElement = document.getElementById('zip_error');
//
//     if (!/^[a-zA-Z0-9]{4,10}$/.test(zip)) {
//         errorElement.textContent = 'Invalid ZIP code. Must be 4 to 10 digits.';
//         return false;
//     } else {
//         errorElement.textContent = '';
//         return true;
//     }
// }
function validateZip() {
    const country = document.getElementById('country').value;
    const zip = document.getElementById('zip').value;
    const errorElement = document.getElementById('zip_error');

    let isValid = false;
    let errorMessage = '';

    switch (country) {
        case 'US':
            isValid = /^\d{5}(-\d{4})?$/.test(zip);
            errorMessage = 'Invalid US zip code. Must be 5 digits (e.g., 12345) or 9 digits (e.g., 12345-6789).';
            break;

        case 'CA':
            isValid = /^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/.test(zip);
            errorMessage = 'Invalid Canadian postal code. Must be in the format A1A 1A1.';
            break;

        case 'UK':
            isValid = /^[A-Za-z]{1,2}\d{1,2}[A-Za-z]? \d[A-Za-z]{2}$/.test(zip);
            errorMessage = 'Invalid UK postal code. Must be in the format A1 1AA, A11 1AA, AA1 1AA, or AA11 1AA.';
            break;

        case 'IN':
            isValid = /^\d{6}$/.test(zip); // 123456
            errorMessage = 'Invalid Indian postal code. Must be 6 digits.';
            break;

        case 'AU':
            isValid = /^\d{4}$/.test(zip); // 1234
            errorMessage = 'Invalid Australian postal code. Must be 4 digits.';
            break;

        default:
            isValid = /^[A-Za-z0-9\s\-]{3,10}$/.test(zip);
            errorMessage = 'Invalid postal code.';
            break;
    }
    if (!isValid) {
        errorElement.textContent = errorMessage;
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

// function restrictToDigits(event) {
//     const input = event.target;
//     const value = input.value;
//
//     input.value = value.replace(/\D/g, '');
//
//     if (input.value.length > 4) {
//         input.value = input.value.slice(0, 4);
//     }
// }

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('country').addEventListener('change', validateZip);

    const form = document.getElementById("paymentForm");

    form.querySelectorAll("input, select").forEach((field) => {
        // field.addEventListener("input", validateField);
        // field.addEventListener("change", validateField);
        field.addEventListener("blur", validateField);
        field.addEventListener("focus", clearError);
    });

    function validateField(event) {
        const field = event.target;
        const fieldName = field.name;
        const errorElement = document.getElementById(`${fieldName}_error`);
        if (!errorElement) return;
        let value = field.value.trim();
        let errorMessage = "";

        if (value === "") {
            errorElement.textContent = "";
            return;
        }
        switch (fieldName) {
            case "card_number":
                const cardNumber = value.replace(/\s/g, ""); // Remove spaces
                if (!/^\d{16,19}$/.test(cardNumber)) {
                    errorMessage = "Enter a valid 16-19 digit card number.";
                } else if (!luhnCheck(cardNumber)) {
                    errorMessage = "Invalid card number. Please check again.";
                }
                break;

            case "cvv":
                if (!/^\d{3,4}$/.test(value)) {
                    errorMessage = "CVV must be 3-4 digits.";
                }
                break;

            case "first_name":
            case "last_name":
                if (/[^a-zA-Z ]/.test(value)) {
                    errorMessage = "Only letters and spaces allowed.";
                }
                break;

            case "email":
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    errorMessage = "Enter a valid email address.";
                }
                break;

            case "phone":
                const digitsOnly = value.replace(/\D/g, "");
                if (!/^\d{10,15}$/.test(digitsOnly)) {
                    errorMessage = "Invalid phone number. Must be 10 to 15 digits.";
                }
                break;

            case "expiry_month":
            case "expiry_year":
                validateExpiryDate();
                return;

            case "zip":
            case "country":
                if (!validateZip()) {
                    return;
                }
                break;

            case "address":
            case "city":
            case "state":
                break;
        }
        errorElement.textContent = errorMessage;
    }

    function clearError(event) {
        const field = event.target;
        const errorElement = document.getElementById(`${field.name}_error`);
        if (errorElement) {
            errorElement.textContent = "";
        }
    }

    function validateExpiryDate() {
        const month = document.getElementById("expiry_month").value;
        const year = document.getElementById("expiry_year").value;
        const errorElement = document.getElementById("expiry_error");

        if (!month || !year) {
            errorElement.textContent = "Select a valid expiration date.";
            return;
        }

        const currentYear = new Date().getFullYear();
        const currentMonth = new Date().getMonth() + 1;

        if (parseInt(year) < currentYear || (parseInt(year) === currentYear && parseInt(month) < currentMonth)) {
            errorElement.textContent = "Card has expired.";
        } else {
            errorElement.textContent = "";
        }
    }
});
