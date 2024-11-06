<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title"> Add Asset</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
            <form action="{{ url('/admin/assets') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Asset Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="code" class="form-label">Asset Code</label>
                    <input type="text" class="form-control" id="code" name="code" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="employee" class="form-label">Employee</label>
                    <select class="form-select" id="employee" name="employee" required>
                        <option value="">Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="serial_number" class="form-label">Serial Number</label>
                    <input type="text" class="form-control" id="serial_number" name="serial_number">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="purchase_date" class="form-label" id="purchase_date">Purchase Date</label>
                    <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
                </div>
                <div class="mb-3">
                    <label for="warranty_date" class="form-label" id="warranty_date">Warranty Date</label>
                    <input type="date" class="form-control" id="warranty_date" name="warranty_date" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <div id="map" style="height: 300px;"></div>
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Initialize the map
        var map = L.map('map').setView([0, 0], 2); // Default to zoomed-out view

        // Add OpenStreetMap tiles
        const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
        const tileUrl = 'http://mt0.google.com/vt/lyrs=y&hl=en&x={x}&y={y}&z={z}&s=Ga';
        const tiles = L.tileLayer(tileUrl, { attribution });
        tiles.addTo(map);

        // Marker variable for location selection
        var marker;

        // Try to get the user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                // Set the map view to the user's location and add a marker
                map.setView([lat, lng], 15);

                marker = L.marker([lat, lng], {
                        draggable: true
                    }).addTo(map)
                    .bindPopup("Drag to adjust location")
                    .openPopup();

                // Set initial values of latitude and longitude inputs
                $('#latitude').val(lat);
                $('#longitude').val(lng);

                // Update hidden inputs when the marker is dragged
                marker.on('dragend', function(e) {
                    var position = marker.getLatLng();
                    $('#latitude').val(position.lat);
                    $('#longitude').val(position.lng);
                });
            });
        }

        // Update marker and hidden inputs on map click
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng], {
                    draggable: true
                }).addTo(map);
            }

            // Update latitude and longitude inputs
            $('#latitude').val(lat);
            $('#longitude').val(lng);

            // Update hidden inputs when the marker is dragged
            marker.on('dragend', function(e) {
                var position = marker.getLatLng();
                $('#latitude').val(position.lat);
                $('#longitude').val(position.lng);
            });
        });
        // Refresh map size when modal is opened
        $('#common_modal').on('shown.bs.modal', function() {
            map.invalidateSize();
        });
    });
</script>
