<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">Edit Asset</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <form action="{{ url('/admin/assets/' . $asset->id) }}" method="POST" class="form">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Asset Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $asset->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="code" class="form-label">Asset Code</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $asset->code }}" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $asset->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="employee" class="form-label">Employee</label>
                    <select class="form-select" id="employee" name="employee" required>
                        <option value="">Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ $asset->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $asset->description ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="serial_number" class="form-label">Serial Number</label>
                    <input type="text" class="form-control" id="serial_number" name="serial_number"
                        value="{{ $asset->serial_number ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="purchase_date" class="form-label">Purchase Date</label>
                    <input type="date" class="form-control" id="purchase_date" name="purchase_date"
                        value="{{ $asset->purchase_date ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="warranty_date" class="form-label">Warranty Date</label>
                    <input type="date" class="form-control" id="warranty_date" name="warranty_date"
                        value="{{ $asset->warranty_date ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="decommission_date" class="form-label" id="decommission_date">Decommission Date</label>
                    <input type="date" class="form-control" id="decommission_date" name="decommission_date"
                        value="{{ $asset->decommission_date ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="1" {{ $asset->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $asset->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
