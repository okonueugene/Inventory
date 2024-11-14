<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">Edit Audit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <form action="{{ url('/admin/audits/' . $audit->id) }}" method="POST" class="form">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="condition" class="form-label">Condition</label>
                    <textarea class="form-control" id="condition" name="condition">{{ $audit->condition ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="actions" class="form-label">Actions</label>
                    <textarea class="form-control" id="actions" name="actions">{{ $audit->actions ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control" id="remarks" name="remarks">{{ $audit->remarks ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="1" {{ $audit->status == 1 ? 'selected' : '' }}>Completed</option>
                        <option value="0" {{ $audit->status == 0 ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="done_at" class="form-label">Audit Date</label>
                    <input type="date" class="form-control" id="done_at" name="done_at"
                        value="{{ $audit->done_at ?? '' }}">
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
