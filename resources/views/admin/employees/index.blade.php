@extends('layout.admin.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="add-button">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm  float-end mx-2 modal-button mt-2"
                data-href="{{ url('/admin/employees/create') }}">
                Add Employee
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
    </script>
@endsection
