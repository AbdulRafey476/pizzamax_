<section class="content-header">
  <h1>
	Dashboard
	<small><?php echo lang('send_push'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">
<div class="container-fluid">
	<!--end show alert messager-->
	<div class="row ">

        <form id="form" method="post" action="" enctype="multipart/form-data">
            
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo lang('send_push'); ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="push_content"><?php echo lang('push_content');?></label>
                  <textarea rows="6" name="content" placeholder="<?php echo lang('push_content_placeholder'); ?>" class="form-control" id="push_content"></textarea>
                  <p class="help-block"><?php echo lang('push_content_placeholder'); ?></p>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo lang('msg_send');?></button>
              </div>
            </form>
          </div>

      </form>
          

	</div>
</div>

</section>
