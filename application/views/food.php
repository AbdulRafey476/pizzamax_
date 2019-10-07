<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/bootstrap/css/bootstrap-responsive.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<img src="<?php echo $obj->image; ?>" style="width:100%">
			<div>
				<h4><?php echo $obj->name; ?></h4>
				<?php if($obj->is_offered==0){ ?>
				<h5>
					<?php echo format_money($obj->price); ?>
				</h5>
				<?php }else{
					?>
					<h5 style="text-decoration: line-through;">
						<?php echo format_money($obj->price); ?>
					</h5>
					<h5>
						<?php echo format_money($obj->price - ($obj->price*$obj->discount_percent)/100); ?>
					</h5>
					<?php 
				}
				?>
				<p><?php 
					echo $obj->description;
					?>
				</p>
			</div>
		</div>
	</div>
	
</body>
</html>