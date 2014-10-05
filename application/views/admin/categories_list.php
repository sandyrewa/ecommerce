<?php
/*
####################################################################
### file location - application/views/admin/categories.php  ########
### Developed by  - Sandeep singh                           ########
###                                                         ########
### Developer     - Sandeep Singh(sandy)                    ########
####################################################################
*/

?>
<div class="hide">
    <!-- actions for datatables -->
    <div class="user_actions">
        <div class="btn-group">
            <button class="btn btn-default" type="button">Action</button>
            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul role="menu" class="dropdown-menu">
                <li><a class="deleteAll" data-tableid="dt_users" title="dtable" href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                <li><a href="javascript:void(0)" class="community_activate" ><i class="fa fa-check"></i> Active</a></li>
                <li><a href="javascript:void(0)" class="community_deactivate"  ><i class="fa fa-times"></i> Inactive</a></li>
            </ul>
        </div><!-- /btn-group -->
    </div>
</div>
<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Dynamic Table
                          </header>
                          <div class="panel-body">
                                <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="category">
                                      <thead>
                                      <tr>
                                          <th><input type="checkbox" name="checkAll" id="selectall"></th>
                                          <th>Categotry</th>
                                          <th>Created Date</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      
                                      </tbody>
                                      
                                    </table>
                                </div>
                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->