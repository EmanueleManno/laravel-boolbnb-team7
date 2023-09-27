function checkImage(url) {
    return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}

function validateForm() {
    errors = {};
    titleError.innerText = "";
    descriptionError.innerText = "";
    imageError.innerText = "";

    //Validazione Titolo
    if (titleFieldValue.length > 255) { //255
        errors.title = "Il nome deve essere lungo massimo 255 caratteri";
        titleError.innerText = errors.title;
    }

    //Validazione Descrizione
    if (descriptionFieldValue.length > 255) {
        errors.description = "la descrizione deve essere lunga massimo 255 caratteri";
        descriptionError.innerText = errors.description;
    }

    //Validazione Url immagine 
    if (!checkImage(imageFieldValue)) {
        errors.image = "l'immagine deve essere un url valido";
        imageError.innerText = errors.image;
    }
}

//Campi del form
const validationForm = document.getElementById("validation-form");
const titleField = document.getElementById("title");
const descriptionField = document.getElementById('description');
const imageField = document.getElementById('image');

//Messaggi di errore del form
const titleError = document.getElementById("title-error");
const descriptionError = document.getElementById("description-error");
const imageError = document.getElementById("image-error");

let errors = {};
let titleFieldValue = titleField.value;
let descriptionFieldValue = descriptionField.value;
let imageFieldValue = imageField.value;

validationForm.addEventListener("submit", (e) => {
    e.preventDefault();
    titleFieldValue = titleField.value;
    descriptionFieldValue = descriptionField.value;
    imageFieldValue = imageField.value;

    //Eseguo la funzione di validazione:
    validateForm();

    //Il form viene lanciato:
    if (!Object.keys(errors).length) validationForm.submit();
});
