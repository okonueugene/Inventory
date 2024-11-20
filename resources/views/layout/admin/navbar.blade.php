<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-xxl">
        <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
            <a href="{{ url('/admin/dashboard') }}" class="app-brand-logo demo">
                <span class="app-brand-logo demo">
                    <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Brand Logo" class="logo-icon me-2"
                        width="80" height="80" />
                </span>
            </a>
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                <i class="ti ti-x ti-sm align-middle"></i>
            </a>
        </div>

        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Search -->
                <li class="nav-item navbar-search-wrapper me-2 me-xl-0">
                    <input type="text" class="form-control search-input container-xxl border-0"
                        placeholder="Search modules..." aria-label="Search modules..." id="search_modules" />
                </li>
                <!-- /Search -->

                <!-- Quick links  -->
                <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                        data-bs-auto-close="outside" aria-expanded="false">
                        <i class="ti ti-layout-grid-add ti-md"></i>
                    </a>
                    {{-- dashboard,sites,reports,configuration,user-management --}}
                    <div class="dropdown-menu dropdown-menu-end py-0">
                        <div class="dropdown-menu-header border-bottom">
                            <div class="dropdown-header d-flex align-items-center py-3">
                                <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                                <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Add shortcuts"><i
                                        class="ti ti-sm ti-apps"></i></a>
                            </div>
                        </div>
{{-- 
                Route::resource('/categories', 'Admin\CategoryController');
                Route::resource('/employees', 'Admin\EmployeesController');
                Route::resource('/assets', 'Admin\AssetController');
                Route::resource('/audits', 'Admin\AuditsController');
                Route::resource('/users', 'Admin\UserController'); --}}
                        <div class="dropdown-shortcuts-list scrollable-container">
                            <div class="row row-bordered overflow-visible g-0">
                                <div class="dropdown-shortcuts-item col">
                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                        <i class="ti ti-dashboard fs-4"></i>
                                    </span>
                                    <a href="{{ url('/admin/dashboard') }}" class="stretched-link">Dashboard</a>
                                    <small class="text-muted mb-0">Dashboard</small>
                                </div>
                                <div class="dropdown-shortcuts-item col">
                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                        <i class="ti ti-server fs-4"></i>
                                    </span>
                                    <a href="{{ url('/admin/assets') }}" class="stretched-link">Assets</a>
                                    <small class="text-muted mb-0">Assets</small>
                                </div>
                            </div>
                            <div class="row row-bordered overflow-visible g-0">
                                <div class="dropdown-shortcuts-item col">
                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                        <i class="ti ti-file fs-4"></i>
                                    </span>
                                    <a href="{{ url('/admin/audits') }}" class="stretched-link">Audit Logs</a>
                                    <small class="text-muted mb-0">Audit Logs</small>
                                </div>
                                <div class="dropdown-shortcuts-item col">
                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                        <i class="ti ti-users fs-4"></i>
                                    </span>
                                    <a href="{{ url('/admin/employees') }}" class="stretched-link">Employees</a>
                                    <small class="text-muted mb-0">Employees</small>
                                </div>
                            </div>
                            <div class="row row-bordered overflow-visible g-0">
                                <div class="dropdown-shortcuts-item col">
                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                        <i class="ti ti-user fs-4"></i>
                                    </span>
                                    <a href="{{ url('/admin/users') }}" class="stretched-link">User
                                        Management</a>
                                    <small class="text-muted mb-0">User Management</small>
                                </div>
                                <div class="dropdown-shortcuts-item col">
                                    <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                                        <i class="ti ti-list fs-4"></i>
                                    </span>
                                    <a href="{{ url('/admin/categories') }}"
                                        class="stretched-link">Categories</a>
                                    <small class="text-muted mb-0">Categories</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- Quick links -->

                <!-- Notification -->
                @include('layout.admin.notifications')
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            @if (Auth::user()->getMedia('avatars')->first())
                                <img src="{{ asset('storage/' . Auth::user()->getMedia('avatars')->first()->id . '/' . Auth::user()->getMedia('avatars')->first()->file_name) }}"
                                    alt class="h-auto rounded-circle" />
                            @else
                                <img src="{{ asset('assets/img/avatars/noimg.png') }}" alt
                                    class="h-auto rounded-circle" />
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('assets/img/avatars/noimg.png') }}" alt
                                                class="h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span
                                            class="fw-semibold d-block">{{ auth()->user() ? auth()->user()->name : null }}</span>
                                        <small
                                            class="text-muted">{{ auth()->user() ? auth()->user()->user_type : null }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="ti ti-user-check me-2 ti-sm"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>

                        {{-- <li>
                          <a class="dropdown-item" href="pages-account-settings-account.html">
                              <i class="ti ti-settings me-2 ti-sm"></i>
                              <span class="align-middle">Settings</span>
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="pages-account-settings-billing.html">
                              <span class="d-flex align-items-center align-middle">
                                  <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                                  <span class="flex-grow-1 align-middle">Billing</span>
                                  <span
                                      class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20">2</span>
                              </span>
                          </a>
                      </li>
                      <li>
                          <div class="dropdown-divider"></div>
                      </li>
                      <li>
                          <a class="dropdown-item" href="pages-help-center-landing.html">
                              <i class="ti ti-lifebuoy me-2 ti-sm"></i>
                              <span class="align-middle">Help</span>
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="pages-faq.html">
                              <i class="ti ti-help me-2 ti-sm"></i>
                              <span class="align-middle">FAQ</span>
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="pages-pricing.html">
                              <i class="ti ti-currency-dollar me-2 ti-sm"></i>
                              <span class="align-middle">Pricing</span>
                          </a>
                      </li> --}}
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="ti ti-logout me-2 ti-sm"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>

        <!-- Search Small Screens -->
        <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
            <input type="text" class="form-control search-input border-0" placeholder="Search..."
                aria-label="Search..." />
            <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
        </div>
    </div>
    @if (session('error'))
        <script>
            iziToast.error({
                title: 'Error',
                message: '{{ session('error') }}',
                position: 'topRight'
            });
        </script>
    @endif
</nav>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
