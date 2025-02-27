function getActiveFormId() {
    const activeTab = document.querySelector('.tab-pane.fade.show.active');
    return activeTab ? activeTab.querySelector('form').id : null;
}
function getFieldId(fieldName) {
    const activeFormId = getActiveFormId();
    return activeFormId ? `${fieldName}-${activeFormId.split('-')[1]}` : null;
}
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
function validateForm() {
    const activeFormId = getActiveFormId();
    if (!activeFormId) return false;

    const fields = [{id: getFieldId('card_number'), isValid: validateCardNumber()}, {
        id: getFieldId('cvv'), isValid: validateCVV()
    }, {id: getFieldId('expiry_month'), isValid: validateExpiryMonth()}, {
        id: getFieldId('expiry_year'), isValid: validateExpiryYear()
    }, {id: getFieldId('first_name'), isValid: validateFirstName()}, {
        id: getFieldId('last_name'), isValid: validateLastName()
    }, {id: getFieldId('email'), isValid: validateEmail()}, {
        id: getFieldId('phone'), isValid: validatePhone()
    }, {id: getFieldId('country'), isValid: validateCountry()}, {
        id: getFieldId('address'), isValid: validateAddress()
    }, {id: getFieldId('city'), isValid: validateCity()}, {
        id: getFieldId('zipcode'), isValid: validateZipcode()
    }, {id: getFieldId('state'), isValid: validateState()}];

    for (const field of fields) {
        if (!field.isValid) {
            return document.getElementById(field.id);
        }
    }
    return null;
}
function validateCardNumber() {
    const cardNumberId = getFieldId('card_number');
    const cardNumber = document.getElementById(cardNumberId).value.replace(/-/g, '');
    const errorElement = document.getElementById(`${cardNumberId}_error`);

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
    const cvvId = getFieldId('cvv');
    const cvv = document.getElementById(cvvId);
    const errorElement = document.getElementById(`${cvvId}_error`);
    if (!/^\d{3,4}$/.test(cvv.value)) {
        errorElement.textContent = 'Invalid CVV. Must be 3 or 4 digits.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}
function validateExpiryMonth() {
    const expiryMonthId = getFieldId('expiry_month');
    const expiryMonth = document.getElementById(expiryMonthId).value;
    const expiryYearId = getFieldId('expiry_year');
    const expiryYear = document.getElementById(expiryYearId).value;
    const errorElement = document.getElementById(`${expiryMonthId}_error`);
    const expiryErrorElement = document.getElementById(`${expiryMonthId}_error`);

    if (!expiryMonth) {
        errorElement.textContent = 'Please select a valid expiry month.';
        return false;
    }

    if (expiryYear) {
        const currentYear = new Date().getFullYear();
        const currentMonth = new Date().getMonth() + 1;

        if (parseInt(expiryYear) < currentYear || (parseInt(expiryYear) === currentYear && parseInt(expiryMonth) < currentMonth)) {
            expiryErrorElement.textContent = 'Card has expired.';
            return false;
        } else {
            expiryErrorElement.textContent = '';
        }
    }

    errorElement.textContent = '';
    return true;
}
function validateExpiryYear() {
    const expiryYearId = getFieldId('expiry_year');
    const expiryYear = document.getElementById(expiryYearId).value;
    const expiryMonthId = getFieldId('expiry_month');
    const expiryMonth = document.getElementById(expiryMonthId).value;
    const errorElementYear = document.getElementById(`${expiryYearId}_error`);
    const expiryErrorElement = document.getElementById(`${expiryYearId}_error`);

    if (!expiryYear) {
        errorElementYear.textContent = 'Please select a valid expiry year.';
        return false;
    }

    if (expiryMonth) {
        const currentYear = new Date().getFullYear();
        const currentMonth = new Date().getMonth() + 1;

        if (parseInt(expiryYear) < currentYear || (parseInt(expiryYear) === currentYear && parseInt(expiryMonth) < currentMonth)) {
            expiryErrorElement.textContent = 'Card has expired.';
            return false;
        } else {
            expiryErrorElement.textContent = '';
        }
    }

    errorElementYear.textContent = '';
    return true;
}
function validateFirstName() {
    const firstNameId = getFieldId('first_name');
    const firstName = document.getElementById(firstNameId).value;
    const errorElement = document.getElementById(`${firstNameId}_error`);

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
    const lastNameId = getFieldId('last_name');
    const lastName = document.getElementById(lastNameId).value;
    const errorElement = document.getElementById(`${lastNameId}_error`);

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
    const emailId = getFieldId('email');
    const email = document.getElementById(emailId).value;
    const errorElement = document.getElementById(`${emailId}_error`);

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
    const phoneId = getFieldId('phone');
    const phone = document.getElementById(phoneId).value;
    const errorElement = document.getElementById(`${phoneId}_error`);

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
    const countryId = getFieldId('country');
    const country = document.getElementById(countryId).value;
    const errorElement = document.getElementById(`${countryId}_error`);

    if (!country) {
        errorElement.textContent = 'Please select a country.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}
function validateAddress() {
    const addressId = getFieldId('address');
    const address = document.getElementById(addressId).value;
    const errorElement = document.getElementById(`${addressId}_error`);

    if (!address.trim()) {
        errorElement.textContent = 'Address is required.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}
function validateCity() {
    const cityId = getFieldId('city');
    const city = document.getElementById(cityId).value;
    const errorElement = document.getElementById(`${cityId}_error`);

    if (!city.trim()) {
        errorElement.textContent = 'City is required.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}
function validateZipcode() {
    const zipcodeId = getFieldId('zipcode');
    const zipcode = document.getElementById(zipcodeId).value;
    const countryId = getFieldId('country');
    const country = document.getElementById(countryId).value;
    const errorElement = document.getElementById(`${zipcodeId}_error`);

    let isValid = false;
    let errorMessage = '';

    switch (country) {
        case 'US':
            isValid = /^\d{5}(-\d{4})?$/.test(zipcode);
            errorMessage = 'Invalid US zip code. Must be 5 digits (e.g., 12345) or 9 digits (e.g., 12345-6789).';
            break;

        case 'CA':
            isValid = /^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/.test(zipcode);
            errorMessage = 'Invalid Canadian postal code. Must be in the format A1A 1A1.';
            break;

        case 'UK':
            isValid = /^[A-Za-z]{1,2}\d{1,2}[A-Za-z]? \d[A-Za-z]{2}$/.test(zipcode);
            errorMessage = 'Invalid UK postal code. Must be in the format A1 1AA, A11 1AA, AA1 1AA, or AA11 1AA.';
            break;

        case 'IN':
            isValid = /^\d{6}$/.test(zipcode); // 123456
            errorMessage = 'Invalid Indian postal code. Must be 6 digits.';
            break;

        case 'AU':
            isValid = /^\d{4}$/.test(zipcode); // 1234
            errorMessage = 'Invalid Australian postal code. Must be 4 digits.';
            break;

        default:
            isValid = /^[A-Za-z0-9\s\-]{3,10}$/.test(zipcode);
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
    const stateId = getFieldId('state');
    const state = document.getElementById(stateId).value;
    const errorElement = document.getElementById(`${stateId}_error`);

    if (!state.trim()) {
        errorElement.textContent = 'State is required.';
        return false;
    } else {
        errorElement.textContent = '';
        return true;
    }
}
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

document.addEventListener('input', function (e) {
    if (e.target.id.includes('card_number')) {
        const cardTypeLogoId = getFieldId('card_type_logo');
        const cardTypeLogo = document.getElementById(cardTypeLogoId);
        let cardNumber = e.target.value.replace(/\D/g, '');

        e.target.value = cardNumber.replace(/(\d{4})(?=\d)/g, '$1-');
        const type = detectCardType(cardNumber);
        if (type) {
            cardTypeLogo.className = `cctype ${type}`;
            cardTypeLogo.style.display = 'block';
        } else {
            cardTypeLogo.style.display = 'none';
        }
    }
});

document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener('change', function (event) {
        if (event.target.matches('input[type="checkbox"][name="shipping"]')) {
            const shippingCheckbox = event.target;
            const shippingFields = shippingCheckbox.closest('form').querySelector('.shipping-fields');
            if (shippingFields) {
                shippingFields.style.display = shippingCheckbox.checked ? 'none' : 'block';
            }
        }
    });
    const countryId = getFieldId('country');
    document.getElementById(countryId).addEventListener('change', validateZipcode);
    const forms = document.querySelectorAll('.paymentForm');
    forms.forEach(form => {
        form.querySelectorAll("input, select").forEach(field => {
            field.addEventListener('blur', validateField);
            field.addEventListener('focus', clearError);
        });
    });
    function validateField(event) {
        const field = event.target;
        const fieldName = field.name;
        const fieldId = getFieldId(fieldName);
        const errorElement = document.getElementById(`${fieldId}_error`);
        if (!errorElement) return;
        let value = field.value.trim();
        let errorMessage = "";

        if (value === "") {
            errorElement.textContent = "";
            return;
        }
        if (fieldName.includes("card_number")) {
            const cardNumber = value.replace(/-/g, '');
            if (!/^\d{13,19}$/.test(cardNumber)) {
                errorMessage = "Enter a valid 13-19 digit card number.";
            } else if (!luhnCheck(cardNumber)) {
                errorMessage = "Invalid card number. Please check again.";
            }
        } else if (fieldName.includes("cvv")) {
            if (!/^\d{3,4}$/.test(value)) {
                errorMessage = "CVV must be 3-4 digits.";
            }
        } else if (fieldName.includes("first_name") || fieldName.includes("last_name")) {
            if (/[^a-zA-Z ]/.test(value)) {
                errorMessage = "Only letters and spaces allowed.";
            } else if (/\s/.test(value) && !/[a-zA-Z]/.test(value)) {
                errorMessage = "Please enter a valid name.";
            }
        } else if (fieldName.includes("email")) {
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                errorMessage = "Enter a valid email address.";
            }
        } else if (fieldName.includes("phone")) {
            const digitsOnly = value.replace(/\D/g, "");
            if (!/^\d{10,15}$/.test(digitsOnly)) {
                errorMessage = "Invalid phone number. Must be 10 to 15 digits.";
            }
        } else if (fieldName.includes("expiry_month")) {
            validateExpiryMonth();
            validateExpiryYear();
            return;
        } else if (fieldName.includes("expiry_year")) {
            validateExpiryYear();
            validateExpiryMonth();
            return;
        } else if (fieldName.includes("zipcode") || fieldName.includes("country")) {

            // if (!validateZipcode()) {
            //     return;
            // }
        } else if (fieldName.includes("address") || fieldName.includes("city") || fieldName.includes("state")) {

        }
        errorElement.textContent = errorMessage;
    }
    function clearError(event) {
        const field = event.target;
        const errorElement = document.getElementById(`${field.id}_error`);
        if (errorElement) {
            errorElement.textContent = "";
        }
    }
    const expiryMonthField = document.getElementById(getFieldId('expiry_month'));
    const expiryYearField = document.getElementById(getFieldId('expiry_year'));
    if (expiryMonthField) {
        expiryMonthField.addEventListener('change', function () {
            validateExpiryMonth();
            if (expiryYearField && expiryYearField.value) {
                validateExpiryYear();
            }
        });
    }
    if (expiryYearField) {
        expiryYearField.addEventListener('change', function () {
            validateExpiryYear();
            if (expiryMonthField && expiryMonthField.value) {
                validateExpiryMonth();
            }
        });
    }
    function validateExpiryDate() {
        const month = document.getElementById(getFieldId('expiry_month')).value;
        const year = document.getElementById(getFieldId('expiry_year')).value;
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

$(document).ready(function () {
    const funnyMessages = ["Counting coins...", "Bribing the bank manager...", "Convincing the payment gateway...", "Training the payment pigeons...", "Negotiating with the money tree...", "Polishing the credit card...", "Asking the ATM nicely...", "Charging the payment lasers...", "Summoning the payment wizard...", "Calming the angry payment gods..."];

    let messageIndex = 0;
    let intervalId = null;
    const loader = document.querySelector('.loader-container');
    const funnyMessageElement = document.querySelector('.funny-message');

    function changeFunnyMessage() {
        funnyMessageElement.textContent = funnyMessages[messageIndex];
        messageIndex = (messageIndex + 1) % funnyMessages.length;
    }

    function showLoader() {
        loader.style.display = "flex";
        intervalId = setInterval(changeFunnyMessage, 500);
    }
    hideLoader();

    function hideLoader() {
        loader.style.display = "none";
        if (intervalId) clearInterval(intervalId);
    }

    $('.paymentForm').on('submit', function (e) {
        e.preventDefault();
        const submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true).text('Processing...');

        const firstErrorField = validateForm();
        if (firstErrorField) {
            const errorMessage = $(`#${firstErrorField.id}_error`).text() || 'Please correct the errors in the form.';
            toastr.error(errorMessage, 'Validation Error');
            firstErrorField.scrollIntoView({behavior: 'smooth', block: 'center'});
            submitButton.prop('disabled', false).text('Submit');
            return;
        }
        showLoader();

        let formData = $(this).serializeArray();
        formData = formData.map(field => {
            if (field.name === 'card_number') {
                field.value = field.value.replace(/\D/g, '');
            }
            return field;
        });
        const paymentUrl = e.target.action;

        $.ajax({
            url: paymentUrl,
            type: 'POST',
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            success: function (response) {
                if (response.message) {
                    toastr.success(response.message, 'Success');
                }
                location.reload();
            },
            error: function (xhr, status, error) {
                const response = xhr.responseJSON;
                const message = response?.error || error || 'Something went wrong. Please try again.';
                if (xhr.status === 422 || response.errors) {
                    let firstError = false;
                    $.each(response.errors, function (field, errorMessage) {
                        firstError = true;
                        if (firstError) {
                            document.getElementById(getFieldId(field)).scrollIntoView({
                                behavior: 'smooth', block: 'center'
                            });
                        }
                        $(`#${getFieldId(field)}_error`).text(errorMessage);
                    });
                    toastr.error(response.message, 'Error');
                } else {
                    toastr.error(message, 'Error');
                }
                console.log(error)
                hideLoader();
                submitButton.prop('disabled', false).text('Submit');
            },
            complete: function () {
                submitButton.prop('disabled', false).text('Submit');
            }
        });
    });
});
