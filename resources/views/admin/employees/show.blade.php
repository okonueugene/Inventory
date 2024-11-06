<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">View Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <!-- Name -->
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" value="{{ $employee->name }}" readonly>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" value="{{ $employee->email }}" readonly>
            </div>
            <!-- Department -->
            <div class="mb-3">
                <label class="form-label" for="department">Department</label>
                <input type="text" class="form-control" value="{{ $employee->department }}" readonly>
            </div>
            <!-- Designation -->
            <div class="mb-3">
                <label class="form-label" for="designation">Designation</label>
                <input type="text" class="form-control" value="{{ $employee->designation }}" readonly>
            </div>
            <!-- Location -->
            <div class="mb-3">
                <label class="form-label" for="location">Location</label>
                <input type="text" class="form-control" value="{{ $employee->location }}" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>