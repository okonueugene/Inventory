dom: '<"top"lfB>rt<"bottom"ip><"clear">',
buttons: [
    {
        extend: 'copyHtml5',
        text: '<i class="fa fa-copy"></i> Copy',
        className: 'btn btn-sm btn-default',
        exportOptions: {
            columns: function ( idx, data, node ) {
                return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                    true : false;
            } 
        }
    },
    {
        extend: 'excelHtml5',
        text: '<i class="fa fa-file-excel-o"></i> Excel',
        className: 'btn btn-sm btn-default',
        exportOptions: {
            columns: function ( idx, data, node ) {
                return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                    true : false;
            } 
        }
    },
    {
        extend: 'csvHtml5',
        text: '<i class="fa fa-file"></i> CSV',
        className: 'btn btn-sm btn-default',
        exportOptions: {
            columns: function ( idx, data, node ) {
                return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                    true : false;
            } 
        }
    },
    {
        extend: 'pdfHtml5',  // Add PDF option
        orientation: 'landscape',
        pageSize: 'LEGAL',
        text: '<i class="fa fa-file-pdf-o"></i> PDF',
        className: 'btn btn-sm btn-default',
        exportOptions: {
            columns: function ( idx, data, node ) {
                return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                    true : false;
            } 
        },
        unescapeHtml: true
    },
    {
        extend: 'print',  // Add Print option
        text: '<i class="fa fa-print"></i> Print',
        className: 'btn btn-sm btn-default',
        exportOptions: {
            columns: function ( idx, data, node ) {
                return $(node).is(":visible") && !$(node).hasClass('notexport') ?
                    true : false;
            } 
        }
    }
],

"pageLength": 25 ,
