<!-- Modal -->
<div class="modal fade" id="domainModalPopup" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Operated Domain</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="operatedDomainForm" enctype="multipart/form-data">
                <input type="hidden" class="itemId" id="domainId">
                <input type="hidden" id="formUrl" value="{{ route('operated_domains.store') }}">

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" id="operatedDomainTitle" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea id="operatedDomainDescription" name="description" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label>Logos</label>
                    <input type="file" id="logos" name="logos[]" class="form-control" accept="image/*" multiple required>
                    <div id="operatedDomainLogoPreviews"></div>
                </div>

                <button type="submit" class="btn btn-primary mb-3">Save</button>
            </form>

            </div>
        </div>
    </div>
</div>