@extends('layout.admin.app')
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> </span>{{ $page_title }}</h4>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card"> 
                         {{-- //Total Assets
                    $data['total_assets'] = Asset::count() ?? 0;
                    //Total Employees
                    $data['total_employees'] = Employee::count() ?? 0;
                    //Total Categories
                    $data['total_categories'] = Category::count() ?? 0;
                    //Total Audit Logs
                    $data['total_audit_logs'] = Audit::count() ?? 0;
            
                    $page_title = 'Dashboard'; --}}

                    <div class="card-header">
                        <h5 class="card-title fw-bolder">Summary Report</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title fw-bolder">Total Assets</h5>
                                                <h6 class="card-text">{{ $data['total_assets'] }}</h6>
                                            </div>
                                            <div class="card-icon">
                                                <i class="ti ti-layout-sidebar text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title fw-bolder">Total Employees</h5>
                                                <h6 class="card-text">{{ $data['total_employees'] }}</h6>
                                            </div>
                                            <div class="card-icon">
                                                <i class="ti ti-user text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title fw-bolder">Total Categories</h5>
                                                <h6 class="card-text">{{ $data['total_categories'] }}</h6>
                                            </div>
                                            <div class="card-icon">
                                                <i class="ti ti-list text-danger"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title fw-bolder">Total Reports</h5>
                                                <h6 class="card-text">{{ $data['total_audit_logs'] }}</h6>
                                            </div>
                                            <div class="card-icon">
                                                <i class="ti ti-receipt text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 pt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-bolder">Recent Assets</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-vcenter mb-0 table_custom" width="100%" id="dashboard_table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Asset Name</th>
                                        <th>Category</th>
                                        <th>Employee</th>
                                        <th>Status</th>
                                        <th>Added</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content -->
@endsection
@section('javascript')
<script>
    $(document).ready(function() {
        var url = "{{ route('get-latest-assets') }}";
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
                data: 'employee',
                name: 'employee',
                className: 'text-center'
            },
            {
                data: 'status',
                name: 'status',
                className: 'text-center'
            },
            {
                data: 'created_at',
                name: 'created_at',
                className: 'text-center',
                orderable: false,
                searchable: false
            }
        ];

        //initialize the datatable
        var table = $('#dashboard_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: columns,
            order: [
                [5, 'desc']
            ],
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 75, 100],

        });
    });

</script>
@endsection