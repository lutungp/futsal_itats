<style media="screen">
.datepicker.dropdown-menu {
    left: 802.837px!important;
  }
</style>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title"><?php echo $buildings->building_name;?></h4>
</div>
<form id="booking_form" action="<?php echo $action?>">
  <div class="modal-body">
    <div class="form-group">
      <input type="hidden" id="i_building" name="i_building" value="<?php echo $building_id?>">
      <input type="hidden" id="i_branch" name="i_branch" value="<?php echo $branch_id?>">
      <label for="">Pilih Tanggal</label>
      <div class="input-group date form_datetime" data-date="">
          <input type="text" id="i_tangggal" name="i_tangggal" size="16" readonly class="form-control" required="true">
          <span class="input-group-btn">
              <button class="btn default date-reset" type="button">
                  <i class="fa fa-times"></i>
              </button>
              <button class="btn default date-set" type="button">
                  <i class="fa fa-calendar"></i>
              </button>
          </span>
      </div>
    </div>
    <div class="form-group">
      <label for="">Pilih Jam</label>
      <div class="row">
        <div class="col-md-6">
          <select id="i_jam_1" name="i_jam_1" class="form-control select2"/>
        </div>
        <div class="col-md-6">
          <select id="i_jam_2" name="i_jam_2" class="form-control select2"/>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      <button id="btn_simpan1" type="button" class="btn btn-primary">Next</button>
  </div>
</form>

<script type="text/javascript">

  var building_id = "<?php echo $building_id?>";
  var branch_id   = "<?php echo $branch_id?>";
  var base_url    = "<?php echo base_url()?>";
  var i_tangggal  = $('#i_tangggal').val();

  var date =  moment().format('DD/MM/YYYY');
  $.fn.get_tangggal = function(){

    $.ajax({
      type      : "POST",
      dataType  : "json",
      data      : {building_id:building_id, branch_id:branch_id, i_tangggal:i_tangggal},
      url       : base_url+"Customer_interface_c/get_time",
      success   : function(data){

        if ($('#i_jam_1').data('select2') || $('#i_jam_2').data('select2')) {

           $('#i_jam_1').select2('destroy');
           $('#i_jam_1').empty();

           $('#i_jam_2').select2('destroy');
           $('#i_jam_2').empty();
         }
         var jam_buka   = data['open_time'].branch_hour_1;
         var jam_tutup  = data['open_time'].branch_hour_2;

         var strjam_buka    = data['open_time'].strbranch_hour_1;
         var strjam_tutup   = data['open_time'].strbranch_hour_2;

         var timeStart  = new Date(date+" "+jam_buka);
         var timeEnd    = new Date(date+" "+jam_tutup);

         var difference = timeEnd - timeStart;
         difference = difference / 60 / 60 / 1000;

         var booking_time = jam_buka.split(':');
         var booking_time1 = booking_time[0];

         for (var i = 0; i < difference; i++) {
            booking_start = 0;
            booking_start = parseInt(booking_time1)+i;
           $('#i_jam_1').append('<option value="'+parseInt(booking_start)+'">'+parseInt(booking_start)+':00</option>');
         }

         for (var i = 0; i < difference; i++) {
           booking_end = 0;
           booking_end = parseInt(booking_time1)+i;
          $('#i_jam_2').append('<option value="'+parseInt(booking_end)+'">'+parseInt(booking_end)+':00</option>');
         }

         $('#i_jam_1').select2();
         $('#i_jam_2').select2();
      },
      error     : function(data){
        alert('error');
      }
    });
  }

  $(document).ready(function(){
    $('.form_datetime').datepicker({
      opens: 'left'
    });
    $.fn.get_tangggal();
  });

  $('#i_tangggal').on('change', function(){
    $.fn.get_tangggal();
  });

  var  hourDiff = function()
  {
    parseInt($("select[name='timestart']").val().split(':')[0],10) - parseInt($("select[name='timestop']").val().split(':')[0],10);
    $("p").html("<b>Hour Difference:</b> " + hourDiff )
  }

  var bookingstorage = [];
  var i_building = '';
  var i_branch = '';
  var i_tangggal = '';
  var i_jam_1 = '';
  var i_jam_2 = '';

  $("#btn_simpan1").on('click', function() {
      i_building = $('#i_building').val();
      i_branch = $('#i_branch').val();
      i_tangggal = $('#i_tangggal').val();
      i_jam_1 = $('#i_jam_1').val();
      i_jam_2 = $('#i_jam_2').val();

      var customer_detail = '<div class="form-group">\
                              <input type="hidden" id="i_building" name="i_building" value="<?php echo $building_id?>">\
                              <input type="hidden" id="i_branch" name="i_branch" value="<?php echo $branch_id?>">\
                              <input type="hidden" id="i_building" name="i_building" value="<?php echo $building_id?>">\
                              <input type="hidden" id="i_tangggal" name="i_tangggal" value="'+i_tangggal+'">\
                              <input type="hidden" id="i_jam_1" name="i_jam_1" value="'+i_jam_1+'">\
                              <input type="hidden" id="i_jam_2" name="i_jam_2" value="'+i_jam_2+'">\
                              <label>Nama</label>\
                              <input id="i_name" name="i_name" class="form-control" required/>\
                            </div>\
                            <div class="form-group">\
                              <label>NIK</label>\
                              <input id="i_nik" name="i_nik" class="form-control" required/>\
                            </div>\
                            <div class="form-group">\
                              <label>Alamat</label>\
                              <input id="i_alamat" name="i_alamat" class="form-control" required/>\
                            </div>\
                            <div class="form-group">\
                              <label>No. Telepon</label>\
                              <input id="i_phone" name="i_phone" class="form-control" required/>\
                            </div>\
                            <div class="form-group">\
                              <label>Email</label>\
                              <input type="email" id="i_mail" name="i_mail" class="form-control" required/>\
                            </div>\
                            ';

      $.fn.booking_popmodal(customer_detail);
    });

    $.fn.booking_popmodal = function(customer_detail)
    {
      $('#booking_popmodal').find('.modal-body').html(customer_detail);
      $('#btn_simpan1').remove();
      $('.modal-footer').append('<button id="btn_submit" type="submit" class="btn btn-primary" style="">Simpan</button>');
    }

  $("#booking_form").submit(function(e) {

    $.ajax({
           type: "POST",
           url: $("#booking_form").attr('action'),
           data: $("#booking_form").serialize(),
           dataType : "json",
           success: function(data)
           {
               $('#booking_popmodal').modal('hide');
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});


</script>
