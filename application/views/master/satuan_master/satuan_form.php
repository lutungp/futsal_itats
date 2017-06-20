<style media="screen">
  #img_preview{
    width: 200px;
    height: auto;
  }
</style>
<div class="page-content">
  <div class="page-bar">
    <ul class="page-breadcrumb">
      <li>
        <a href="index.html">Home</a>
        <i class="fa fa-circle"></i>
      </li>
      <li>
        <a href="#">Satuan</a>
        <i class="fa fa-circle"></i>
      </li>
      <li>
        <span>Satuan Form</span>
      </li>
    </ul>
    <div class="page-toolbar">
      <div class="btn-group pull-right">
        <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
          <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right" role="menu">
          <li>
            <a href="#">
              <i class="icon-bell"></i> Action</a>
          </li>
          <li>
            <a href="#">
              <i class="icon-shield"></i> Another action</a>
          </li>
          <li>
            <a href="#">
              <i class="icon-user"></i> Something else here</a>
          </li>
          <li class="divider"> </li>
          <li>
            <a href="#">
              <i class="icon-bag"></i> Separated link</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Satuan Form</span>
                </div>
                <!-- <div class="actions">
                    <div class="btn-group">
                        <a class="btn btn-sm green dropdown-toggle" href="javascript:;" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-pencil"></i> Edit </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-ban"></i> Ban </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;"> Make admin </a>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>
            <div class="portlet-body form">
              <form class="" action="<?php echo base_url($action_add)?>" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="row">


                    <div class="col-md-8  col-md-offset-2">
                      <div class="form-group">
                        <label for="">Satuan Name</label>
                        <input type="hidden" name="satuan_id" class="form-control" value="<?php echo isset($satuan_details->satuan_id) ? $satuan_details->satuan_id : ""?>">
                        <input type="text" name="satuan_name" class="form-control" value="<?php echo isset($satuan_details->satuan_name) ? $satuan_details->satuan_name : ""?>">
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


