      <script type="text/javascript">
      $(function () {
         $("#datatable_1").DataTable();
         $('#example2').DataTable({
           "paging": true,
           "lengthChange": false,
           "searching": false,
           "ordering": true,
           "info": true,
           "autoWidth": false
         });

         $('#timepicker3').timepicker({
             format: 'LT'
         });
         $('#timepicker4').timepicker({
             format: 'LT'
         });

       });
      </script>
    </body>
</html>
