function validateForm() {
    errors = {};
    nameError.innerText = "";
    surnameError.innerText = "";
    emailError.innerText = "";
    passwordError.innerText = "";
    confirmPasswordError.innerText = "";

    //Validazione Nome
    if (nameFieldValue.length > 255) {
        errors.name = "Il nome deve essere lungo massimo 255 caratteri";
        nameError.innerText = errors.name;
    }

    //Validazione Cognome
    if (surnameFieldValue.length > 255) {
        errors.surname = "Il cognome deve essere lungo massimo 255 caratteri";
        surnameError.innerText = errors.surname;
    }

    //Validazione Email
    if (!emailFieldValue.length) {
        errors.email = "La mail è obbligatoria";
        emailError.innerText = errors.email;
    }

    //Validazione Password
    if (!passwordFieldValue.length) {
        errors.password = "La password è obbligatoria";
        passwordError.innerText = errors.password;
    }

    //Validazione Conferma Password
    if (passwordFieldValue != passwordConfirmFieldValue) {
        errors.passwordconfirm = "Le password non coincidono";
        confirmPasswordError.innerText = errors.passwordconfirm;
    }
}

//Campi del form
const validationForm = document.getElementById("validation-form");
const nameField = document.getElementById("name");
const surnameField = document.getElementById("surname");
const dateOfBirthField = document.getElementById("date_of_birth");
const emailField = document.getElementById("email");
const passwordField = document.getElementById("password");
const passwordConfirmField = document.getElementById("password-confirm");

//Messaggi di errore del form
const nameError = document.getElementById("name-error");
const surnameError = document.getElementById("surname-error");
const dateOfBirthError = document.getElementById("date-error");
const emailError = document.getElementById("email-error");
const passwordError = document.getElementById("password-error");
const confirmPasswordError = document.getElementById("password-confirm-error");

let errors = {};
let nameFieldValue = nameField.value;
let surnameFieldValue = surnameField.value;
let emailFieldValue = emailField.value;
let passwordFieldValue = passwordField.value;
let passwordConfirmFieldValue = passwordConfirmField.value;

validationForm.addEventListener("submit", (e) => {
    e.preventDefault();
    nameFieldValue = nameField.value;
    surnameFieldValue = surnameField.value;
    emailFieldValue = emailField.value;
    passwordFieldValue = passwordField.value;
    passwordConfirmFieldValue = passwordConfirmField.value;

    //Eseguo la funzione di validazione:
    validateForm();

    //Il form viene lanciato:
    if (!Object.keys(errors).length) validationForm.submit();
});
