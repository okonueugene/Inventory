@extends('layout.admin.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>{{ $page_title }}</h4>
        <div class="card">
            <div class="table">
                <table class="table table-hover table-bordered" width="100%" id="page_table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Asset Name</th>
                            <th>Auditor</th>
                            <th>Status</th>
                            <th>Audit Date</th>
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
            var url = "/admin/audits";
            var columns = [{
                    data: 'serial_no',
                    name: 'serial_no',
                    className: 'text-center',
                    searchable: false
                },
                {
                    data: 'asset',
                    name: 'asset'
                },
                {
                    data: 'auditor',
                    name: 'auditor'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'done_at',
                    name: 'done_at'
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
