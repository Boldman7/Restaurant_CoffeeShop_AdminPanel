  <div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Edit Purchase</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form1', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/update_inventory', $attributes); ?>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <input  type="hidden" id="" name="inv_pub_id" required="required" value="<?php echo $inventory_info->inv_pub_id;?>" class="form-control">
                          <label class="col-sm-4">Supplier</label>
                          <select name="sup_pub_id" required="required"  class="form-control" >
                            <option value="">Please Select Category</option>
                            <?php 
                            if(count($supplier)>0){
                            foreach($supplier as $supplierData){?>
                            <option <?php if($supplierData->sup_pub_id == $inventory_info->sup_pub_id){echo 'selected';}?> value="<?= $supplierData->sup_pub_id;?>"><?= ucfirst($supplierData->name);?></option>   
                          <?php } } ?>
                          </select>
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Date</label>
                         <input  type="date" id="" name="inv_date" required="required" value="<?php echo $inventory_info->inv_date;?>" class="form-control">
                          </div>
                        </div>
                      </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Measurement</label>
                          <select name="measurement" required="required"  class="form-control" >
                            <option value="">Please Select Category</option>
                            <?php 
                            if(count($measurement)>0){
                            foreach($measurement as $measurementData){?>
                            <option <?php if($measurementData->meas_pub_id == $inventory_info->measurement){echo 'selected';}?> value="<?= $measurementData->meas_pub_id;?>"><?= ucfirst($measurementData->meas_title);?></option>   
                          <?php } } ?>
                          </select>
                        </div>
                        </div>

                       <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Product</label>
                          <select name="pro_pub_id" required="required"  class="form-control" >
                            <option value="">Please Select Category</option>
                            <?php 
                            if(count($product)>0){
                            foreach($product as $productData){?>
                            <option <?php if($productData->pro_pub_id == $inventory_info->pro_pub_id){echo 'selected';}?> value="<?= $productData->pro_pub_id;?>"><?= ucfirst($productData->pro_name);?></option>   
                          <?php } } ?>
                          </select>
                        </div>
                        </div>
                       <div class="col-sm-4">           
                         <div class="form-group">
                           <label class="col-sm-6">Quantity</label>
                            <input  type="text" id="" name="quantity" class="form-control" value="<?php echo $inventory_info->quantity;?>">
                          </div>
                        </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                    <div class="col-md-6">
                    <button style="margin-top: 26px;" type="submit" class="btn btn-success">Submit</button>
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
     