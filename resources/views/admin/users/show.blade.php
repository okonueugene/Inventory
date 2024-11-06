<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">View User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <!-- Name -->
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
            </div>
            <!-- Role -->
            <div class="mb-3">
                <label class="form-label" for="role">Role</label>
                <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>