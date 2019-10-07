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
    <small>Banner</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
    <li class="active">Banner</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Edit Banner</h3>

      <?php
        if ($CI->session->flashdata('updated_msg_error')) {
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . $CI->session->flashdata('updated_msg_error') . '</div>';
        };
      ?>

      <div class="box-body">
        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/banner/edit_banner'; ?>" enctype="multipart/form-data" >

          <input type="hidden" value="<?php echo $banner[0]->id ?>" name="banner_id">

          <div class="form-group">
            <label class="control-label col-sm-2">Image</label>
            <div class="col-sm-10">
              <input type="file" name="image" id="image">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Type</label>
            <div class="controls col-sm-10">
              <select id="type" name="type" class="form-control" required>
                <option value="">----Type----</option>
                <option value="web" <?php echo ($banner[0]->type == "web") ? "selected" : "" ?>>Web</option>
                <option value="mobile" <?php echo ($banner[0]->type == "mobile") ? "selected" : "" ?>>Mobile</option>
              </select>
              <?php echo form_error('type'); ?>
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