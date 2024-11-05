@extends('layout.admin.app')
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title fw-bolder">Dashboard</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title fw-bolder">Total Assets</h5>
                                                <h3 class="card-text">100</h3>
                                            </div>
                                            <div class="card-icon">
                                                <i class="ti ti-layout-grid2"></i>
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
                                                <h3 class="card-text">100</h3>
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
                                                <h3 class="card-text">100</h3>
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
                                                <h3 class="card-text">100</h3>
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
                        <h3 class="card-title fw-bolder">Recent Assets</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-vcenter mb-0 table_custom">
                                <thead>
                                    <tr>
                                        <th>Asset Name</th>
                                        <th>Category</th>
                                        <th>Employee</th>
                                        <th>Location</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Asset 1</td>
                                        <td>Category 1</td>
                                        <td>Employee 1</td>
                                        <td>Location 1</td>
                                        <td>2021-09-01</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-record"
                                                data-href="javascript:void(0)">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Asset 2</td>
                                        <td>Category 2</td>
                                        <td>Employee 2</td>
                                        <td>Location 2</td>
                                        <td>2021-09-01</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-record"
                                                data-href="javascript:void(0)">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Asset 3</td>
                                        <td>Category 3</td>
                                        <td>Employee 3</td>
                                        <td>Location 3</td>
                                        <td>2021-09-01</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-record"
                                                data-href="javascript:void(0)">Delete</a>
                                        </td>
                                    </tr>
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
