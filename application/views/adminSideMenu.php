<?php
/*
####################################################################
### file location - application/views/adminSideMenu.php     ########
### Developed by  - Sandeep singh                           ########
###                                                         ########
### Developer     - Sandeep Singh(sandy)                    ########
####################################################################
*/
?>
<!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a href="<?php echo base_url('admin/dashboard');?>">
                          <i class="icon-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
	                <li class="sub-menu">
	                    <a href="javascript:;">
	                        <i class="icon-tasks"></i>
	                        <span>Categories</span>
	                    </a>
	                    <ul class="sub">
	                        <li><a  href="<?php echo base_url('admin/add_categories');?>">Add Category</a></li>
	                        <li><a  href="<?php echo base_url('admin/categories');?>">Category List</a></li>
	                    </ul>
	                </li>
	                <li class="sub-menu">
	                    <a href="javascript:;">
	                        <i class="icon-tasks"></i>
	                        <span>Products</span>
	                    </a>
	                    <ul class="sub">
	                        <li><a  href="<?php echo base_url('admin/add_product');?>">Add Product</a></li>
	                        <li><a  href="<?php echo base_url('admin/product');?>">Product List</a></li>
	                    </ul>
	                </li>
	                <li>
	                    <a href="<?php echo base_url('admin/users');?>">
	                        <i class="icon-user"></i>
	                        <span>Users</span>
	                    </a>
	                </li>
                </ul>
              	<!-- sidebar menu end-->
          	</div>
      	</aside>
      	<!--sidebar end-->
      