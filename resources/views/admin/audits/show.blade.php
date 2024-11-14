<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title"> Show Audit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Asset Name</label>
                <input type="text" class="form-control" value="{{ $audit->asset->name }}" readonly>
            </div>
            <!-- Auditor -->
            <div class="mb-3">
                <label class="form-label">Auditor</label>
                <input type="text" class="form-control" value="{{ $audit->user->name }}" readonly>
            </div>
            <!-- Status -->
            <div class="mb-3">
                <label class="form-label" for="status">Status</label>
                <input type="text" class="form-control" value="{{ $audit->status == 1 ? 'Completed' : 'Pending' }}"
                    readonly>
            </div>
            <!-- Audit Date -->
            <div class="mb-3">
                <label class="form-label" for="done_at">Audit Date</label>
                <input type="text" class="form-control" value="{{ $audit->created_at }}" readonly>
            </div>
            <!-- Remarks -->
            <div class="mb-3">
                <label class="form-label" for="remarks">Remarks</label>
                <textarea class="form-control" readonly>{{ $audit->remarks ?? 'N/A' }}</textarea>
            </div>
            <!-- Condition -->
            <div class="mb-3">
                <label class="form-label" for="condition">Condition</label>
                <textarea class="form-control" readonly>{{ $audit->condition ?? 'N/A' }}</textarea>
            </div>
            <!-- Actions -->
            <div class="mb-3">
                <label class="form-label" for="actions">Actions</label>
                <textarea class="form-control" readonly>{{ $audit->actions ?? 'N/A' }}</textarea>
            </div>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>

