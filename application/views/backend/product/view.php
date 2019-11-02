<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Product Management
        <small>View Product</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <?php //pre($editData);die;?>
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Product Detail</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    
                        <div class="box-body">
                            <div class="row">
                                <table class="table">
                                    
                                    <tbody>
                                      <tr>
                                        <th>Category Name</th>
                                        <td><?php echo getCategoryNameByID($viewData->category_id)?></td>
                                      </tr>
                                      <tr>
                                        <th>Product Name</th>
                                        <td><?php echo $viewData->product_name?></td>
                                      </tr>
                                      <tr>
                                        <th>Product Image</th>
                                        <td><img class="img-fluid" src="<?php echo (isset($viewData->product_image) && $viewData->product_image!= '') ? base_url("assets/uploads/userprofile/thumbs/59x59/".$viewData->product_image) : base_url("assets/uploads/userprofile/thumbs/59x59/1464b2f1c785627abbe8c170caf227c6.jpg"); ?>" id="userprofileImage"></td>
                                      </tr>
                                      <tr>
                                        <th>Product Description</th>
                                        <td><?php echo $viewData->description?></td>
                                      </tr>
                                      <tr>
                                        <th>Created At</th>
                                        <td><?php echo $viewData->createdDtm?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                
                            </div>
                            
                        </div><!-- /.box-body -->
   
                    
                </div>
            </div>
            
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/backend/js/addProduct.js" type="text/javascript"></script>