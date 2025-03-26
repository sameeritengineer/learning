<!-- Past Work Modal -->
<div class="modal fade" id="pastWorkModalPopup" tabindex="-1" aria-labelledby="pastWorkModalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pastWorkModalLabel">Past Work</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="pastWorkForm" enctype="multipart/form-data">
                    <input type="hidden" class="itemId" id="pastWorkId">
                    <input type="hidden" id="pastWorkFormUrl" value="{{ route('pastwork.store') }}">

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" id="pastWorkTitle" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea id="pastWorkDescription" name="description" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Company Logo</label>
                        <input type="file" id="pastWorkCompanyLogo" name="company_logo" class="form-control" accept="image/*" required>
                        <img id="pastWorkCompanyLogoPreview" src="" alt="Company Logo" class="mt-2" width="100" style="display: none;">
                    </div>

                    <div class="mb-3">
                        <label>User Logo</label>
                        <input type="file" id="pastWorkUserLogo" name="user_logo" class="form-control" accept="image/*" required>
                        <img id="pastWorkUserLogoPreview" src="" alt="User Logo" class="mt-2" width="100" style="display: none;">
                    </div>

                    <button type="submit" class="btn btn-primary mb-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
