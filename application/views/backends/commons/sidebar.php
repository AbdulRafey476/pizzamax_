<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <?php 
      if(isset($_SESSION['user'])){
        $user=$_SESSION['user'][0];
      }
      ?>
      <div class="pull-left image">
        <img src="<?php echo base_url().$user->avt;?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php
          echo $user->full_name;
          ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="<?php echo base_url().'admin/foods/search';?>" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="query" class="form-control search-query-sidebar" placeholder="Search foods...">
          <span class="input-group-btn">
            <button type="button" name="search" id="search-btn" class="btn btn-flat">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>

      <style type="text/css">
        .user-panel>.image>img{
          width: 50px;
          height: 50px;
          margin-top: 10px;
        }
      </style>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">GENERAL</li>
        <li>
          <a href="<?php echo base_url().'admin/dashboard';?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i>
            <span><?php echo lang('msg_settings')?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'admin/settings/general'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_general')?></a></li>
            <li><a href="<?php echo base_url().'admin/settings/mail'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_email')?></a></li>
            <!-- <li><a href="<?php echo base_url().'admin/settings/payments'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_payments')?></a></li> -->
            <li><a href="<?php echo base_url().'admin/settings/push'?>"><i class="fa fa-circle-o"></i> <?php echo lang('push')?></a></li>
          </ul>
        </li>
        <li class="header">TAXONOMY</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tags"></i>
            <span><?php echo lang('msg_categories')?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'admin/categories'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_categories')?></a></li>
            <li><a href="<?php echo base_url().'admin/categories/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_categories')?></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-arrows-alt"></i>
            <span><?php echo lang('msg_sizes')?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'admin/sizes'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_sizes')?></a></li>
            <li><a href="<?php echo base_url().'admin/sizes/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_size')?></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tags"></i>
            <span><?php echo lang('msg_deals')?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'admin/deal_categories/'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_deal_categories')?></a></li>
            <li><a href="<?php echo base_url().'admin/deals'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_deals')?></a></li>
            <li><a href="<?php echo base_url().'admin/deals/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_deal')?></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-plus-square"></i>
            <span><?php echo lang('msg_extras')?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'admin/extras'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_extras')?></a></li>
            <li><a href="<?php echo base_url().'admin/extras/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_extras')?></a></li>
          </ul>
        </li>
        
        <li class="header">LIST</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cutlery"></i>
            <span><?php echo lang('msg_food_list')?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'admin/foods'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_food_list')?></a></li>
            <li><a href="<?php echo base_url().'admin/foods/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_food')?></a></li>
          </ul>
        </li>
        
        <li class="header">USER</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span><?php echo lang('msg_users')?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'admin/users'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_users')?></a></li>
            <li><a href="<?php echo base_url().'admin/users/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_users')?></a></li>
          </ul>
        </li>

<!--         <li>
          <a href="<?php //echo base_url().'admin/order_time'?>">
            <i class="fa fa-list"></i>
            <span><?php //echo lang('msg_order_time')?></span>
          </a>
        </li> -->

        <li>
          <a href="<?php echo base_url().'admin/orders'?>">
            <i class="fa fa-list"></i>
            <span><?php echo lang('msg_order')?></span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url().'admin/contact'?>">
            <i class="fa fa-envelope"></i>
            <span><?php echo lang('msg_contact')?></span>
          </a>
        </li>
        
        <li>
          <a href="<?php echo base_url().'admin/promotions'?>">
            <i class="fa fa-envelope"></i>
            <span>Promotions</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url().'admin/banner'?>">
            <i class="fa fa-list"></i>
            <span>Banner</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url().'admin/outlets'?>">
            <i class="fa fa-list"></i>
            <span>Outlets</span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>