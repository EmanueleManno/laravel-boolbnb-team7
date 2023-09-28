// Check Image Url
function checkImage(url) {
    return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}

// Check Decimal Digits
function checkDecimalMaxDigits(value, maxDigits) {
    const valueString = value.toString();
    const periodPos = valueString.indexOf('.');
    if (periodPos >= 0) return valueString.slice(periodPos + 1).length <= maxDigits;
    return true;// No period found
}


function validateForm() {
    errors = {};
    titleError.innerText = "";
    descriptionError.innerText = "";
    imageError.innerText = "";
    priceError.innerText = "";

    //Validazione Titolo
    if (titleFieldValue.length > 255) {
        errors.title = "Il titolo deve essere lungo massimo 255 caratteri";
        titleError.innerText = errors.title;
    }

    if (titleFieldValue.trim().length < 1) {
        errors.title = "Il titolo è obbligatorio";
        titleError.innerText = errors.title;
    }

    //Validazione Descrizione
    if (descriptionFieldValue.length > 255) {
        errors.description = "la descrizione deve essere lunga massimo 255 caratteri";
        descriptionError.innerText = errors.description;
    }

    //Validazione Url immagine 
    if (imageFieldValue.length != 0) {
        if (!checkImage(imageFieldValue)) {
            errors.image = "l'immagine deve essere un url valido";
            imageError.innerText = errors.image;
        }
    }

    //Validazione Prezzo
    if (priceField.value < 1) {
        errors.price = "Il prezzo è obbligatorio";
        priceError.innerText = errors.price;

    }

    if(!checkDecimalMaxDigits(priceField.value, 2)){
        errors.price = "Il prezzo può avere massimo due numeri decimali";
        priceError.innerText = errors.price;
    }
}

//Campi del form
const validationForm = document.getElementById("validation-form");
const titleField = document.getElementById("title");
const descriptionField = document.getElementById('description');
const imageField = document.getElementById('image');
const priceField = document.getElementById('price');

//Messaggi di errore del form
const titleError = document.getElementById("title-error");
const descriptionError = document.getElementById("description-error");
const imageError = document.getElementById("image-error");
const priceError = document.getElementById("price-error");

let errors = {};
let titleFieldValue = titleField.value;
let descriptionFieldValue = descriptionField.value;
let imageFieldValue = imageField.value;

validationForm.addEventListener("keyup", (e) => {
    e.preventDefault();
    titleFieldValue = titleField.value;
    descriptionFieldValue = descriptionField.value;
    imageFieldValue = imageField.value;

    //Eseguo la funzione di validazione:
    validateForm();

    //Il form viene lanciato:
    if (!Object.keys(errors).length) validationForm.submit();
});
