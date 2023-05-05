<!-- /.content-wrapper -->
<footer class="main-footer" style="color: #000000;">
    <strong>Copyright &copy; 2023 <a href="http://ics.com.ph">ICS</a></strong>
        All rights reserved. <b><a href=".">SUNDAE</a></b> (Subscription Usage Notifications Dashboard Automation Enterprise)
        <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
    </div>
</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
        </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/admin_lte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/admin_lte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>  -->

<!-- <script src="/admin_lte/plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<script src="/admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="/admin_lte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/admin_lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->

<!-- Bootstrap 4 -->
<script src="/admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/admin_lte/plugins/chart.js/Chart.min.js"></script>
<!-- Select2 -->
<script src="/admin_lte/plugins/select2/js/select2.full.min.js"></script>
<!-- Sparkline -->
<script src="/admin_lte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/admin_lte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/admin_lte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admin_lte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/admin_lte/plugins/moment/moment.min.js"></script>
<script src="/admin_lte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/admin_lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/admin_lte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/admin_lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin_lte/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/admin_lte/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/admin_lte/dist/js/demo.js"></script>
<script src='https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js'></script>
<script  src="/admin_lte/script.js"></script>
@include('dashboard.js.subscription_table_js')
@include('dashboard.js.email_recipients_js')
@include('dashboard.js.cdb_accounts_table_js')
@include('dashboard.js.import_export_data_js')
@include('dashboard.add_contacts_modal')
@include('dashboard.select_customer_modal')
@include('dashboard.js.filter_subscriptions_js')
</body>
</html>