<?php
$CI = &get_instance();
?>

<style>
  .btn-file {
      position: relative;
      overflow: hidden;
  }
  .btn-file input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      font-size: 100px;
      text-align: right;
      filter: alpha(opacity=0);
      opacity: 0;
      outline: none;
      background: white;
      cursor: inherit;
      display: block;
  }

  #img-upload{
      width: 100%;
  }
</style>

<section class="content-header">
  <h1>
    <?php echo lang('msg_dashboard'); ?>
    <small>Outlet</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
    <li class="active">Outlet</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Edit Outlet</h3>

      <?php
        if ($CI->session->flashdata('updated_msg_error')) {
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . $CI->session->flashdata('updated_msg_error') . '</div>';
        };
      ?>

      <div class="box-body">
        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/outlets/edit_outlet'; ?>" enctype="multipart/form-data" >

          <input type="hidden" value="<?php echo $outlet[0]->id ?>" name="outlet_id">

          <div class="form-group">
              <label class="control-label col-sm-2">Title</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo $outlet[0]->title ?>" required>
                  <?php echo form_error('title'); ?>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-sm-2">Address</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo $outlet[0]->address ?>" required>
                  <?php echo form_error('address'); ?>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-sm-2">City</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $outlet[0]->city ?>" required>
                  <?php echo form_error('city'); ?>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-sm-2">Contact</label>
              <div class="col-sm-10">
                  <input type="number" class="form-control" id="contact" name="contact" placeholder="Contact" value="<?php echo $outlet[0]->contact ?>" required>
                  <?php echo form_error('contact'); ?>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-sm-2">Latitude</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="lat" name="lat" placeholder="Latitude" value="<?php echo $outlet[0]->lat ?>" required>
                  <?php echo form_error('lat'); ?>
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-sm-2">Longitude</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="lon" name="lon" placeholder="Longitude" value="<?php echo $outlet[0]->lon ?>" required>
                  <?php echo form_error('lon'); ?>
              </div>
          </div>

          <div class="form-group">
            <div class="controls col-sm-offset-10">
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>


<script>
</script>