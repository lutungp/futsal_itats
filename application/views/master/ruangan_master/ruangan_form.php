<style media="screen">
  #img_preview{
    width: 200px;
    height: auto;
  }
</style>
<div class="page-content">
  <div class="page-bar">
		<?php echo $title_page ?>
	</div>
    <div class="row">
      <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-body form" id="input_content">
              <form id="ruangan_form" class="" action="<?php echo base_url($action_add)?>" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-2 col-md-offset-2">
                      <div class="form-group">
                        <label for="">Field Image</label>
                        <br>
                        <?php $img = isset($building_details->building_img ) ? $building_details->building_img : "img_not_found.png";?>
                        <!-- <img src="<?php echo base_url('assets/img/buildings/'.$img)?>" alt="" id="img_preview"> -->
                        <button id="cropbutton" type="button" onclick="applyCrop();">Crop</button>
                        <button id="scalebutton" type="button">Scale</button>
                        <br>
                        <div id="views"></div>
                        <br>
                        <input type="file" name="i_img" value="" onchange="readURL(this);">
                      </div>
                    </div>
                    <div class="col-md-8  col-md-offset-2">
                      <div class="form-group">
                        <label for="">Field Name</label>
                        <input type="hidden" name="i_id" class="form-control"
                        value="<?php echo isset($building_details->building_id) ? $building_details->building_id : ""?>">
                        <input type="text" name="i_name" class="form-control"
                        value="<?php echo isset($building_details->building_name) ? $building_details->building_name : ""?>">
                      </div>
                      <div class="form-group">
                        <label for="">Branch</label>
                        <select id="i_branch" name="i_branch" class="form-control select2"></select>
                      </div>
                      <div class="form-group">
                        <label for="">Statue</label>
                        <select id="i_status" name="i_status" class="form-control select2"></select>
                      </div>
                      <div class="form-group">
                        <label for="">Book Hour</label>
                        <input type="number" class="form-control" name="i_hour" value="<?php echo $building_details->building_hour_book?>">
                      </div>
                      <div class="form-group">
                        <label for="">Book Price</label>
                        <input type="textarea" id="i_harga_jual_currency" name="i_harga_jual_currency" class="form-control number_only"
                        value="<?php echo isset($building_details->building_price) ? $building_details->building_price : "0" ?>"  onkeyup="number_currency(this);">
                        <input type="hidden" id="i_harga_jual" name="i_harga_jual" class="form-control"
                        value="<?php echo isset($building_details->building_price) ? $building_details->building_price : ""?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                      <button type="submit" name="button" class="btn btn-primary">Simpan</button>
                      <a href="<?php echo base_url($action_close)?>" class="btn btn-danger">Keluar</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
</div>



<script type="text/javascript">

    var crop_max_width = 400;
    var crop_max_height = 400;
    var jcrop_api;
    var canvas;
    var context;
    var image;

    var prefsize;

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // $('#img_preview').empty();
                // $('#img_preview').attr('src', e.target.result);
                image = new Image();
                image.onload = validateImage;
                image.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function dataURLtoBlob(dataURL) {
      var BASE64_MARKER = ';base64,';
      if (dataURL.indexOf(BASE64_MARKER) == -1) {
        var parts = dataURL.split(',');
        var contentType = parts[0].split(':')[1];
        var raw = decodeURIComponent(parts[1]);

        return new Blob([raw], {
          type: contentType
        });
      }
      var parts = dataURL.split(BASE64_MARKER);
      var contentType = parts[0].split(':')[1];
      var raw = window.atob(parts[1]);
      var rawLength = raw.length;
      var uInt8Array = new Uint8Array(rawLength);
      for (var i = 0; i < rawLength; ++i) {
        uInt8Array[i] = raw.charCodeAt(i);
      }

      return new Blob([uInt8Array], {
        type: contentType
      });
    }

    function validateImage() {
      if (canvas != null) {
        image = new Image();
        image.onload = restartJcrop;
        image.src = canvas.toDataURL('image/png');
      } else restartJcrop();
    }

    function restartJcrop() {
      if (jcrop_api != null) {
        jcrop_api.destroy();
      }
      $("#views").empty();
      $("#views").append("<canvas id=\"canvas\">");
      canvas = $("#canvas")[0];
      context = canvas.getContext("2d");
      canvas.width = image.width;
      canvas.height = image.height;
      context.drawImage(image, 0, 0);
      $("#canvas").Jcrop({
        onSelect: selectcanvas,
        onRelease: clearcanvas,
        boxWidth: crop_max_width,
        boxHeight: crop_max_height
      }, function() {
        jcrop_api = this;
      });
      clearcanvas();
    }

    function clearcanvas() {
      prefsize = {
        x: 0,
        y: 0,
        w: canvas.width,
        h: canvas.height,
      };
    }

    function selectcanvas(coords) {
      prefsize = {
        x: Math.round(coords.x),
        y: Math.round(coords.y),
        w: Math.round(coords.w),
        h: Math.round(coords.h)
      };
    }

    function applyCrop() {
      canvas.width = prefsize.w;
      canvas.height = prefsize.h;
      context.drawImage(image, prefsize.x, prefsize.y, prefsize.w, prefsize.h, 0, 0, canvas.width, canvas.height);
      validateImage();
    }

    function applyScale(scale) {
      if (scale == 1) return;
      canvas.width = canvas.width * scale;
      canvas.height = canvas.height * scale;
      context.drawImage(image, 0, 0, canvas.width, canvas.height);
      validateImage();
    }


    $(document).ready(function() {

      var base_url = '<?php echo base_url();?>';
      var branch_selected = '<?php echo $building_details->branch;?>';
      $.ajax({
        type      : "get",
        dataType  : "json",
        url       : base_url+"Ruangan_c/get_branch",
        success   : function(data){
          $('#i_branch').empty();
          $('#i_branch').select2('destroy');
          $('#i_branch').append('\
            <option value="0"> </option>');

          for (var i = 0; i < data.length; i++) {
            var selected = '';
            if (branch_selected==data[i].branch_id) {
              selected = 'selected';
            }
            $('#i_branch').append('\
              <option value="'+data[i].branch_id+'" '+selected+'>'+data[i].branch_name+'</option>\
            ');
          }
          $('#i_branch').select2();
        },
        error     : function(data){
          alert('error');
        }
      });

      var status_selected = '<?php echo $building_details->building_status;?>';

      $.ajax({
        type      : "get",
        dataType  : "json",
        url       : base_url+"Ruangan_c/get_status",
        success   : function(data){
          $('#i_status').empty();
          $('#i_status').select2('destroy');
          $('#i_status').append('\
            <option value="0"> </option>');

          for (var i = 0; i < data.length; i++) {
            var selected = '';
            if (status_selected==data[i].status_building_id) {
              selected = 'selected';
            }
            $('#i_status').append('\
              <option value="'+data[i].status_building_id+'" '+selected+'>'+data[i].status_building_name+'</option>\
            ');
          }
          $('#i_status').select2();
        },
        error     : function(data){
          alert('error');
        }
      });

  });

  $("#ruangan_form").submit(function(e) {

    formData = new FormData($(this)[0]);
    var blob = dataURLtoBlob(canvas.toDataURL('image/png'));
    //---Add file blob to the form data
    formData.append("cropped_image[]", blob);

    $.ajax({
      url: $("#ruangan_form").attr("action"),
      type: "POST",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function(data) {
        alert("Success");
      },
      error: function(data) {
        alert("Error");
      },
      complete: function(data) {}
    });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});


</script>
