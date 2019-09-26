<div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Edit Product</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/update_product', $attributes); ?>
                           
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Product Name</label>
                          <input  type="hidden"  name="pro_id" required="required" value="<?php echo $product_info->id;?>" class="form-control">
                        <input  type="text" id="first-name" name="name" required="required" value="<?php echo $product_info->pro_name;?>" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                         <div class="form-group">
                          <label class="col-sm-4">Quantity</label>
                        <input  type="number" id="first-name" name="quantity" required="required" value="<?php echo $product_info->quantity;?>" class="form-control">
                          </div>
                        </div>

                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Measurement</label>
                          <select name="meas_pub_id" required="required"  class="form-control" >
                            <?php 
                            if(count($measurement)>0){
                            foreach($measurement as $measurementData){?>
                            <option value="<?= $measurementData->meas_pub_id;?>"><?= ucfirst($measurementData->meas_title);?></option>   
                          <?php } } ?>
                          </select>
                        </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="col-sm-4">Company</label>
                            <select name="company_id" required="required"  class="form-control" >
                              <?php 
                              if(count($company)>0){
                              foreach($company as $company){?>
                              <option <?php if($measurementData->company_id = $company->id) {echo "selected"; } ?> value="<?= $company->id;?>"><?= ucfirst($company->com_name);?></option>   
                            <?php } } ?>
                            </select>
                          </div>
                          </div>
                       </div>
                    <div class="ln_solid"></div>
                    <div class="form-group" style="margin-top: 27px;">
                    <div class="col-md-6">
                    <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            </div> 
              
             </div>
           </div>
         </div>

              </div>
            </div>

        