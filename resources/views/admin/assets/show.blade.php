<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title"> Show Asset</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" value="{{ $asset->name }}" readonly>
            </div>
            <!-- Category -->
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" class="form-control" value="{{ $asset->category->name }}" readonly>
            </div>
            <!-- Employee -->
            <div class="mb-3">
                <label class="form-label">Employee</label>
                <input type="text" class="form-control" value="{{ $asset->employee->name ?? 'N/A' }}" readonly>
            </div>

            <!-- Serial No -->
            <div class="mb-3">
                <label class="form-label">Serial No</label>
                <input type="text" class="form-control" value="{{ $asset->serial_no ?? 'N/A' }}" readonly>
            </div>
            <!-- Status -->
            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" class="form-control" value="{{ $asset->status == 1 ? 'Active' : 'Inactive' }}"
                    readonly>
            </div>
            <!-- Purchase Date -->
            <div class="mb-3">
                <label class="form-label">Purchase Date</label>
                <input type="text" class="form-control" value="{{ $asset->purchase_date ?? 'N/A' }}" readonly>
            </div>
            <!-- Warranty Date -->
            <div class="mb-3">
                <label class="form-label">Warranty Date</label>
                <input type="text" class="form-control" value="{{ $asset->warranty_date ?? 'N/A' }}" readonly>
            </div>
            <!-- Description -->
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" readonly>{{ $asset->description ?? 'N/A' }}</textarea>
            </div>
            <!--Decommission Date -->
            <div class="mb-3">
                <label class="form-label">Decommission Date</label>
                <input type="text" class="form-control" value="{{ $asset->decommission_date ?? 'N/A' }}" readonly>
            </div>
            <!-- Added By -->
            <div class="mb-3">
                <label class="form-label">Added By</label>
                <input type="text" class="form-control" value="{{ $asset->user->name }}" readonly>
            </div>
            <!-- Created At -->
            <div class="mb-3">
                <label class="form-label">Created At</label>
                <input type="text" class="form-control" value="{{ $asset->created_at }}" readonly>
            </div>
            <!-- Location -->
            <div class="mb-3">
                <label class="form-label">Location</label>
                <div id="map" style="height: 200px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Initialize the map with a default center
        var map = L.map('map').setView([0, 0], 1);
        
        // Use OpenStreetMap tiles as a fallback
        const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
        const tileUrl = 'http://mt0.google.com/vt/lyrs=y&hl=en&x={x}&y={y}&z={z}&s=Ga';
        const tiles = L.tileLayer(tileUrl, { attribution });
        tiles.addTo(map);

        // Get coordinates from the Blade template
        var lat = @json($asset->latitude);
        var long = @json($asset->longitude);

        // Set map view if coordinates are valid
        if (lat && long) {
            map.setView([lat, long], 13);
            L.marker([lat, long]).addTo(map);
        }

        // Refresh map size when modal is opened
        $('#common_modal').on('shown.bs.modal', function () {
            map.invalidateSize();
        });
    });
</script>

