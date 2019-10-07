<section class="content-header">
  <h1>
	<?php echo lang('msg_dashboard'); ?>
	<small><?php echo lang('msg_users'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
	<li class="active"><?php echo lang('msg_users'); ?></li>
  </ol>
</section>

<section class="content">
		
	<div class="page-header controls-wrapper">
		<a href="<?php echo base_url().'admin/orders?filter=received'?>" class="btn btn-primary"><?php echo lang('msg_received')?></a>
		<a href="<?php echo base_url().'admin/orders?filter=pending'?>" class="btn btn-warning"><?php echo lang('msg_pending')?></a>
	</div>

	<!--show alert messager-->
	<h4>
		<?php if(isset($data['search_title']))
		echo $data['search_title'];
		?>
	</h4>
	<!--end show alert messager-->
    <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?php echo lang('msg_users'); ?></h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="search-query form-control pull-right" placeholder="<?php echo lang('msg_search');?>" value="<?php echo (isset($_GET['query'])) ? $_GET['query'] : ''; ?>">
              
                <script type="text/javascript">
                $('.search-query').keypress(function(e) {
                    var code = (e.keyCode ? e.keyCode : e.which);
                    if (code == 13) {
                        var q = $('.search-query').val();
                        if (q != "") {
                            location.href ="<?php echo base_url().'admin/orders/search';?>?query=" + q;
                        }
                    }
                })
                </script>
             
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody>
            <tr>
              <th width="100px" style="text-align:center"><a href=""><?php echo lang('msg_id');?></a></th>
              <th><?php echo lang('msg_customer_name')?></th>
              <th><?php echo lang('msg_phone')?></th>
              <th><?php echo lang('msg_address')?></th>
              <th><?php echo lang('msg_status')?></th>
              <th width="120px"><?php echo lang('msg_invoice')?></th>
            </tr>
            <?php if(isset($list) && $list!=null)
            foreach($list as $r){?>
                <tr>
                    <td style="text-align:center;"><?php echo $r->id;?></td>
                    <td><?php echo $r->full_name; ?></td>
                    <td><?php echo $r->phone; ?></td>
                    <td><?php echo $r->address; ?></td>
                    <td>
                    <span class="label label-info"><?=lang('status_'.$r->status);?></span>
                    </td>
                    <td>
                        <a href="<?php echo base_url() ?>admin/orders/detail?id=<?php echo $r->id ?>" class="btn btn-danger"><?php echo lang('msg_check'); ?></a>
                    </td>
                </tr>
                <?php }?>
          </tbody></table>
          <center><?php if(isset($page_link)) echo $page_link;?></center>
        </>
        <!-- /.box-body -->
      </div>
</section>