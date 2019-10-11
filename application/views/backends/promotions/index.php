<?php
$CI = &get_instance(); ?>

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
      <h3 class="box-title">Add Promotions</h3>

      <?php
      if ($CI->session->flashdata('msg_ok')) {
        echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>' . $CI->session->flashdata('msg_ok') . '</div>';
      };
      if ($CI->session->flashdata('msg_error')) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>' . $CI->session->flashdata('msg_error') . '</div>';
      };
      ?>

      <div class="box-body">
        <form class="form-horizontal" method="post" action="<?php echo base_url() . 'admin/promotions/add_promotion'; ?>" enctype="multipart/form-data">

          <div class="form-group">
            <label class="control-label col-sm-2">Name</label>
            <div class="controls col-sm-10">
              <input type="text" id="name" name="name" class="form-control" required>
              <?php echo form_error('name'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Description</label>
            <div class="controls col-sm-10">
              <input type="text" id="description" name="description" class="form-control" required>
              <?php echo form_error('description'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Type</label>
            <div class="controls col-sm-10">
              <select id="type" name="type" class="form-control" required>
                <option value="">----Type----</option>
                <option value="food">Food</option>
                <option value="deal">Deal</option>
              </select>
              <?php echo form_error('type'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Food</label>
            <div class="controls col-sm-10">
              <select id="food_id" name="food_id" value="" class="form-control" required>
                <option value="">----Foods----</option>
                <?php foreach ($foods as $f) { ?>
                  <option value="<?php echo $f->id ?>"><?php echo $f->name ?></option>
                <?php } ?>
              </select>
              <?php echo form_error('food_id'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Deal</label>
            <div class="controls col-sm-10">
              <select id="deal_id" name="deal_id" value="" class="form-control" required>
                <option value="">----Deals----</option>
                <?php foreach ($deals as $d) { ?>
                  <option value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
                <?php } ?>
              </select>
              <?php echo form_error('deal_id'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Start Date</label>
            <div class="controls col-sm-4">
              <input type="date" id="s_date" name="s_date" value="" class="form-control">
              <?php echo form_error('s_date'); ?>
            </div>

            <label class="control-label col-sm-2">End Date</label>
            <div class="controls col-sm-4">
              <input type="date" id="e_date" name="e_date" value="" class="form-control">
              <?php echo form_error('e_date'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Start Time</label>
            <div class="controls col-sm-4">
              <input type="time" id="s_time" name="s_time" value="" class="form-control">
              <?php echo form_error('s_time'); ?>
            </div>

            <label class="control-label col-sm-2">End Time</label>
            <div class="controls col-sm-4">
              <input type="time" id="e_time" name="e_time" value="" class="form-control">
              <?php echo form_error('e_time'); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Days</label>
            <div class="controls col-sm-10">
              <label class="checkbox-inline"><input type="checkbox" name="sunday" value="sunday">Sun</label>
              <label class="checkbox-inline"><input type="checkbox" name="monday" value="monday">Mon</label>
              <label class="checkbox-inline"><input type="checkbox" name="tuesday" value="tuesday">Tue</label>
              <label class="checkbox-inline"><input type="checkbox" name="wednesday" value="wednesday">Wed</label>
              <label class="checkbox-inline"><input type="checkbox" name="thursday" value="thursday">Thu</label>
              <label class="checkbox-inline"><input type="checkbox" name="friday" value="friday">Fri</label>
              <label class="checkbox-inline"><input type="checkbox" name="saturday" value="saturday">Sat</label>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Discount</label>
            <div class="controls col-sm-4">
              <input type="number" id="discount" name="discount" class="form-control" required>
              <?php echo form_error('discount'); ?>
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
    <!-- /.box-body -->
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
              <th>Name</th>
              <th>Description</th>
              <th>Type</th>
              <th>Food</th>
              <th>Deal</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Discounts</th>
              <th>Days</th>
              <th style="text-align: center;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($promotions as $promotion) : ?>
              <tr>
                <td><?php echo $promotion->id ?></td>
                <td><?php echo $promotion->name ?></td>
                <td><?php echo $promotion->description ?></td>
                <td><?php echo $promotion->type ?></td>
                <td><?php echo $promotion->foods ?></td>
                <td><?php echo $promotion->deals ?></td>
                <td><?php echo $promotion->time_s ?></td>
                <td><?php echo $promotion->time_e ?></td>
                <td><?php echo $promotion->date_s ?></td>
                <td><?php echo $promotion->date_e ?></td>
                <td><?php echo $promotion->discount ?></td>
                <td><?php echo $promotion->days ?></td>
                <td style="text-align: center;"><a class="btn btn-sm btn-danger" onclick="outlet_del('<?php echo $promotion->id ?>')">Del</a> <a class="btn btn-sm btn-success" onclick="outlet_edit('<?php echo $promotion->id ?>')">Edit</a></td>
              </tr>

            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
  const outlet_del = (id) => {
    if (confirm("Are you sure?")) {
      location.href = location.origin + "/admin/promotions?delete=" + id
    }
  }

  const outlet_edit = (id) => {
    location.href = location.origin + "/admin/promotions?edit=" + id
  }

  $('#type').change(function() {
    if ($(this).val() === "deal") {
      $("#food_id").attr("disabled", "disabled");
      $("#deal_id").removeAttr("disabled");
    } else {
      $("#deal_id").attr("disabled", "disabled");
      $("#food_id").removeAttr("disabled");
    }
  })
</script>