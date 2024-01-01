//[Data Table Javascript]

//Project:	Florence Admin - Responsive Admin Template
//Primary use:   Used only for the Data Table

$(function () {
    "use strict";

    // $('#example1').DataTable();
    // $('#example2').DataTable({
     //  'paging'      : true,
     //  'lengthChange': false,
     //  'searching'   : false,
     //  'ordering'    : true,
     //  'info'        : true,
     //  'autoWidth'   : false
    // });
	//
	//
// 	$('#example').DataTable( {
// 		dom: 'Bfrtip',
// 		buttons: [
// 			'copy', 'csv', 'excel', 'pdf', 'print'
// 		]
// 	} );
	//
	// $('#tickets').DataTable({
	//   'paging'      : true,
	//   'lengthChange': true,
	//   'searching'   : true,
	//   'ordering'    : true,
	//   'info'        : true,
	//   'autoWidth'   : false,
	// });
	//
	// $('#productorder').DataTable({
	//   'paging'      : true,
	//   'lengthChange': true,
	//   'searching'   : true,
	//   'ordering'    : true,
	//   'info'        : true,
	//   'autoWidth'   : false,
	// });
	//
    //
    // $('#complex_header').DataTable();
	
	//--------Individual column searching
	
	$('.res_table').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	} );
	
    // Setup - add a text input to each footer cell
    $('#example5 tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example5').DataTable( {
        dom: 'Bfrtip',
        'paging' : false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
    
    
    // Setup - add a text input to each footer cell
    $('table.data_tbl tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var data_tbl = $('table.data_tbl').DataTable( {
        dom: 'Bfrtip',
        'paging' : false,
        stateSave: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    
    // DataTable
    var data_tbl = $('table.data_tbl_fixed_header').DataTable( {
        dom: 'Bfrtip',
        'paging' : false,
        fixedHeader: true,
        stateSave: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
 
    // Apply the search
    // data_tbl.columns().every( function () {
    //     var that = this;
        
    //     console.log(this.value);
 
    //     $( 'input', this.footer() ).on( 'keyup change', function () {
    //         if ( that.search() !== this.value ) {
    //             that
    //                 .search( this.value )
    //                 .draw();
    //         }
    //     } );
    // } );
    
    // DataTable
    var table = $('.onlyTableIdNoSortBy').DataTable( {
        dom: 'Bfrtip',
        "bSort": false,
        'paging' : false,
        searching: false,
        info: false,
        stateSave: true,
        buttons: []
    } );
    
    // DataTable
    var table = $('.onlyTableId').DataTable( {
        dom: 'Bfrtip',
        'paging' : false,
        searching: false,
        info: false,
        stateSave: true,
        buttons: []
    } );
    
    // DataTable
    var table = $('.onlyTableWithSearch').DataTable( {
        dom: 'Bfrtip',
        'paging' : false,
        info: false,
        stateSave: true,
        buttons: []
    } );
    
    // DataTable
    var table = $('.sortingOffWithSearchTable').DataTable( {
        dom: 'Bfrtip',
        "bSort": false,
        'paging' : false,
        info: false,
        stateSave: true,
        buttons: []
    } );
    
    // DataTable
    var table = $('.sortingOffWithSearchTable1').DataTable( {
        dom: 'Bfrtip',
        "bSort": false,
        'paging' : false,
        info: false,
        stateSave: true,
        buttons: []
    } );
    
    // DataTable
    var table = $('.sortingOffWithSearchTable2').DataTable( {
        dom: 'Bfrtip',
        "bSort": false,
        'paging' : false,
        info: false,
        stateSave: true,
        buttons: []
    } );
    
    // DataTable
    var table = $('.simpleDtTable').DataTable( {
        dom: 'Bfrtip',
        "bSort": false,
        'paging' : false,
        searching: false,
        info: false,
        stateSave: true,
        buttons: []
    } );
    
    // DataTable
    var table = $('.onlyExportDtTable').DataTable( {
        dom: 'Bfrtip',
        "bSort": false,
        'paging' : false,
        searching: false,
        info: false,
        stateSave: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    
    // DataTable
    var table = $('.sortingOffTable').DataTable( {
        dom: 'Bfrtip',
        "bSort": false,
        'paging' : false,
        stateSave: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
    
    
    
    // DataTable
    var table = $('.referncerTbl').DataTable( {
        dom: 'Bfrtip',
        "bSort": false,
        'paging' : false,
        stateSave: true,
        buttons: [
            {
                text: 'PDF Html5',
                extend: 'pdfHtml5',
                message: '',
                orientation: 'portrait',
                exportOptions: {
                     columns: ':visible'
                },
                customize: function (doc) {
                    doc.pageMargins = [10,10,10,10];
                    doc.defaultStyle.fontSize = 7;
                    doc.styles.tableHeader.fontSize = 7;
                    doc.styles.title.fontSize = 15;
                    // Remove spaces around page title
                    // doc.content[0].text = doc.content[0].text.trim();
                    doc.content[0].text = "Custom Table";
                    // Create a footer
                    doc['footer']=(function(page, pages) {
                        return {
                            columns: [
                                'This is your left footer column',
                                {
                                    // This is the right column
                                    alignment: 'right',
                                    text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                                }
                            ],
                            margin: [10, 0]
                        }
                    });
                    // Styling the table: create style object
                    var objLayout = {};
                    // Horizontal line thickness
                    objLayout['hLineWidth'] = function(i) { return .5; };
                    // Vertikal line thickness
                    objLayout['vLineWidth'] = function(i) { return .5; };
                    // Horizontal line color
                    objLayout['hLineColor'] = function(i) { return '#aaa'; };
                    // Vertical line color
                    objLayout['vLineColor'] = function(i) { return '#aaa'; };
                    // Left padding of the cell
                    objLayout['paddingLeft'] = function(i) { return 4; };
                    // Right padding of the cell
                    objLayout['paddingRight'] = function(i) { return 4; };
                    // Inject the object in the document
                    doc.content[1].layout = objLayout;
                }
            }
        ]
    } );
	
	
	//---------------Form inputs
	// var table = $('#example6').DataTable();
    //
    // $('button').click( function() {
     //    var data = table.$('input, select').serialize();
     //    alert(
     //        "The following data would have been submitted to the server: \n\n"+
     //        data.substr( 0, 120 )+'...'
     //    );
     //    return false;
    // } );
	
	
	
	
  }); // End of use strict