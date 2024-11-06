@extends('layout.admin.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="add-button">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm  float-end mx-2 modal-button mt-2"
                data-href="{{ url('/admin/assets/create') }}">
                Add 
            </a>
        </div>
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>{{ $page_title }}</h4>
        <div class="card filter-card">
            <div class="row">
                <div class="col-sm-12">
                    <h5>Filters</h5>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Status</label>
                            <select class="form-control" id="status">
                                <option value="">All</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="table">
                <table class="table table-hover table-bordered" width="100%" id="page_table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Serial No</th>
                            <th>Status</th>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            var url = "/admin/assets";
            var columns = [{
                    data: 'serial_no',
                    name: 'serial_no',
                    className: 'text-center',
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name',
                    className: 'text-center'
                },

                {
                    data: 'category',
                    name: 'category',
                    className: 'text-center'
                },
                {
                    data: 'serial_number',
                    name: 'serial_number',
                    className: 'text-center'
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
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
