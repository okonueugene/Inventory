@extends('layout.admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="#" class="btn btn-primary btn-sm float-end mx-2" id="generate-report" disabled>
        Generate
        Report</a>
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>{{ $page_title }}</h4>
    {{-- <div class="card filter-card">
        <div class="row">
            <div class="col-sm-12">
                <h5>Filters</h5>
                <div class="row">
                    <div class="col-sm-3 form-group">
                        <label for="site">Scope <span class="text-danger">*</span></label>
                        <select class="form-select" id="site" name="site" required>
                            <option value="" selected>Self</option>
                            <option value="{{ auth()->user()->site_id }}">{{ auth()->user()->site->name }}</option>
                        </select>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Date Range <span class="text-danger">*</span></label>
                            <input type="text" readonly id="daterange" class="form-control"
                                value="{{ Carbon\Carbon::now()->startOfWeek()->format('m/d/Y') }} - {{ Carbon\Carbon::now()->endOfWeek()->format('m/d/Y') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="card">
        <p id="notice" class="text-center text-warning mt-3">Please select report scope and date range to generate report
        </p>
    </div>
    <div id="loading" class="spinner-border text-info" role="status"
        style="position:absolute;left:50%;top:25%;z-index:1000;display:none">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
@endsection
{{-- @section('javascript')
<script>
    $(document).ready(function() {
        // Initialize the filters object
        var filters = {
            site_id: $('#site').val(),
            startDate: $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD'),
            endDate: $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD')
        };

        // Listen for changes in the date range picker
        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            // Update the filters object with the selected date range
            filters.startDate = picker.startDate.format('YYYY-MM-DD');
            filters.endDate = picker.endDate.format('YYYY-MM-DD');
        });

        // Listen for changes in the site select
        $('#site').on('change', function() {
            // Update the filters object with the selected site
            filters.site_id = $(this).val();
        });


        // On click of the generate report button
        $('#generate-report').on('click', function(e) {
            e.preventDefault();

            var project_name = prompt("Please enter project name", "");
            var safety_supervisor = prompt("Please enter safety supervisor", "");

            // Check if the user entered a project name
            if (project_name == null || project_name == "") {
                alert("Project name must be filled out");
                return false;
            }
            // Check if the user entered a safety supervisor
            if (safety_supervisor == null || safety_supervisor == "") {
                alert("Safety supervisor must be filled out");
                return false;
            }

            // Update the filters object with the latest values
            filters.project_name = project_name;
            filters.safety_supervisor = safety_supervisor;

            // Log the filters object to the console (optional)
            console.log(JSON.stringify(filters));

            // Show the loading spinner
            $('#loading').show();

            // Make an Axios POST request to the server with the filters
            axios.post("{{ route('reports.filter') }}", filters, {
                    responseType: 'blob' // This is important for file download
                })
                .then((response) => {
                    // Create a blob from the response data
                    const blob = new Blob([response.data], {
                        type: 'application/pdf'
                    });
                    const url = window.URL.createObjectURL(blob);

                    // Create a link element to initiate the download
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'Site-Report ' + filters.project_name + '.pdf');

                    // Append the link to the document and click it to start the download
                    document.body.appendChild(link);
                    link.click();

                    // Clean up
                    link.remove();
                    window.URL.revokeObjectURL(url);

                    // Hide the loading spinner
                    $('#loading').hide();

                    // Show a success message
                    iziToast.success({
                        title: 'Success',
                        message: 'Report generated successfully',
                        position: 'topRight',
                        timeout: 10000,
                        transitionIn: 'fadeInDown'
                    });
                })
                .catch((error) => {
                    console.error('Error generating report:', error);
                });
        });
    });
</script>
@endsection --}}
