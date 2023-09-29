// Validation Rules

const validationRules = {

    // Form Rules

    title: {
        required: true,
        maxLength: 255,
    },
    description: {
        maxLength: 255,
    },
    image: {
        url:true,
    },
    price: {
        required: true,
        decimalDigits: 2,
    },

};

const errors = {};


// Check Image Url
function isValidUrl(url) {

    return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}



// Check Decimal Digits
function checkDecimalMaxDigits(value, maxDigits) {

    const valueString = value.toString();
    const periodPos = valueString.indexOf('.');
    if (periodPos >= 0) return valueString.slice(periodPos + 1).length <= maxDigits;
    return true;// No period found
}


// Validate Field Function

function validateField(fieldName, value) {

    const rules = validationRules[fieldName]
    errors[fieldName] = [];



    if(rules.required && !value.trim()){
        errors[fieldName].push(`Il campo è obbligatorio.`);
    };

    
    if(rules.maxLength && value.length > rules.maxLength){
        errors[fieldName].push(`Il campo deve contenere al massimo ${rules.maxLength} caratteri.`);
    };


    // Controllo Url


    if (rules.decimalDigits && !checkDecimalMaxDigits(value, rules.decimalDigits)) {
        errors[fieldName].push(`Il campo deve avere al massimo ${rules.decimalDigits} cifre decimali.`);
    }
};


// Update error message

function updateErrorMessages() {
    for (const fieldName in validationRules) {

        const errorContainer = document.getElementById(`${fieldName}-error`);
        const fieldErrors = errors[fieldName];
        if (fieldErrors && fieldErrors.length > 0) {
            errorContainer.innerText = fieldErrors.join(" ");
        } else {
            errorContainer.innerText = "";
        }
    }
}


// Check if all fields are validated

function validateAllFields() {
    for (const fieldName in formFields) {
        const value = formFields[fieldName].value;
        validateField(fieldName, value);
    }

    updateErrorMessages();
}



// Get the element of the form
const formFields = {
    title: document.getElementById("title"),
    description: document.getElementById("description"),
    image: document.getElementById("image"),
    price: document.getElementById("price"),

};



// Add event listener and call functions

for (const fieldName in formFields) {

    formFields[fieldName].addEventListener("input", (e) => {

        validateField(fieldName, e.target.value);
        updateErrorMessages();
    });
}


const validationForm = document.getElementById("validation-form");

validationForm.addEventListener("submit", (event) => {

    validateAllFields();

    const hasErrors = Object.values(errors).some(fieldErrors => fieldErrors.length > 0);

    if (hasErrors) {
        event.preventDefault();
    }
});