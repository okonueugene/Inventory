<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template">
@include('layout.staff.header')

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('layout.admin.site.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('layout.admin.site.navbar')

                {{-- Main Body --}}
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                                <div>
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    Metaspace Technologies Limited. All rights reserved.
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="footer-link me-4" target="_blank">License</a>

                                    <a href="javascript:void(0);" target="_blank"
                                        class="footer-link me-4">Documentation</a>

                                    <a href="javascript:void(0);" target="_blank"
                                        class="footer-link d-none d-sm-inline-block">Support</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade">
                    </div>
                </div>
                <!-- Content wrapper -->

                <div class="modal fade" id="common_modal" tabindex="-1" aria-labelledby="commonModalExample"
                    aria-hidden="true">
                    
                </div>
                @yield('modals')


            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>

    @include('layout.staff.footer')

    @include('layout.staff.scripts')

    @yield('javascript')

</body>

</html>
