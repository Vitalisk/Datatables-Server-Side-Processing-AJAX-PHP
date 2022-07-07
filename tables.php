  <!--This section is now included in the header file-->
  
  <!-- StyleSheets Datatables Fixed Columns -->
	<link rel="stylesheet" href="dist/node_modules/online/datatables/jquery.dataTables.min.css">
	<link rel="stylesheet" href="dist/node_modules/online/datatables/fixedColumns.dataTables.min.css">
	<!-- Datatables -->
	<link rel="stylesheet" type="text/css" href="dist/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="dist/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">    
  
  <!-- End of header file section-->
          
       <!--This section is now included in the main section-->   
          <table class="table_ajax table table-hover " cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="no-sort">#</th>
                <th class="no-sort"><input type="checkbox" class="checkall checkbox" id="checkall"></th>
                <th>Image</th>
                <th>Names</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Status</th>
                <th class="noExport text-center">Action</th>
              </tr>
            </thead>
          </table>
          
          <script>
		datatables_url = LINKTOROOTDIRECTORY.'Auth/getUsers';
          </script>
          
        <!--End of main section section-->
    
    
    <!--This section is now included in the  Footer file-->
          
    <!-- This is data table -->
    <script src="dist/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="dist/node_modules/online/datatables/dataTables.buttons.min.js"></script>
    <script src="dist/node_modules/online/datatables/buttons.flash.min.js"></script>
    <script src="dist/node_modules/online/datatables/jszip.min.js"></script>
    <script src="dist/node_modules/online/datatables/pdfmake.min.js"></script>
	  <script src="dist/node_modules/online/datatables/vfs_fonts.js"></script>
    <script src="dist/node_modules/online/datatables/buttons.html5.min.js"></script>
    <script src="dist/node_modules/online/datatables/buttons.print.min.js"></script>
    <script src="dist/node_modules/online/datatables/dataTables.fixedColumns.min.js"></script>
    <script src="dist/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    
    	<script>

		if(datatables_url != ''){
			var table_data = $('.table_ajax').DataTable({
				responsive: {
					details: {
						type: 'column',
						target: -1
					}
				},
				columnDefs: [ {
					targets: 'no-sort',
					className: 'dtr-control',
					orderable: false,
					targets:   -1
					
				} ],
				processing: true,
				serverSide: true,
				bSort : false,
				serverMethod: 'post',
				ajax: {
					'url': datatables_url
				},
				dom: 'Blfrtip',
				lengthMenu : [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
				oLanguage: {
				   sLengthMenu: "_MENU_",
				},
				
				buttons: {
					dom: {
						button: {
							className: 'btn btn-sm btn-info mr-2' //Primary class for all buttons
						}
					},
					buttons: [                  
						
						{
							//COPY
							extend: 'copy',
							text: '<i class="icon ni ni-file"></i> Copy',
							exportOptions: {
								columns: "thead th:not(.noExport)"
							}
						},
						{
							//pdf
							extend: 'pdf',
							text: '<i class="icon ni ni-file-pdf"></i> Pdf',
							exportOptions: {
								columns: "thead th:not(.noExport)"
							}
						},
						{
							//EXCEL
							extend: 'excel',
							text: '<i class="icon ni ni-file-xls"></i> Excel',
							exportOptions: {
								columns: "thead th:not(.noExport)"
							}
						},
						
						{
							//PRINT
							extend: 'print',
							text: '<i class="icon ni ni-printer"></i> Print',
							exportOptions: {
								columns: "thead th:not(.noExport)"
							}
						}
						
					]
				}
				
			});
			$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').detach();
			$(".dataTables_filter input").attr("placeholder", "Type to search");
			$('.dt-buttons').addClass('whitespace-nowrap');
		}
    
    </script>
