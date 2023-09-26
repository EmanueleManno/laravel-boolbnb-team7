const deleteForm = document.querySelectorAll('.delete-form');
const modalBody = document.querySelector('.modal-body');
const deleteButton = document.getElementById('deleteButton');

deleteForm.forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();
        const name = form.dataset.title;



        modalBody.innerText = `Sei sicuro di voler eliminare "${name}"`

        deleteButton.addEventListener("click", function () {
            form.submit();
        });
    })
})