<style media="screen">

  .loader {
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid #3498db; /* Blue */
      border-radius: 50%;
      width: 120px;
      height: 120px;
      animation: spin 2s linear infinite;
      z-index: 99999;
      position: absolute;
  }

  #ajaxloader.loader {
    top: 50%;
    bottom: 0;
    left: 50%;
    right: 0;
    display: none;
  }

  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }

</style>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-md">
        <!-- BEGIN CONTAINER -->
        <div class="wrapper">
            <!-- BEGIN HEADER -->
            <div class="container-fluid">
                <div id="futsal_background" class="page-content" style="top: 75px;">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                          <div class="portlet light bordered form-fit">
                              <div class="portlet-title">
                                  <div class="caption">
                                      <i class="fa fa-futbol-o font-blue-hoki"></i>
                                      <span class="caption-subject font-blue-hoki bold uppercase">Form Booking Lapangan</span>
                                  </div>
                                  <div class="caption-right">
                                    <a type="button" onclick="logincutomer()">
                                      <span class="caption-subject font-blue-hoki bold uppercase">LOG IN</span>
                                    </a>
                                  </div>
                              </div>
                              <div class="portlet-body form">
                                  <!-- BEGIN FORM-->
                                  <form action="#" class="form-horizontal form-bordered form-label-stripped">
                                      <div class="form-body">
                                          <div class="form-group">
                                              <label class="control-label col-md-3">Pilih GOR</label>
                                              <div class="col-md-9">
                                                  <select class="form-control select-add-branch" id="i_branch" name="i_branch">
                                                    <option value="0"></option>
                                                    <?php foreach ($branches->result() as $r_branch): ?>
                                                      <option value="<?php echo $r_branch->branch_id ?>" data-name="<?php echo $r_branch->branch_name ?>">
                                                        <?php echo $r_branch->branch_name ?>
                                                      </option>
                                                    <?php endforeach; ?>
                                                  </select>
                                                  <span class="help-block"> Pilih Gelanggang. </span>
                                              </div>
                                          </div>
                                          <div class="loader" id="ajaxloader"></div>
                                            <div class="col-md-12">
                                              <div class="row">
                                                <br>
                                                <div id="gelanggang_det" style="display: none;">
                                                  <div class="portlet light bordered">
                                                    <div class="portlet-body">
                                                      <center>
                                                        <br>
                                                        <br>
                                                        <div class="descLokasi" style="display: table-cell;text-align: left;">
                                                          <div class="left">
                                                            <img src="<?php echo base_url()?>assets/img/aqua-soccer-ball-md.png" width="25" height="25" alt="Hotel Icon">
                                                          </div>
                                                          <div class="right">
                                                            <div class="title" id="i_gor"> </div>
                                                            <div class="subtitle" id="i_alamat"> </div>
                                                          </div>
                                                          <div class="clear"></div>
                                                        </div>
                                                        <div class="descLokasi" style="display: table-cell;text-align: left;">
                                                          <div class="left">
                                                            <img src="<?php echo base_url()?>assets/img/phone-icon-blu.png" width="25" height="25" alt="Hotel Icon">
                                                          </div>
                                                          <div class="right">
                                                            <div class="title" id=""> Telepon </div>
                                                            <div class="subtitle" id="i_telp"> </div>
                                                          </div>
                                                          <div class="clear"></div>
                                                        </div>
                                                        <div class="descLokasi" style="display: table-cell;text-align: left;">
                                                         <div class="left">
                                                           <img src="<?php echo base_url()?>assets/img/Clock.png" width="25" height="25" alt="Hotel Icon">
                                                         </div>
                                                         <div class="right">
                                                           <div class="title" id=""> Jam Operasional</div>
                                                           <div class="subtitle" id="i_jamoperasional"> </div>
                                                         </div>
                                                         <div class="clear"></div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                          <div class="content4" >

                                                          </div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="" id="box_lapangan">

                                                          </div>
                                                        </div>
                                                      </center>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- END DASHBOARD STATS 1-->
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- BEGIN FOOTER -->
                <!-- <p class="copyright">2015 © Metronic by keenthemes.
                    <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes"
                    title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
                </p> -->
                <a href="#index" class="go2top">
                    <i class="icon-arrow-up"></i>
                </a>
            </div>
        </div>
        <div class="modal fade" id="booking_popmodal">
          <div class="modal-dialog">
            <div class="modal-content">

            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="logincustomer_popmodal">
          <div class="modal-dialog">
            <div class="modal-content">

            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<script type="text/javascript">

