  var table1 = $('#table-1').DataTable({
       pageLength: 25,
        dom: 'lBfrtip',  
        buttons:[ 
	    {
		extend:    'excelHtml5',
		text:      ' <i class="bi bi-file-excel"></i>',
		titleAttr: 'Export to Excel',
		title: '',
		className: 'btn btn-success',
                messageTop: 'All Logs',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
	    },
	    {
		extend:    'pdfHtml5',
		text:      '<i class="bi bi-file-earmark-pdf"></i> ',
		title: '',
		titleAttr: 'Export to PDF',
                className: 'btn btn-danger',
                messageTop: 'All Logs',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
	     },
	     {
        extend:    'print',
		text:      '<i class="bi bi-printer"></i>',
		titleAttr: 'Print',
		title: '',
		className: 'btn btn-info',
                messageTop: 'All Logs',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
        ],
        "order": [[ 1, "desc" ]],
    });
	table1.buttons().container().appendTo($('#printbar'));
	
	var table2 = $('#table-2').DataTable({
       pageLength: 25,
        dom: 'lBfrtip',  
        buttons:[ 
	    {
		extend:    'excelHtml5',
		text:      ' <i class="bi bi-file-excel"></i>',
		titleAttr: 'Export to Excel',
		title: '',
		className: 'btn btn-success',
                messageTop: 'All Logs',
                exportOptions: {
                    columns: [0, 1, 2, 3,4,5,6,7,8,9]
                }
	    },
	    {
		extend:    'pdfHtml5',
		text:      '<i class="bi bi-file-earmark-pdf"></i> ',
		title: '',
		titleAttr: 'Export to PDF',
                className: 'btn btn-danger',
                messageTop: 'All Logs',
                exportOptions: {
                    columns: [0, 1, 2, 3,4,5,6,7,8,9]
                }
	     },
	     {
        extend:    'print',
		text:      '<i class="bi bi-printer"></i>',
		titleAttr: 'Print',
		title: '',
		className: 'btn btn-info',
                messageTop: 'All Logs',
                exportOptions: {
                    columns: [0, 1, 2, 3,4,5,6,7,8,9]
                }
            },
        ],
        "order": [[ 0, "desc" ]],
    });
	table2.buttons().container().appendTo($('#printbar'));
	
	var table3 = $('#table-3').DataTable({
       pageLength: 25,
        dom: 'lBfrtip',  
        buttons:[ 
	    {
		extend:    'excelHtml5',
		text:      ' <i class="bi bi-file-excel"></i>',
		titleAttr: 'Export to Excel',
		title: '',
		className: 'btn btn-success',
                messageTop: 'All Logs',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
                }
	    },
	    {
		extend:    'pdfHtml5',
		text:      '<i class="bi bi-file-earmark-pdf"></i> ',
		title: '',
		titleAttr: 'Export to PDF',
                className: 'btn btn-danger',
                messageTop: 'All Logs',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
                }
	     },
	     {
        extend:    'print',
		text:      '<i class="bi bi-printer"></i>',
		titleAttr: 'Print',
		title: '',
		className: 'btn btn-info',
                messageTop: 'All Logs',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
                }
            },
        ],
        "order": [[ 0, "desc" ]],
    });
	table3.buttons().container().appendTo($('#printbar'));

	var table4 = $('#table-4').DataTable({
       pageLength: 25,
        dom: 'lBfrtip',  
        buttons:[ 
	    {
		extend:    'excelHtml5',
		text:      ' <i class="bi bi-file-excel"></i>',
		titleAttr: 'Export to Excel',
		title: '',
		className: 'btn btn-success',
                messageTop: 'All Logs',
                exportOptions: {
					stripHtml: true,
                    columns: [0, 1, 2,5]
                }
	    },
	    {
		extend:    'pdfHtml5',
		text:      '<i class="bi bi-file-earmark-pdf"></i> ',
		title: '',
		titleAttr: 'Export to PDF',
                className: 'btn btn-danger',
                messageTop: 'All Logs',
                exportOptions: {
					stripHtml: true,
                    columns: [0, 1, 2,5]
                }
	     },
	     {
        extend:    'print',
		text:      '<i class="bi bi-printer"></i>',
		titleAttr: 'Print',
		title: '',
		className: 'btn btn-info',
                messageTop: 'All Logs',
                exportOptions: {
					stripHtml: false,
                    columns: [0, 1, 2,5]
                }
            },
        ],
        "order": [[ 1, "desc" ]],
    });
	table4.buttons().container().appendTo($('#printbar'));
	
	$('.datatable').DataTable();