        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; Upperclass 2022. </strong>
            All rights reserved.
        </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('assets') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets') }}/dist/js/adminlte.js"></script>

        <!-- PAGE PLUGINS -->
        <!-- DataTables  & Plugins -->
        <script src="{{ asset('assets') }}/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/jszip/jszip.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- jQuery Mapael -->
        <script src="{{ asset('assets') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
        <script src="{{ asset('assets') }}/plugins/raphael/raphael.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
        <!-- ChartJS -->
        <script src="{{ asset('assets') }}/plugins/chart.js/Chart.min.js"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('assets') }}/dist/js/demo.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('assets') }}/dist/js/pages/dashboard2.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('assets') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
        <script src="{{ asset('assets') }}/plugins/chart.js/Chart.min.js"></script>

        <script>
            $(function() {
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });

                //Initialize Select2 Elements
                $('.select2').select2()

                //-------------
    
                
            });


            // This will get the first returned node in the jQuery collection.
                new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
                })

                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                    var pieData        = donutData;
                    var pieOptions     = {
                    maintainAspectRatio : false,
                    responsive : true,
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                    })
        </script>
        
        @yield('script')
        </body>

        </html>
