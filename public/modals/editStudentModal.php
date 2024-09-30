<!-- Modal -->
<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateStudent">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="student_id" id="student_id">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Name*</label>
                        <input type="text" class="form-control" name="name" required id="name"
                            placeholder="Name*">
                    </div>
                    <div class="mb-3">
                        <label for="regist_number" class="col-form-label">Registration Number*</label>
                        <input type="number" class="form-control" name="regist_number" required 
                            id="regist_number"
                            placeholder="Registration Number*">
                    </div>
                    <div class="mb-3">
                        <label for="avg" class="col-form-label">Average*</label>
                        <input type="number" class="form-control"
                            step="0.01"
                            name="avg" required id="avg"
                            placeholder="Average">
                    </div>
                    <div class="mb-3">
                        <label for="move_next" class="col-form-label">Decision*</label>
                        <input type="text" class="form-control"
                            name="move_next" required id="move_next"
                            placeholder="Decision*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>