$(document).ready(function(){
    var base_url = '<?php echo base_url();?>';

    $('body').on('change', '.select-add-branch', function (e) {
        $.fn.getBranchdetail($(this));
        $.fn.getBuildings($(this));
        // e.preventDefault();
    });

    $.fn.getBranchdetail = function (select) {
      var branch_id = select.val();
      var html = '';
      $.ajax({
        type      : "POST",
        data      : {
          branch_id : branch_id
        },
        dataType  : "JSON",
        url       : "<?php echo base_url()?>customerBooking/getBranchdetail",
        cache     : false,
        success   : function(data){
          $("#gelanggang_det").show(100);
          document.getElementById("i_gor").innerHTML = data.branch_name;
          document.getElementById("i_alamat").innerHTML = data.branch_address;
          document.getElementById("i_telp").innerHTML = data.branch_phone;
          document.getElementById("i_jamoperasional").innerHTML = data.jambuka +" - "+ data.jamtutup;
        }
      })
    };


    $.fn.getBuildings = function (select, branch) {
          // var branch_name = select.attr('data-name');
          var branch_id = select.val();
          var panel_lapangan = [];
          var html = '';
          var lap_length = [];
          var length = '';

          $.post("<?php echo base_url()?>Customer_interface_c/get_lapangan", {branch_id: branch_id}, function(data){
            $('#box_lapangan').empty();
            $('.content4').empty();
            length = 0;
              $.each(JSON.parse(data), function (index, value) {
                var building_name = value.building_name;
                var building_id = value.building_id;
                var branch = value.branch;
                var status = value.status;
                html = ''
                // '<div class="status-lapangan">Available</div>'
                        + '<div class="col-md-4" style="padding-top:10px;">'
                        + '<div class="thumbnail">'
                        + '<img src="'+value.path+value.building_img+'" alt="" style="width: 100%; height: 200px;">'
                        + '<div class="caption">'
                        + status
                        + '<h3>'+building_name+'</h3>'
                        + '<p><a type="button" data-id="'+building_id+'" data-branch-id="'+branch+'" class="btn blue btn-booking"> Booking </a></p>'
                        + '<div class="normalPrice"> Rp'+toRp(value.harga)+',00 / jam </div>'
                        + '</div>'
                        + '</div>'
                        + '</div>';

                // $('#box_lapangan').append(html);
                panel_lapangan.push(html);
                length++;
              });


              var pagination = '';
              var start_content = 0;
              var last_content = 0;
              var page_length = 0;

              pagination = '<p id="dynamic_pager_demo2" class="demo4_bottom"> </p>';


              $('.content4').hide();
              $('#box_lapangan').hide();

              for (var i = 0; i < 3; i++) {
                $('.content4').append(panel_lapangan[i]);
              }
              $('.content4').show(800);

              if (length>3) {


                $('#box_lapangan').append(pagination);

                $('#box_lapangan').show(800);

                var j = 0;
                for (var i = 1; i <= length; i++) {
                  {
                    if ( i % 3 == 0 ) {
                      j++;
                    }
                  }
                }

                $('.demo4_top,.demo4_bottom').bootpag({
                    maxVisible: 3,
                    total: j,
                    page: 1,
                    leaps: true,
                    firstLastUse: true,
                    first: '←',
                    last: '→',
                    wrapClass: 'pagination',
                    activeClass: 'active',
                    disabledClass: 'disabled',
                    nextClass: 'next',
                    prevClass: 'prev',
                    lastClass: 'last',
                    firstClass: 'first'
                }).on("page", function(event, num){

                  if (num > 1) {
                    num = num-1;
                    start_content = num*2+num;
                  } else {
                    num = 0;
                    start_content = 0;
                  }

                  $('.content4').empty();

                  for (var i = start_content; i <= start_content+2; i++) {
                    $('.content4').append(panel_lapangan[i]);
                  }

                });

              } else {
                  $('.content4').html(panel_lapangan);
                  $('.content4').show("slide", { direction: "left" }, 1000);
              }
          })
          .done(function(){
            // $('#box_lapangan').css('pointer-events', '');
          })
        };

        $('body').on('click', '.btn-booking', function (e) {
            $.fn.getBooking($(this));
            e.preventDefault();
        });

        $.fn.getBooking = function(object){

          var building = object.attr('data-id');
          var branch = object.attr('data-branch-id');
          var url = "<?php echo base_url()?>Customer_interface_c/popmodal_booking/"+branch+"/"+building;
          $('#booking_popmodal').modal('show').find('.modal-content').load(url);

        }

  });

  function logincutomer()
  {
    var url = "<?php echo base_url()?>Customer_interface_c/logincustomer_popmodal";
    $('#logincustomer_popmodal').modal('show').find('.modal-content').load(url);
  }

</script>
