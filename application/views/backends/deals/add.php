<?php
$CI =& get_instance();?>
<script type="text/javascript">
var counter = 0,listCounter=0,data = JSON.parse('<?php echo json_encode($foods); ?>'),list = [];
jQuery(document).ready(function($) {
	$('#name').focus();
    $(document).on('change', '#item', function(){
        var v = $(this).val();
        $("#itemSize option").remove();
        for(var i = 0; i < data.length; i++) {
            if(data[i]['id'] == v) {
                var opt = '<option selected value=""  data-name=""><?php echo lang('msg_select_size'); ?></option>';
                for(var ia = 0; ia < data[i]['size'].length; ia++) {
                    opt += '<option value="'+data[i]['size'][ia]['id']+'">'+data[i]['size'][ia]['name']+'</option>';
                }
                $("#itemSize").append(opt); return;
            }
        }
        
    });
    
    $(document).on('click','.add-list',function(){
        // numArray = numArray.sort((a, b) => a - b);
        //#listSort, #listLimit, .listings 
        if($("#listSort").val() == '' || $("#listMinLimit").val() == '' || $("#listMaxLimit").val() == '') {
            alert("Please enter list number and list selection limit");
            return;
        }
        var cl = listCounter;
        var tr = '<tr class="list-'+cl+'">';
        tr += '<td>'+$("#listSort").val()+'</td>';
        tr += '<td>'+$("#listMinLimit").val()+'</td>';
        tr += '<td>'+$("#listMaxLimit").val()+'</td>';
        tr += '<td><button class="btn btn-danger remove-list" data-list="list-'+cl+'" type="button"><?php echo lang('msg_remove'); ?></button></td>'
        tr += '<input type="hidden" name="list['+cl+'][title]" value="'+$("#listSort").val()+'">';
        tr += '<input type="hidden" name="list['+cl+'][min]" value="'+$("#listMinLimit").val()+'">';
        tr += '<input type="hidden" name="list['+cl+'][max]" value="'+$("#listMaxLimit").val()+'">';
        tr += '</tr>';
        $(".listings").append(tr);
        $("#selectList").append('<option data-list="list-'+cl+'" value="'+$("#listSort").val()+'">'+$("#listSort").val()+'</option>');
        listCounter++;
    })
    $(document).on('click','.remove-list',function(){
        var rm = $(this).data('list');
        $("#selectList option[data-list='"+rm+"']").remove();
        $("tr."+rm).remove();
    })

    $(".add-item").on("click",function(){
        var item = $("#item option:selected").text();
        var itemS = $("#itemSize option:selected").text();
        var sList = $("#selectList option:selected").text();
        if($("#item option:selected").val() == "" || $("#itemSize option:selected").val() == "" || $("#selectList option:selected").val() == "") {
            alert('Please make sure you have selected item and item size.');
            return false;
        }
        var c = counter;
        var html = '<tr class="item-'+c+'">';
        html += '<td>'+item+'</td>';
        html += '<td>'+itemS+'</td>';
        html += '<td>'+sList+'</td>';
        html += '<td><button class="btn btn-danger remove-item" data-item="item-'+c+'" type="button"><?php echo lang('msg_remove'); ?></button></td>';
        html += '<input type="hidden" class="item-'+c+'" name="item['+c+'][food_id]" value="'+$("#item option:selected").val()+'" />';
        html += '<input type="hidden" class="item-'+c+'" name="item['+c+'][name]" value="'+item+'" />';
        html += '<input type="hidden" class="item-'+c+'" name="item['+c+'][size]" value="'+$("#itemSize option:selected").val()+'" />';
        html += '<input type="hidden" class="item-'+c+'" name="item['+c+'][list]" value="'+$("#selectList option:selected").val()+'" />';
        html += '</tr>';
        $('tbody.items-list').append(html);
        counter++;
        $("#item option:selected").hide();
        $("#item option:selected").prop('selected', false);
    });
    $(document).on("click", ".remove-item",function(){
        var item = $(this).data('item');
        for(var i = 0; i < $("#item option").length; i++) {
            if($($("#item option")[i]).text() == $("tr."+item).children('td:first').text()){
                $($("#item option")[i]).removeAttr('style');
            }
        }
        $('.'+item).closest('.clearfix').remove();
        $('.'+item).remove();
    });
});

</script>

