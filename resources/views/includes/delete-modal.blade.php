<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 me-2">Eliminazione</h1>
                <div class="dropdown">
                    <button class="button-info" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-question fa-xs"></i>
                    </button>
                    <div class="dropdown-menu text-danger  ">
                        L'elemento verrà spostato nel cestino dal quale
                        potrai sempre ripristinarlo
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare questo boolbnb?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non eliminare</button>
                <button type="button" class="btn btn-danger" id="deleteButton">Elimina</button>
            </div>
        </div>
    </div>
</div>
