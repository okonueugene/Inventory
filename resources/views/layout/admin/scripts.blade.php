<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var ranges = {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
            'month')],
        'This Year': [moment().startOf('year'), moment().endOf('year')],
        'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
    };

    if ($('#daterange').length > 0) {
        $('#daterange').daterangepicker({
            opens: 'bottom',
            ranges: ranges
        }, function(start, end, label) {
            $('#daterange').trigger('change');
        });
    }

    function __initializePageTable(url, columns, filters = null) {
        _page_table = $('#page_table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: url,
                data: function(d) {
                    d.filters = filters;
                }
            },
            columns: columns,
            createdRow: function(row, data, dataIndex) {}
        });

        return _page_table;

    }


    $(document).on('click', '.delete-record', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                var href = $(this).data('href');

                var data = $(this).serialize();

                $.ajax({

                    method: 'DELETE',

                    url: href,

                    dataType: 'json',

                    data: data,

                    success: function(result) {

                        if (result.success == true) {

                            iziToast.success({
                                title: "Success",
                                message: result.msg,
                                position: "topRight",
                                timeout: 10000,
                                transitionIn: "fadeInDown"
                            });

                            page_table.ajax.reload();

                        } else {
                            iziToast.error({
                                title: "Error",
                                message: result.msg,
                                position: "topRight",
                                timeout: 10000,
                                transitionIn: "fadeInDown"
                            });

                        }

                    },

                });
            }
        });
    });

    $(document).on('click', '.modal-button', function() {
        var actionuRL = $(this).data('href');
        $('#common_modal').load(actionuRL, function() {
            $(this).modal('show');
        });
    });
    $(document).on('click', '.delete-record-accordion', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                var href = $(this).data('href');

                var data = $(this).serialize();

                $.ajax({

                    method: 'DELETE',

                    url: href,

                    dataType: 'json',

                    data: data,

                    success: function(result) {

                        if (result.success == true) {

                            iziToast.success({
                                title: "Success",
                                message: result.msg,
                                position: "topRight",
                                timeout: 10000,
                                transitionIn: "fadeInDown"
                            });

                            //redraw the table
                            $('#accordion_table').DataTable().ajax.reload();

                        } else {
                            iziToast.error({
                                title: "Error",
                                message: result.msg,
                                position: "topRight",
                                timeout: 10000,
                                transitionIn: "fadeInDown"
                            });

                        }

                    },

                });
            }
        });
    });
    $(document).on('submit', ".form", function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var submitButton = form.find('.submit-btn');

        // Replace the text of the submit button with loader
        submitButton.html('<i class="fa fa-spinner fa-spin"></i> Please wait...');
        // Disable submit button
        submitButton.prop('disabled', true);

        // Create a FormData object
        var formData = new FormData(form[0]);

        $.ajax({
            url: url,
            type: method,
            data: formData,
            processData: false, // Required for FormData
            contentType: false, // Required for FormData
            success: function(result) {
                if (result.success == true) {
                    iziToast.success({
                        title: "Success",
                        message: result.msg ? result.msg : result.success,
                        position: "topRight",
                        timeout: 10000,
                        transitionIn: "fadeInDown"
                    });

                    page_table.ajax.reload();
                } else {
                    let errorMessage = "";

                    // If result.errors exists, loop through and display specific errors
                    if (result.errors) {
                        $.each(result.errors, function(key, value) {
                            errorMessage += value[0] +
                            "<br>"; // Appending errors as HTML line breaks
                        });
                    } else {
                        errorMessage = result.msg ? result.msg : "An unknown error occurred.";
                    }

                    iziToast.error({
                        title: "Error",
                        message: errorMessage,
                        position: "topRight",
                        timeout: 10000,
                        transitionIn: "fadeInDown"
                    });
                }

                $('.modal').modal('hide');
                submitButton.prop('disabled', false);
            },
            error: function(xhr, status, error) {
                // Handle error response
                if (xhr.status === 422) { // Validation error from Laravel
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = "";

                    // Loop through and display validation errors
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] +
                        "<br>"; // Appending errors as HTML line breaks
                    });

                    iziToast.error({
                        title: "Validation Error",
                        message: errorMessage,
                        position: "topRight",
                        timeout: 10000,
                        transitionIn: "fadeInDown"
                    });
                } else { // General error
                    var errorMessage = xhr.responseJSON.message ||
                        "Something Went Wrong!, Try again!";

                    iziToast.error({
                        title: "Error",
                        message: errorMessage,
                        position: "topRight",
                        timeout: 10000,
                        transitionIn: "fadeInDown"
                    });
                }
            }
        });

    });
    $(document).ready(function() {
        $('#search_modules').on('keyup', function() {
            var searchTerm = $(this).val().toLowerCase();

            $('.menu-item').each(function() {
                var text = $(this).text().toLowerCase();
                if (text.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $('.one-notification-link').on('click', function() {
            var url = $(this).data('href');
            window.location.href = url;
        });
    });
</script>
