<style media="screen">
.datepicker.dropdown-menu {
    left: 802.837px!important;
  }
</style>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title"><?php echo $buildings->building_name;?></h4>
</div>
<div class="modal-body">
  <div class="form-group">
    <label for="">Pilih Tanggal</label>
    <div class="input-group date form_datetime" data-date="">
        <input type="text" id="i_tangggal" name="i_tangggal" size="16" readonly class="form-control">
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
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-primary">Save changes</button>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.form_datetime').datepicker({
      opens: 'left'
    });

  });

  var building_id = "<?php echo $building_id?>";
  var branch_id   = "<?php echo $branch_id?>";
  var base_url    = "<?php echo base_url()?>";
  var i_tangggal  = $('#i_tangggal').val();

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


        $('#i_jam_1').append('<option value="0">qwert</option>');
        $('#i_jam_2').append('<option value="0"> </option>');

        // var selected = '';
        //
        // $('#i_jam_1').append('<option value="" '+selected+'>2</option>');
        // $('#i_jam_1').append('<option value="" '+selected+'>2</option>');
        // $('#i_jam_1').append('<option value="" '+selected+'>2</option>');
        //
        $('#i_jam_1').select2();
        // $('#i_jam_2').select2();
      },
      error     : function(data){
        alert('error');
      }
    });
  }

  $('#i_tangggal').on('change', function(){
    // alert();
    $.fn.get_tangggal() ;
  });


</script>
