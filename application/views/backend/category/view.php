<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Category Management
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
                        <h3 class="box-title">Category Detail</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    
                        <div class="box-body">
                            <div class="row">
                                <table class="table">
                                    
                                    <tbody>
                                      <tr>
                                        <th>Category Name</th>
                                        <td><?php echo $viewData->name?></td>
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
<script src="<?php echo base_url(); ?>assets/backend/js/addCategory.js" type="text/javascript"></script>