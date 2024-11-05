<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ !empty($page_title) ? $page_title : config('app.name') }}</title>

    <meta name="description" content="" />

 <!-- Favicon -->
 <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon_io/favicon.ico') }}" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
 <!-- Select2 -->
 <link rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
     integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
 <!-- Fonts -->
 <link rel="preconnect" href="https://fonts.googleapis.com" />
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
 <link
     href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
     rel="stylesheet" />
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400&display=swap">

 <meta name="csrf-token" content="{{ csrf_token() }}">
 <!-- Icons -->
 <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
 <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
 <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

 <!-- Core CSS -->
 <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
 <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
     class="template-customizer-theme-css" />
 <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

 <!-- Vendors CSS -->
 <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
 <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
 <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
 <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

 <!-- Page CSS -->

 <!-- Helpers -->
 <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
 <script src="{{ asset('assets/js/config.js') }}"></script>

 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

 <!-- DataTables Buttons CSS -->
 <link rel="stylesheet" type="text/css"
     href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

 {{-- Dashboard resources --}}
 <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
 <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
 <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
 <link rel="stylesheet"
     href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
 <link rel="stylesheet"
     href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
 <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}">
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        #search {
            position: relative;
            width: 100%;
            left: 50%;

        }

        p:first-letter {
            text-transform: uppercase;
        }

        .daterangepicker .ranges li.active {
            background-color: #8F3A84;
            color: #fff;
        }

        .daterangepicker td.active,
        .daterangepicker td.active:hover {
            background-color: #8F3A84;
            color: #fff;
        }

        .daterangepicker td.in-range {
            background-color: #FFADF5;
            border-color: transparent;
            color: #000;
            border-radius: 0;
        }

        .daterangepicker td.end-date {
            background-color: #8F3A84;
            color: #fff;
        }

        .daterangepicker .drp-selected {
            display: inline-block;
            font-size: 12px;
            padding-right: 8px;
            color: #8F3A84;
            font-weight: bold;
        }

        .daterangepicker .applyBtn {
            background-color: #8F3A84 !important;
            color: #fff !important;
        }

        .dt-buttons .buttons-csv,
        .dt-buttons .buttons-excel,
        .dt-buttons .buttons-collection,
        .dt-buttons .buttons-pdf,
        .dt-buttons .buttons-print,
        .dt-buttons .buttons-copy {
            background-color: #8F3A84 !important;
            color: #fff !important;
            height: 30px !important;
        }

        .card {
            padding: 10px;
        }

        .filter-card {
            margin-bottom: 20px
        }

        .swal2-cancel {
            margin-top: 0px !important;
        }

        /* notification styles */

        .dropdown-notifications-list {
            max-height: 300px;
            overflow-y: auto;
            position: relative;
        }

        .dropdown-menu {
            width: 350px;
        }

        .avatar-initial {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .dropdown-notifications-item:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }

        .one-notification-link {
            cursor: pointer;
        }
    </style>
</head>