<section class="content-header">
  <h1>
	<?php echo lang('msg_deals'); ?>
	<small><?php echo lang('msg_add_deal'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
	<li><a href="#"><?php echo lang('msg_deals'); ?></a></li>
	<li class="active"><?php echo lang('msg_add_deal'); ?></li>	
  </ol>
</section>

<section class="content">
    <!--show alert messager-->
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo lang('msg_add_deal'); ?></h3>
        </div>

	<div>
		<?php
		if($CI->session->flashdata('msg_ok')){
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
		}
		;?>
	</div>

	<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data" >
		<div class="form-group">
			<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_name');?></label>
			<div class="controls col-sm-10">
				<input type="text" id="name" name="name" value="" class="form-control">
				<?php echo form_error('name');?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="txtName"><?php echo "Description"  ?></label>
			<div class="controls col-sm-10">
				<input type="text" id="description" name="description" value="" class="form-control">
				<?php echo form_error('description');?>
			</div>
		</div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="listitem"><?php echo lang('msg_list_item'); ?></label>
            <div class="col-sm-10">
                <span class="input-group-addon">
                    <input type="text" placeholder="<?php echo lang('msg_list_title'); ?>" class="form-control" id="listSort" />
                </span>
                <span class="input-group-addon">
                    <input type="number" placeholder="<?php echo lang('msg_list_min_limit'); ?>" min="1" step="1" class="form-control" id="listMinLimit" />
                </span>
                <span class="input-group-addon">
                    <input type="number" placeholder="<?php echo lang('msg_list_max_limit'); ?>" min="1" step="1" class="form-control" id="listMaxLimit" />
                </span>
                <span class="input-group-btn input-group-addon">
                    <button class="btn btn-default add-list" type="button"><?php echo lang('msg_add'); ?></button>
                </span>
                <div class="table-responsive">
                <table class="table">              
                    <thead>
                        <tr>
                            <th>List Title</th>
                            <th><?=lang('msg_list_min_limit');?></th>
                            <th><?=lang('msg_list_max_limit');?></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="listings">

                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="items"><?php echo lang('msg_deal_items');?></label>
			<div class="col-sm-10 items-list">
                <div class="">
                    <span class="input-group-addon">
                        <select id="item" class="form-control">
                            <option selected value="" data-name=""><?php echo lang('msg_select_items'); ?></option>
                            <?php foreach($foods as $food): ?>
                            <option data-name="<?=$food->name;?>" value="<?=$food->id;?>"><?=$food->name;?></option>
                            <?php endforeach; ?>
                        </select>
                    </span>
                    <span class="input-group-addon">
                        <select id="itemSize" class="form-control">
                        <option selected value=""  data-name=""><?php echo lang('msg_select_item_first'); ?></option>
                        </select>
                    </span>
                    <span class="input-group-addon">
                        <select id="selectList" class="form-control">
                            <option value="" disabled selected>Select List</option>
                        </select>
                    </span>
                    <span class="input-group-btn input-group-addon">
                        <button class="btn btn-default add-item" type="button"><?php echo lang('msg_add'); ?></button>
                    </span>
                </div>
                <div class="table-responsive">
                <table class="table">              
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Size</th>
                            <th>List</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="items-list">
                    </tbody>
                </table>
                </div>
			</div>
        </div>
        <div class="form-group">
			<label class="control-label col-sm-2" for="selCat"><?php echo lang('msg_select_category');?></label>
			<div class="controls col-sm-10">
				<select name="cat" id="selCat" class="form-control">
                    <?php foreach($categories as $cat): ?>
                    <option value="<?=$cat->id;?>"><?=$cat->name;?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo form_error('cat');?>
			</div>
		</div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_images')?></label>
            <div class="col-sm-10">
                <input type="file" name="image" id="image">
                <?php if(isset($error['error_upload_file'])){?>
                    <span class="help-inline msg-error" generated="true"><?php echo $error['error_upload_file']?></span>
                    <?php }; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="txtPrice"><?php echo lang('msg_price')?></label>
            <div class="col-sm-10">
                <input type="number" name="price" id="txtPrice" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label style="text-align:left;" class="control-label col-sm-offset-2 col-sm-10" for="isActive">
                <input type="checkbox" name="isActive" id="isActive" />
                <?php echo lang('msg_is_active'); ?>
            </label>
        </div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<button type="submit" class="btn btn-primary" >
					<?php echo lang('msg_save');?>
				</button>
				<button type="reset" class="btn"><?php echo lang('msg_reset');?></button>
			</div>
		</div>
	</form>
	<!--end form-->
	<!--end container fluid-->

</div>
</section>