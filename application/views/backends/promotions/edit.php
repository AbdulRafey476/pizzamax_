<?php
$CI = &get_instance(); ?>

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<section class="content-header">
  <h1>
    <?php echo lang('msg_dashboard'); ?>
    <small>Promotions</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
    <li class="active">Promotions</li>
  </ol>
</section>

<section class="content">

  <h4>
    <?php if (isset($search_title)) { ?>
      <?php echo $search_title; ?>
    <?php }; ?>
  </h4>

  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Edit Promotions</h3>

      <?php
      if ($CI->session->flashdata('updated_msg_error')) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . $CI->session->flashdata('updated_msg_error') . '</div>';
      };
      ?>

      <div class="box-body">
        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/promotions/edit_promotion'; ?>" enctype="multipart/form-data">

          <input type="hidden" value="<?php echo $promotion[0]->id ?>" name="promotion_id">

          <div class="form-group">
            <label class="control-label col-sm-2">Name</label>
            <div class="controls col-sm-10">
              <input type="text" id="name" name="name" class="form-control" required value="<?php echo $promotion[0]->name ?>">
              <?php echo form_error('name'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Description</label>
            <div class="controls col-sm-10">
              <input type="text" id="description" name="description" class="form-control" required value="<?php echo $promotion[0]->description ?>">
              <?php echo form_error('description'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Type</label>
            <div class="controls col-sm-10">
              <select id="type" name="type" class="form-control" required>
                <option value="">----Type----</option>
                <option <?php echo ($promotion[0]->type == "food") ? "selected" : ""  ?> value="food">Food</option>
                <option <?php echo ($promotion[0]->type == "deal") ? "selected" : ""  ?> value="deal">Deal</option>
              </select>
              <?php echo form_error('type'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Food</label>
            <div class="controls col-sm-10">
              <select <?php echo (!$promotion[0]->food_id) ? "disabled" : ""  ?> id="food_id" name="food_id" value="" class="form-control" required>
                <option value="">----Foods----</option>
                <?php foreach ($foods as $f) { ?>
                  <option <?php echo ($promotion[0]->food_id == $f->id) ? "selected" : ""  ?> value="<?php echo $f->id ?>"><?php echo $f->name ?></option>
                <?php } ?>
              </select>
              <?php echo form_error('food_id'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Deal</label>
            <div class="controls col-sm-10">
              <select <?php echo (!$promotion[0]->deal_id) ? "disabled" : ""  ?> id="deal_id" name="deal_id" value="" class="form-control" required>
                <option value="">----Deals----</option>
                <?php foreach ($deals as $d) { ?>
                  <option <?php echo ($promotion[0]->deal_id == $d->id) ? "selected" : ""  ?> value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
                <?php } ?>
              </select>
              <?php echo form_error('deal_id'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Start Date</label>
            <div class="controls col-sm-4">
              <input type="text" id="s_date" name="s_date" value="<?php echo $promotion[0]->date_s ?>" class="form-control">
              <?php echo form_error('s_date'); ?>
            </div>

            <label class="control-label col-sm-2">End Date</label>
            <div class="controls col-sm-4">
              <input type="text" id="e_date" name="e_date" value="<?php echo $promotion[0]->date_e ?>" class="form-control">
              <?php echo form_error('e_date'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Start Time</label>
            <div class="controls col-sm-4">
              <input type="text" id="s_time" name="s_time" value="<?php echo $promotion[0]->time_s ?>" class="form-control">
              <?php echo form_error('s_time'); ?>
            </div>

            <label class="control-label col-sm-2">End Time</label>
            <div class="controls col-sm-4">
              <input type="text" id="e_time" name="e_time" value="<?php echo $promotion[0]->time_e ?>" class="form-control">
              <?php echo form_error('e_time'); ?>
            </div>
          </div>

          <div class="form-group">

            <div id="days_div" style="display:none;"><?php echo $promotion[0]->days ?></div>

            <label class="control-label col-sm-2">Days</label>

            <div class="controls col-sm-10" id="days_dropdown"></div>

          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Discount</label>
            <div class="controls col-sm-4">
              <input type="number" id="discount" name="discount" class="form-control" value="<?php echo $promotion[0]->discount ?>" required>
              <?php echo form_error('discount'); ?>
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
    <!-- /.box-body -->
  </div>
</section>


<script>
  $('#type').change(function() {
    if ($(this).val() === "deal") {
      $("#food_id").attr("disabled", "disabled");
      $("#deal_id").removeAttr("disabled");
    } else {
      $("#deal_id").attr("disabled", "disabled");
      $("#food_id").removeAttr("disabled");
    }
  })

  $(document).ready(function() {
    let data = $("#days_div").html()
    data = data.split(",");

    const data_obj = [];

    var days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"]

    var days_to_show = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"]

    for (let i = 0; i < days.length; i++) {
      if (data[i] == days[i]) {
        data_obj.push(`<label class="checkbox-inline"><input type="checkbox" name="${days[i]}" checked value="${days[i]}">${days_to_show[i]}</label>`)
      } else {
        data_obj.push(`<label class="checkbox-inline"><input type="checkbox" name="${days[i]}" value="${days[i]}">${days_to_show[i]}</label>`)
      }
    }

    $("#days_dropdown").html(data_obj.join(" "))

  });

  $('#s_date').datepicker({
    uiLibrary: 'bootstrap'
  });

  $('#e_date').datepicker({
    uiLibrary: 'bootstrap'
  });

  $('#s_time').timepicker();
  $('#e_time').timepicker();

</script>