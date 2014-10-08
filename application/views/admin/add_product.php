<?php
/*
######################################################################
### file location - application/views/admin/add_product.php   ########
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
                              Add new product
                          </header>
                          <div class="panel-body">
                              <div class=" form">
                                  <form class="cmxform form-horizontal tasi-form" id="addProduct" method="post" action="">
                                        <div class="form-group ">
                                            <label for="productcategory" class="control-label col-lg-2">Select category <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <select class="form-control" name="category">
                                                    <option value="">Select Category</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="pname" class="control-label col-lg-2">Product title <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <input class=" form-control" id="pname" name="product" minlength="2" type="text" placeholder="Enter product name" value="" />
                                                <?php echo form_error('product');?>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="pdesc" class="control-label col-lg-2">Product description</label>
                                            <div class="col-lg-10">
                                                <input class="form-control " id="pdesc" type="text" name="product_long_desc" placeholder="Enter product description" value="" />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="pprice" class="control-label col-lg-2">Product price <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <input class="form-control " id="pprice" type="text" name="product_price"  placeholder="Enter product price"value="" />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="pstock" class="control-label col-lg-2">Product in stock <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <input class="form-control " id="pstock" type="text" name="product_stock"  placeholder="Enter product quantity"value="" />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="pimage" class="control-label col-lg-2">Product image</label>
                                            <div class="col-lg-10">
                                                <input id="pimage" type="file" name="file" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-danger" type="submit" name="addCat">Save</button>
                                                <a href="<?php echo base_url('admin');?>" class="btn btn-default" >Cancel</a>
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