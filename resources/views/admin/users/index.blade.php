@extends('layout.admin.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="add-button">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm  float-end mx-2 modal-button mt-2"
                data-href="{{ url('/admin/users/create') }}">
                Add User
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
            var url = "/admin/users";
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
                    data: 'action',
                    name: 'action',
                    className: 'text-center',
                    searchable: false
                }
            ];

            //initialize the filters as null in an object
            var filters = {
                country: null,
                status: null
            };

            //initialize the datatable

            var page_table = __initializePageTable(url, columns, filters);
        });
    </script>
@endsection
