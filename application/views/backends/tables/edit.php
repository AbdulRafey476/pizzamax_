<?php
$CI =& get_instance();
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#name').focus();
	});
</script>
<div class="container box-wrapper">
	<form class="form-horizontal" id="form" method="post">
	<input type="hidden" id="id" name="id" value="<?php echo $obj[0]->id; ?>">
		<fieldset>
			<legend>
				<?php echo lang('msg_add_cities'); ?>
			</legend>
			<?php 
			if($CI->session->flashdata('msg_ok')){
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
			}
			?>

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_table_no'); ?></label>
				<div class="col-md-10">
					<input type="text" id="table_no" name="table_no" value="<?php echo $obj[0]->table_no; ?>" class="form-control" >
					<?php echo form_error('table_no'); ?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_number_of_places'); ?></label>
				<div class="col-md-10">
					<input type="text" id="number_of_places" name="number_of_places" value="<?php echo $obj[0]->number_of_places; ?>" class="form-control" >
					<?php echo form_error('number_of_places'); ?>
				</div>
			</div>

				<div class="form-group">
				<label class="control-label col-md-2"><?php echo lang('msg_description'); ?></label>
				<div class="col-md-10">
					<textarea class="form-control" id="description" name="description"><?php echo $obj[0]->description; ?></textarea>
					<?php echo form_error('description'); ?>
				</div>
			</div>


			<div class="form-group">
				<div class="col-md-10 col-md-offset-2">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save'); ?>
					</button>
					<input type="reset" class="btn" value="<?php echo lang('msg_reset'); ?>"/>
				</div>
			</div>

		</fieldset>
	</form>
</div>