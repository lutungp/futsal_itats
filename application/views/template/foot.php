      <script type="text/javascript">
      $(function () {
        if(typeof $.fn.DataTable !== 'undefined') {
          $("#datatable_1").DataTable();
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
          });
        }

        if(typeof $.fn.timepicker !== 'undefined'){
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
        }
      });

      </script>
    </body>
</html>
