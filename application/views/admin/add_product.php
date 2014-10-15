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
                            <?php if(isset($product)) echo "Update product"; else echo "Add new product"; ?>
                          </header>
                          <div class="panel-body">
                              <div class=" form">
                                  <form class="cmxform form-horizontal tasi-form" id="addProduct" method="post" action="" enctype="multipart/form-data">
                                        <div class="form-group ">
                                            <label for="productcategory" class="control-label col-lg-2">Select category <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <select class="form-control" name="category">
                                                    <option value="">Select Category</option>
                                                    <?php
                                                    if(isset($categories) && (!empty($categories)))
                                                    {
                                                      foreach ($categories as $key => $category) {
                                                        if(isset($product) && ($category->ebay_cat_id==$product[0]->ebay_product_id)){
                                                            $selected = 'selected="selected"';
                                                        }else{
                                                            $selected = "";
                                                        }
                                                        echo '<option value="'. $category->ebay_cat_id .'"  '. $selected .' >'. ucfirst($category->category_name).'</option>';
                                                      }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <input class=" form-control" id="product_id" name="product_id" type="hidden" value="<?php if(isset($product)){ echo $product[0]->product_id;}?>" />
                                            <label for="product" class="control-label col-lg-2">Product title <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <input class=" form-control" id="product" name="product" minlength="2" type="text" placeholder="Enter product name" value="<?php if(isset($product)){ echo $product[0]->product_name;}?>" />
                                                <?php echo form_error('product');?>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="pdesc" class="control-label col-lg-2">Product description</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" id="pdesc" name="product_desc" ><?php if(isset($product)){ echo $product[0]->product_desc;}?></textarea> 
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="pprice" class="control-label col-lg-2">Product price <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="pprice" type="text" name="product_price"  placeholder="Enter product price" value="<?php if(isset($product)){ echo $product[0]->product_price;}?>" />
                                            </div>
                                        </div>
                                       <!--  <div class="form-group ">
                                            <label for="pstock" class="control-label col-lg-2">Product in stock <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="pstock" type="text" name="product_stock"  placeholder="Enter product quantity" value="<?php if(isset($product)){ echo $product[0]->product_stock;}?>" />
                                            </div>
                                        </div> -->
                                        <div class="form-group ">
                                            <label for="pimage" class="control-label col-lg-2">Product image</label>
                                            <div class="col-lg-10">
                                                <input id="pimage" type="file" name="file" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <!-- <button class="btn btn-danger" type="submit" name="addProduct">Save</button> -->
                                                <input type="submit" name="addProduct" value="Save" class="btn btn-danger">
                                                <a href="<?php echo base_url('admin/product');?>" class="btn btn-default" >Cancel</a>
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