<section class="content-header">
  <h1>
	<?php echo lang('msg_settings'); ?>
	<small><?php echo lang('msg_general'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
    <li><a href="#"><?php echo lang('msg_settings'); ?></a></li>
	<li class="active"><?php echo lang('msg_general'); ?></li>
  </ol>
</section>

<section class="content">
<!--show alert messager-->
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo lang('msg_general'); ?></h3>
    </div>
    
	<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data">
		<fieldset>
			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_currency');?></label>
				<div class="col-md-10">
					<select name="currency" class="form-control">
						<?php if($list!=null)
						foreach($list as $r){
							?>
							<option value="<?php echo $r->id;?>" <?php if($r->id==$obj['currency_id']){echo 'selected';} ?> ><?php echo $r->currency_code;?>&nbsp;(<?php echo $r->name;?>)</option>
							<?php }?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_position');?></label>
					<div class="col-md-10" style="margin-top: -12px; margin-left: -19px;">
						<div class="checkbox">
							<label>
								<input type="radio" <?php if($obj['position']==CURRENCY_SYMBOL_BEFORE){echo 'checked';} ?>  class="position" name="position" value="<?php echo CURRENCY_SYMBOL_BEFORE?>"> <?php echo lang('msg_before'); ?>
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="radio"  <?php if($obj['position']==CURRENCY_SYMBOL_AFTER){echo 'checked';} ?>   class="position" name="position" value="<?php echo CURRENCY_SYMBOL_AFTER?>"> <?php echo lang('msg_after'); ?>
							</label>
						</div>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_tax');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="tax" id="tax" value="<?php echo $obj['tax']; ?>" placeholder="%">
					</div>
				</div>

				
				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_ship_fee');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="ship_fee" id="ship_fee" value="<?php echo $obj['ship_fee']; ?>" placeholder="$">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_term_and_conditions');?></label>
					<div class="controls col-md-10">
						<textarea rows="10" class="form-control" id="ga_code" name="terms_and_conditions"><?php echo $obj['terms_and_conditions']; ?></textarea>	
					</div>
				</div>
				

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_address');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" id="address" name="address" value="<?php echo $obj['address']; ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_address');?> 2</label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" id="sub_address" name="sub_address" value="<?php echo $obj['sub_address']; ?>">	
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_website');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="website" id="website" value="<?php echo $obj['website']; ?>" placeholder="%">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_twitter');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo $obj['twitter']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_facebook');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo $obj['facebook']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_instagram');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="instagram" id="instagram" value="<?php echo $obj['instagram']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_pinterest');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="pinterest" id="pinterest" value="<?php echo $obj['pinterest']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_google_plus');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="google_plus" id="google_plus" value="<?php echo $obj['google_plus']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_youtube');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="youtube" id="youtube" value="<?php echo $obj['youtube']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_mail');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="mail" id="mail" value="<?php echo $obj['mail']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_mail');?> 2</label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="sub_mail" id="sub_mail" value="<?php echo $obj['sub_mail']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_phone');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $obj['phone']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_phone');?> 2</label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="sub_phone" id="sub_phone" value="<?php echo $obj['sub_phone']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-2">
						<button type="submit" class="btn btn-primary" >
							<?php echo lang('msg_save');?>
						</button>
						<a href="<?php echo base_url();?>admin/settings/reset_general_settings" class="btn btn-default">
							<?php echo lang('reset_default');?>
						</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

</section>