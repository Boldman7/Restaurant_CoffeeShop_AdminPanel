 <footer class="footer text-center"> <?php date('Y')?><a href="http://www.samyotech.com/" target="_blank"> &copy; Designed By Samyotech Software Solutions Pvt. Ltd.</a></footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url();?>assets/js/waves.js"></script>
    <script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
    <!-- Vector map JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/vectormap/jquery-jvectormap-in-mill.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/vectormap/jquery-jvectormap-us-aea-en.js"></script>
    <!-- chartist chart -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- sparkline chart JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/js/dashboard3.js"></script>
    <!--Style Switcher -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/Chart.js/chartjs.init.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/Chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/datatables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script>
         $(function() {
    
    /*<!-- ============================================================== -->*/
    /*<!-- Line Chart -->*/
    /*<!-- ============================================================== -->*/
    new Chart(document.getElementById("chart10"),
        {
            "type":"line",
            "data":{"labels":["January","February","March","April","May","June","July"],
            "datasets":[{
                            "label":"SALES",
                            "data":[65,59,80,81,56,55,40],
                            "fill":false,
                            "borderColor":"rgb(83, 230, 157)",
                            "lineTension":0.1
                        }]
        },"options":{}});
    
    /*<!-- ============================================================== -->*/
    /*<!-- Bar Chart -->*/
    /*<!-- ============================================================== -->*/
    new Chart(document.getElementById("chart21"),
        {
            "type":"bar",
            "data":{"labels":["January","February","March","April","May","June","July"],
            "datasets":[{
                            "label":"PURCHASE",
                            "data":[65,59,80,81,56,55,40],
                            "fill":false,
                            "backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],
                            "borderColor":["rgb(255, 118, 118)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(83, 230, 157)","rgb(44, 171, 227)","rgb(153, 102, 255)","rgb(201, 203, 207)"],
                            "borderWidth":1}
                        ]},
            "options":{
                "scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}
            }
        });
});
         
    $(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 10,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', footer: true },
            { extend: 'pdfHtml5', footer: true }
        ]
    });
    $('#orders').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true, 
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]},
            title: 'Sale_Details',
            },
            { extend: 'csvHtml5', footer: true }
        ]
    });
    $('.deletedOrder').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true, 
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12]},
            title: 'Sale_Details',
            },
            { extend: 'csvHtml5', footer: true }
        ]
    });
     $('#purchase').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true, 
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7]},
            title: 'Purchase_Details',
            },
            { extend: 'csvHtml5', footer: true }
        ]
    });
    $('.example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', footer: true },
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', footer: true },
            { extend: 'pdfHtml5', footer: true }
        ]
    });
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary m-r-10');
    </script>
</body>

</html>
