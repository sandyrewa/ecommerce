<?php
/*
######################################################################
### file location - application/views/admin/add_category.php  ########
### Developed by  - Sandeep singh                             ########
###                                                           ########
### Developer     - Sandeep Singh(sandy)                      ########
######################################################################
*/

?>
<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Add new category
                          </header>
                          <div class="panel-body">
                              <div class=" form">
                                  <form class="cmxform form-horizontal tasi-form" id="addCategory" method="post" action="">
                                        <div class="form-group ">
                                            <label for="cname" class="control-label col-lg-2">Category Name (required)</label>
                                            <div class="col-lg-10">
                                                <input class=" form-control" id="cname" name="category" minlength="2" type="text" required />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="cdesc" class="control-label col-lg-2">categoru Description (optional)</label>
                                            <div class="col-lg-10">
                                                <input class="form-control " id="cdesc" type="text" name="category_description" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-danger" type="submit" name="addCat">Save</button>
                                                <button class="btn btn-default" type="button">Cancel</button>
                                            </div>
                                        </div>
                                  </form>
                              </div>

                          </div>
                      </section>
                  </div>
              </div>
          </section>
      </section>