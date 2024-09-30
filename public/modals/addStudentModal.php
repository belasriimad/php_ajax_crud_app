<!-- Modal -->
<div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add new student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveStudent">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="studentName" class="col-form-label">Name*</label>
                        <input type="text" class="form-control" name="name" required id="studentName"
                            placeholder="Name*">
                    </div>
                    <div class="mb-3">
                        <label for="student_regist_number" class="col-form-label">Registration Number*</label>
                        <input type="number" class="form-control" name="regist_number" required id="student_regist_number"
                            placeholder="Registration Number*">
                    </div>
                    <div class="mb-3">
                        <label for="student_avg" class="col-form-label">Average*</label>
                        <input type="number" class="form-control"
                            step="0.01"
                            name="avg" required id="student_avg"
                            placeholder="Average">
                    </div>
                    <div class="mb-3">
                        <label for="student_move_next" class="col-form-label">Decision*</label>
                        <input type="text" class="form-control"
                            name="move_next" required id="student_move_next"
                            placeholder="Decision*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>