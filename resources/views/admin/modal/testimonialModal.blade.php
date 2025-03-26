<!-- Modal -->
<div class="modal fade" id="testimonialModalPopup" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Testimonial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="testimonialForm" enctype="multipart/form-data">
                    <input type="hidden" class="itemId" id="testimonialId">
                    <input type="hidden" id="formUrl" value="{{ route('testimonials.store') }}">

                    <div class="mb-3">
                        <label>Company Logo</label>
                        <input type="file" id="companyLogo" name="company_logo" class="form-control" accept="image/*" required>
                        <img id="companyLogoPreview" src="" alt="Company Logo" class="mt-2" width="100" style="display: none;">
                    </div>

                    <div class="mb-3">
                        <label>User Logo</label>
                        <input type="file" id="userLogo" name="user_logo" class="form-control" accept="image/*" required>
                        <img id="userLogoPreview" src="" alt="User Logo" class="mt-2" width="100" style="display: none;">
                    </div>

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Position</label>
                        <input type="text" id="position" name="position" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mb-3">Save</button>
                </form>

            </div>
        </div>
    </div>
</div>