<?php
$CI = &get_instance();; ?>

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

    #img-upload {
        width: 100%;
    }
</style>

<section class="content-header">
    <h1>
        <?php echo lang('msg_dashboard'); ?>
        <small>Outlets</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
        <li class="active">Outlets</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Add Outlets</h3>

            <?php
            if ($CI->session->flashdata('msg_ok')) {
                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . $CI->session->flashdata('msg_ok') . '</div>';
            };
            if ($CI->session->flashdata('msg_error')) {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . $CI->session->flashdata('msg_error') . '</div>';
            };
            ?>

            <div class="box-body">
                <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/outlets/add_outlets'; ?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="control-label col-sm-2">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                            <?php echo form_error('title'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                            <?php echo form_error('address'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                            <?php echo form_error('city'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Contact</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="contact" name="contact" placeholder="Contact" required>
                            <?php echo form_error('contact'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Latitude</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lat" name="lat" placeholder="Latitude" required>
                            <?php echo form_error('lat'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Longitude</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lon" name="lon" placeholder="Longitude" required>
                            <?php echo form_error('lon'); ?>
                        </div>
                    </div>

                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Outlets</h3>

      <?php
        if ($CI->session->flashdata('msg_ok_del')) {
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . $CI->session->flashdata('msg_ok_del') . '</div>';
        };

        if ($CI->session->flashdata('msg_ok_update')) {
          echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . $CI->session->flashdata('msg_ok_update') . '</div>';
        };
      ?>

      <div class="box-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Address</th>
              <th>City</th>
              <th>Contact</th>
              <th>Lat</th>
              <th>Lon</th>
              <th style="text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($outlets as $outlet): ?>
              <tr>
                <td><?php echo $outlet->id ?></td>
                <td><?php echo $outlet->title ?></td>
                <td><?php echo $outlet->address ?></td>
                <td><?php echo $outlet->city ?></td>
                <td><?php echo $outlet->contact ?></td>
                <td><?php echo $outlet->lat ?></td>
                <td><?php echo $outlet->lon ?></td>
                <td style="text-align: center;"><a class="btn btn-sm btn-danger" onclick="outlet_del('<?php echo $outlet->id ?>')">Del</a> <a class="btn btn-sm btn-success" onclick="outlet_edit('<?php echo $outlet->id ?>')">Edit</a></td>
              </tr>

            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
  const outlet_del = (id) => {
    if (confirm("Are you sure?")) {
      location.href = location.origin + "/admin/outlets?delete=" + id
    }
  }

  const outlet_edit = (id) => {
    location.href = location.origin + "/admin/outlets?edit=" + id
  }
</script>