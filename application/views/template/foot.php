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
            defaultTime: 'value',
            minuteStep: 1,
            disableFocus: true,
            template: 'dropdown',
            showMeridian:false
         });
         $('#timepicker4').timepicker({
             defaultTime: 'value',
             minuteStep: 1,
             disableFocus: true,
             template: 'dropdown',
             showMeridian:false
         });
       });
      </script>
    </body>
</html>
