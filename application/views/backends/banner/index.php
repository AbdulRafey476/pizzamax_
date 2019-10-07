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
      <h3 class="box-title">Add Banner</h3>

      <?php
        if ($CI->session->flashdata('msg_ok')) {
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . $CI->session->flashdata('msg_ok') . '</div>';
        };
      ?>

      <div class="box-body">
        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/banner/add_banner'; ?>" enctype="multipart/form-data" >

          <div class="form-group">
            <label class="control-label col-sm-2">Image</label>
            <div class="col-sm-10">
              <input type="file" name="image" id="image" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Type</label>
            <div class="controls col-sm-10">
              <select id="type" name="type" class="form-control" required>
                <option value="">----Type----</option>
                <option value="web">Web</option>
                <option value="mobile">Mobile</option>
              </select>
              <?php echo form_error('type'); ?>
            </div>
          </div>

          <div class="form-group">
            <div class="controls col-sm-offset-11">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>


<section class="content">
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Banners</h3>

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
              <th>Image</th>
              <th>Type</th>
              <th style="text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($banners as $banner): ?>

              <tr>
                <td><?php echo $banner->id ?></td>
                <td><img src="<?php echo $banner->path ?>" style="width: 100px; height: 30px;"></td>
                <td><?php echo $banner->type ?></td>
                <td style="text-align: center;"><a class="btn btn-sm btn-danger" onclick="banner_del('<?php echo $banner->id ?>')">Del</a> <a class="btn btn-sm btn-success" onclick="banner_edit('<?php echo $banner->id ?>')">Edit</a></td>
              </tr>

            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>


<script>
$(document).ready( function() {
  $(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		});
	});

  const banner_del = (id) => {
    if (confirm("Are you sure?")) {
      location.href = location.origin + "/admin/banner?delete=" + id
    }
  }

  const banner_edit = (id) => {
    location.href = location.origin + "/admin/banner?edit=" + id
  }
</script>