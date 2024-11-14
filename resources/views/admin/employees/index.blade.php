@extends('layout.admin.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="add-button">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm  float-end mx-2 modal-button mt-2"
                data-href="{{ url('/admin/employees/create') }}">
                Add Employee
            </a>
            <a href="javascript:void(0)" class="btn btn-primary btn-sm  float-end modal-button mt-2"
                class="btn btn-icon icon-left btn-info float-end" onclick="importEmployees()">
                <i class="fas fa-file-import"></i> Import Employees
            </a>
        </div>


        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>{{ $page_title }}</h4>
        <div class="card">
            <div class="table">
                <table class="table table-hover table-bordered" width="100%" id="page_table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleexportCasualModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleexportCasualModal">Import Employees</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import-employees') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">

                            <input type="file" name="file" accept=".xlsx, .xls">
                        </div>
                        <div class="mb-3">
                            <button type="submit">Upload</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            var url = "/admin/employees";
            var columns = [{
                    data: 'serial_no',
                    name: 'serial_no',
                    className: 'text-center',
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'department',
                    name: 'department'
                },
                {
                    data: 'designation',
                    name: 'designation'
                },
                {
                    data: 'location',
                    name: 'location'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                }
            ];


            //initialize the filters as null in an object
            var filters = {
                country: null,
                status: null
            };

            //initialize the page table
            var page_table = __initializePageTable(url, columns, filters);

        });

        function importEmployees() {
            Swal.fire({
                title: 'Import Employees',
                text: "Do you want to download a sample file first?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create a link to initiate the download without using the download attribute
                    window.location.href = "{{ route('export-employees') }}";

                    Swal.fire(
                        'Success!',
                        'Sample file downloaded successfully',
                        'success'
                    );
                } else {
                    // If the user does not want to download the sample file, open the import modal
                    $('#importModal').modal('show');
                }
            });
        }
    </script>
@endsection
