  <div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Edit Category</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/update_cat', $attributes); ?>
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Category Name</label>

                          <input  type="hidden" id="first-name" name="cat_id" value="<?php echo $food_cat->id; ?>" class="form-control">

                        <input  type="text" id="first-name" name="cat_name" value="<?php echo $food_cat->cat_name ; ?>" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Category Image</label>
                          <input  type="file" id="first-name" name="img_path" value="" class="form-control">
                          </div>
                        </div>
         
          
                        <div class="col-sm-12">             
                      <div class="form-group">
                      <label class="col-sm-4">Category Description</label>
                       <textarea name="desc" class="form-control"><?php echo $food_cat->cat_desc ; ?></textarea>
                          </div>
                        </div>
                <div class="ln_solid"></div>
                    <div class="form-group">
                    <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
              
             </div>
           </div>
         </div>
        </div>
      </div>
      