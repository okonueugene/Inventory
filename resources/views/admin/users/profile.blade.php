@extends('layout.admin.app')
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            Profile
        </h4>

        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="../../assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto position-relative">
                            @if($user->hasMedia('avatars'))
                                <img src="{{ asset('storage/' . Auth::user()->getMedia('avatars')->first()->id . '/' . Auth::user()->getMedia('avatars')->first()->file_name) }}"
                                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="95" height="100"
                                alt="User Profile Image" id="profile-image" />                            @else
                            <img src="../../assets/img/avatars/noimg.png" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img"
                                width="95" height="100" alt="User Profile Image" id="profile-image" />
                            @endif
                            <!-- Edit Icon -->
                            <button class="btn btn-sm btn-light position-absolute bottom-0 end-0" id="edit-profile-btn"
                                title="Edit Profile Picture">
                                <i class="ti ti-pencil"></i>
                            </button>

                            <!-- Hidden File Input -->
                            <input type="file" id="profile-image-input" accept="image/*" class="d-none" name="avatar" />
                        </div>
                        <!-- Add this HTML for the spinner inside your container -->
                        <div id="spinner" style="display: none;">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4>{{ $user->name }}</h4>
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item"><i class="ti ti-color-swatch"></i>
                                            {{ucfirst($user->role) }}</li>
                                        <li class="list-inline-item">
                                            <i class="ti ti-map-pin"></i>
                                            @php
                                                $location = $user->site->location ?? 'N/A';
                                                $parts = explode(',', $location);
                                                $displayLocation = implode(',', array_slice($parts, 0, 2));
                                            @endphp
                                            {{ $displayLocation }}
                                        </li>
                                    </ul>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-primary">
                                    <i class="ti ti-user-check me-1"></i>Connected
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->

        <!-- Navbar pills -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-user-check me-1"></i>
                            Profile</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--/ Navbar pills -->

        <!-- User Profile Content -->
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- About User -->
                <div class="card mb-4">
                    <div class="card-body">
                        <small class="card-text text-uppercase">About</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-user"></i><span class="fw-bold mx-2">Full Name:</span>
                                <span>{{ $user->name }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-check"></i><span class="fw-bold mx-2">Status:</span> <span>Active</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-crown"></i><span class="fw-bold mx-2">Role:</span>
                                <span>{{ucfirst($user->role) }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-flag"></i><span class="fw-bold mx-2">Country:</span>
                                <span>{{ $user->country->name  ?? 'N/A' }}</span>
                            </li>
                        </ul>
                        <small class="card-text text-uppercase">Contacts</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Contact:</span>
                                <span>{{ $user->contact ?? 'N/A' }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-mail"></i><span class="fw-bold mx-2">Email:</span>
                                <span>{{ $user->email }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/ About User -->

            </div>
        
                <!-- No activity found display message and match the height of the other column -->
                <div class="col-xl-8 col-lg-7 col-md-7 d-flex">
                    <div class="card card-action mb-4 flex-fill d-flex align-items-center justify-content-center">
                        <div class="card-header align-items-center">
                            <h5 class="card-action-title mb-0">Activity Timeline</h5>
                        </div>
                        <div class="card-body pb-0 text-center d-flex align-items-center justify-content-center">
                            <p class="text-muted">Oops looks like there is no activity for this user yet.</p>
                        </div>
                    </div>
                </div>
            <!--/ User Profile Content -->
        </div>
    </div>
    <!-- / Content -->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-profile.css" />
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>

    <script>
        document.getElementById('edit-profile-btn').addEventListener('click', function() {
            document.getElementById('profile-image-input').click();
        });

        document.getElementById('profile-image-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            console.log(file);

            // Show the spinner
            document.getElementById('spinner').style.display = 'block';

            // Prepare form data
            const formData = new FormData();
            formData.append('avatar', file);
            formData.append('_method', 'PUT'); // Trick to make Laravel treat it as a PUT request
            formData.append('_token', '{{ csrf_token() }}'); // Add the CSRF token if required

            const url = '{{ url('/admin/users', $user->id) }}';

            // Use Ajax to upload the file
            axios.post(url, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    // Hide the spinner
                    document.getElementById('spinner').style.display = 'none';

                    if (response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.data.msg,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.data.msg,
                        });
                    }
                })
                .catch(error => {
                    // Hide the spinner
                    document.getElementById('spinner').style.display = 'none';

                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again later.',
                    });
                });
        });
    </script>
@endsection
