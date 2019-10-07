<?php
$CI =& get_instance();
?>
<section class="content-header">
    <h1>
        <?php echo lang('msg_order'); ?>
        <small>
            <?php echo lang('msg_order_no'); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">
                <?php echo lang('msg_dashboard'); ?></a></li>
        <li><a href="#">
                <?php echo lang('msg_order'); ?></a></li>
        <li class="active">
            <?php echo lang('msg_order_no'); ?>
        </li>

    </ol>
</section>

<section class="content">
    <!--show alert messager-->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?php echo lang('msg_order_no'); ?> <a href="#">#
                    <?php echo $obj->id; ?></a></h3>
        </div>

        <div class="info" style="padding: 20px 0;">
            <div class="row">
                <div class="col-md-6">
                    <div class="table table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <?php echo lang('msg_secret_code'); ?>
                                </td>
                                <td><strong>
                                        <?=strtoupper(uniqid('PM'));?></strong></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo lang('msg_customer_name') ?>
                                </td>
                                <td><strong>
                                        <?php echo $obj->full_name; ?></strong></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo lang('msg_phone') ?>
                                </td>
                                <td><strong>
                                        <?php echo $obj->phone; ?></strong></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo lang('msg_address') ?>
                                </td>
                                <td><strong>
                                        <?php echo $obj->address; ?></strong></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo lang('msg_message') ?>
                                </td>
                                <td><strong>
                                        <?php echo $obj->message; ?></strong></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo lang('msg_status') ?>
                                </td>
                                <td>
                                    <form id="order_status_form" method="post" action="<?php echo base_url().'admin/orders/status_update';?>">
                                        <input type="hidden" id="order_id" name="order_id" value='<?php echo $obj->id; ?>'>
                                        <select name="order_status" id="order_status">
                                            <option <?php if($obj->status==0){ print ' selected'; }?> value="0">Pending</option>
                                            <option <?php if($obj->status==1){ print ' selected'; }?> value="1">Accepted</option>
                                            <option <?php if($obj->status==2){ print ' selected'; }?> value="2">Dispatched</option>
                                            <option <?php if($obj->status==3){ print ' selected'; }?> value="3">Delivered</option>
                                        </select>
                                    </form>                                   
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table table-responsive">
                        <p id="total_items" style="display:none;"><?php echo $obj->content; ?></p>
                        <table class="table table-bordered">
                            <tr>
                                <th>Details</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                            <tr>
                                
                                <td id="total_items_display"></td>
                                <td><?php echo $obj->total; ?></td>
                                <th></th>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.box-body -->
    </div>


    <!--end container fluid-->

</section>

<style type="text/css">
    .info {
        margin-left: 20px;
    }

    .info p {
        font-size: 16px;
    }
</style>

<script>
    $("#order_status").change(function () {
        $("#order_status_form").submit()
    })
    
    var total_items_display = $("#total_items_display");
    
    var total_items = JSON.parse($("#total_items").html());
    
    var items = [];
    
    for (i = 0; i < total_items.length; i++) {
        items.push(`<p>${total_items[i].name} - (${total_items[i].quantity})</p>`)
    }

    total_items_display.html(items.join(" "))
</script>