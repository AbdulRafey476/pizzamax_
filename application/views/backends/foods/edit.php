<?php
$CI =& get_instance();
?>
<script type="text/javascript" src="<?php echo base_url()?>statics/tinymce/jquery.tinymce.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>statics/switchery/switchery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>statics/switchery/switchery.min.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>statics/jquery-tokeninput/jquery.tokeninput.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/jquery-tokeninput/token-input.css"/>

<style>
/* The container */
.custom_checkbox {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.custom_checkbox input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 14px;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.custom_checkbox:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.custom_checkbox input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.custom_checkbox input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.custom_checkbox .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>

<section class="content-header">
  <h1>
	<?php echo lang('msg_food'); ?>
	<small><?php echo lang('msg_edit_food'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
	<li><a href="#"><?php echo lang('msg_food'); ?></a></li>
	<li class="active"><?php echo lang('msg_edit_food'); ?></li>
  </ol>
</section>

<section class="content">
    <!--show alert messager-->
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo lang('msg_edit_food'); ?></h3>
        </div>
		
		
	<div>
		<?php
		if($CI->session->flashdata('msg_ok')){
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
		}
		?>
	</div>

	<form class="form-horizontal" id="form" method="post" enctype="multipart/form-data" action="<?php echo base_url().'admin/foods/edit_post';?>">

		<input type="hidden" name="id" value="<?php echo $obj[0]->id; ?>">
		<div class="form-group">
			<label class="control-label col-sm-2"><?php echo lang('msg_name');?></label>
			<div class="col-sm-10">
				<input type="text" value="<?php echo $obj[0]->name; ?>" class="form-control" id="name" name="name" value="<?php echo set_value('name')?>">
				<?php echo form_error('name');?>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_price')?></label>
			<div class="col-sm-10">
				<input type="text" id="price" value="<?php echo $obj[0]->price; ?>" class="form-control" name="price" value="<?php echo set_value('name')?>">
				<?php echo form_error('price')?>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_tag')?></label>
			<div class="col-sm-10">
				<input type="text" id="tag" class="form-control" name="tag" value="<?php echo $obj[0]->tag; ?>" placeholder="ex: bakery,socola..">
				<?php echo form_error('tag')?>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_categories')?></label>
			<div class="col-sm-10">
				<select id="categories" name="categories" class="form-control">
					<option value="">-----<?php echo lang('msg_categories')?>----</option>
					<?php foreach($categories as $r){?>
					<option value="<?php echo $r->id?>" <?php if($r->id==$obj[0]->categories_id){echo "selected" ;} ?>><?php echo $r->name?></option>
					<?php }?>
				</select>
				<?php echo form_error('categories')?>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="txtName"><?php echo lang('description')?></label>
			<div class="col-sm-10">
				<textarea id="description" name="description" class="form-control"><?php echo set_value('description')?><?php echo $obj[0]->description; ?></textarea>
				<?php echo form_error('content')?>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_images')?></label>
			<div class="col-sm-10">
				<img src="<?php echo ($obj[0]->image!=null)?$obj[0]->image:base_url()."statics/images/no_photo.png" ?>" width="200" height="200">
				<input type="file" name="image" id="image" style="margin-top:20px;">
				<?php if(isset($error['error_upload_file'])){?>
				<span class="help-inline msg-error" generated="true"><?php echo $error['error_upload_file']?></span>
				<?php }; ?>
			</div>
		</div>



		<div class="form-group">
			<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_sizes')?></label>
			<div class="col-sm-10">
				<?php
				function sizeInFood($food_sizes,$id){
					if($food_sizes!=null){
						foreach ($food_sizes as $r) {
							if($r->size_id==$id){
								return $r->price;
							}
						}
					}
					return -1;
				}
				if(isset($sizes) && $sizes!=null){
					foreach ($sizes as $r) {
						?>
						<div class="size-item"><?php echo $r->name; ?>
							<span>
								<input type="hidden" name="size_id_<?php echo $r->id ?>" value="<?php echo $r->id; ?>"/>
								<?php
								$price=sizeInFood($food_sizes,$r->id);
								if($price!=-1){
									?>
									<input class="form-control" placeholder="<?php echo $this->lang->line('msg_price'); ?>" type="number" min="0" step="1" name="size_<?php echo $r->id; ?>" value="<?php echo $price; ?>">
									<?php
								}else{
									?>
									<input class="form-control" placeholder="<?php echo $this->lang->line('msg_price'); ?>" type="number" min="0" step="1" name="size_<?php echo $r->id; ?>" value="">

									<?php
								}
								?>
							</span>
						</div>
						<?php
					}
				}
				?>
				<style type="text/css">
					.size-item{
						margin-top: 20px;
					}
					.size-item:first-child{
						margin-top: 5px;
					}
				</style>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_extras')?></label>
			<div class="col-sm-10">
				<input type="text" id="extras" class="form-control" name="extras" value="<?php echo set_value('extras')?>">
				<?php echo form_error('extras')?>
			</div>
		</div>


		<div class="form-group">
			<label class="control-label col-sm-2">Featured</label>

			<div class="col-sm-10">
				<input name="featured_offer" id="featured_offer" <?php if ($obj[0]->featured) echo "checked" ?> type="checkbox" value="true">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2"><?php echo lang('msg_active_offer')?></label>
			<div class="col-sm-10">
				<input type="checkbox" name="active_offer" <?php if($obj[0]->is_offered==1){echo 'checked';} ?> id="active_offer" class="js-switch"/>
			</div>
		</div>

		<div class="offer-wrapper"  <?php if($obj[0]->is_offered==1){echo 'style="display:block"';} ?>>
			<div class="form-group">
				<label class="control-label col-sm-2"><?php echo lang('msg_discount_percent');?></label>
				<div class="col-sm-10">
					<input type="text" <?php echo ($obj[0]->is_offered==1)?'enabled':'disabled'; ?> class="form-control offer" id="discount_percent" placeholder="%" name="discount_percent" value="<?php echo $obj[0]->discount_percent;?>">
					<?php echo form_error('discount_percent');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_offer_description');?></label>
				<div class="col-sm-10">
					<textarea cols="50" id="offer_description" <?php echo ($obj[0]->is_offered==1)?'enabled':'disabled'; ?>  name="offer_description" class="form-control offer"><?php echo $obj[0]->offer_description;?></textarea>
					<?php echo form_error('offer_description');?>
				</div>
			</div>
		</div>
		<!--end offer-->

		<div class="col-sm-10 col-sm-offset-2">
			<button type="submit" class="btn btn-primary" >
				<?php echo lang('msg_save')?>
			</button>
			<button type="reset" class="btn">
				<?php echo lang('msg_reset')?>
			</button>
		</div>
		<div style="display: block; clear: both">
			<input type="hidden" value="" name="extras_list" id="extras_list">
		</div>
	</form>
</div>
<!--end form-->

<!--end container fluid-->

</section>

<script type="text/javascript">
	var elem = document.querySelector('.js-switch');
	var init = new Switchery(elem);

	elem.onchange = function() {
		if(elem.checked){
			$('.offer').attr('disabled',false);
			$('.offer-wrapper').slideDown();
		}else{
			$('.offer').attr('disabled',true);
			$('.offer-wrapper').slideUp();
		}
	};
	<?php
	$settings= getSettings(GENERAL_SETTING_FILE);
	$position=$settings['position'];
	$currency = $settings['currency_symbol'];
	?>


	function removeA(arr) {
		var what, a = arguments, L = a.length, ax;
		while (L > 1 && arr.length) {
			what = a[--L];
			while ((ax= arr.indexOf(what)) !== -1) {
				arr.splice(ax, 1);
			}
		}
		return arr;
	}

	$(document).ready(function () {
		var extras=[];
		$("#extras").tokenInput(
			"<?php echo base_url() ?>api/extras_api/extras",
			{
				resultsFormatter: function(item) {
					var item='<li>'+item.name+'<span style="float:right">'+
					<?php if($position==0){
						echo '\''.$currency.'\'';
					}
					?>
					+
					item.price
					+
					<?php
					if($position==1){
						echo '\''.$currency.'\'';
					}
					?>
					'</span></li>';
					return item;
				},
				tokenFormatter:function(item){
					var item='<li>'+item.name+' - '+
					<?php if($position==0){
						echo '\''.$currency.'\'';
					}
					?>
					+
					item.price
					+
					<?php
					if($position==1){
						echo '\''.$currency.'\'';
					}
					?>
					'</li>';
					return item;
				},
				onAdd:function(item){
					extras.push(item.id);
					$('#extras_list').val(JSON.stringify(extras));
				},
				onDelete:function(item){
					removeA(extras,item.id);
					$('#extras_list').val(JSON.stringify(extras));
				},
				preventDuplicates:true
			}
			);

		<?php
		if($food_extras!=null){
			foreach ($food_extras as $r) {
				?>
				$('#extras').tokenInput("add", {id: '<?php echo $r->extra_id  ?>',name:'<?php echo $r->name ?>', price:'<?php echo $r->price; ?>'});
				<?php
			// return;
			}
		}
		?>
	});
</script>
<style type="text/css">
	.offer-wrapper{
		display: none;
	}
</style>
