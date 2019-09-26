<div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add Product</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/add_product', $attributes); ?>
                        <div class="col-md-12 col-sm-12 col-xs-12">    
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Product Name</label>
                        <input  type="text" id="first-name" name="pro_name" required="required" value="<?php echo set_value('pro_name');?>" class="form-control">
                          </div>
                          <?php echo form_error('pro_name');?>
                        </div>

                         <div class="col-sm-6">
                         <div class="form-group">
                          <label class="col-sm-4">Quantity</label>
                        <input  type="text" id="first-name" name="quantity" required="required" value="<?php echo set_value('quantity');?>" class="form-control">
                          </div>
                          <?php echo form_error('quantity');?>
                        </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="col-sm-4">Measurement</label>
                            <select name="meas_pub_id" required="required"  class="form-control" >
                              <option value="0">Please Select Measurement</option>
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
                              <option value="0">Please Select Company</option>
                              <?php 
                              if(count($company)>0){
                              foreach($company as $company){?>
                              <option value="<?= $company->id;?>"><?= ucfirst($company->com_name);?></option>   
                            <?php } } ?>
                            </select>
                          </div>
                          </div>
                        </div>  
                      <div class="ln_solid"></div>
                    <div class="form-group">
                    <div class="col-md-6" style="margin-top: 27px;">
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


         <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">All Product</div>
                            <div class="table-responsive">
                        <table class="table table-hover manage-u-table table-responsive" id="">
                        <thead>
                        <tr>
                        <th>Sno.</th>
                        <th>Product Name</th>
                        <th>Quantity in hand</th>
                        <th>Unit of measurement</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $count=1; 
                        foreach ($product_info as $product_infodata){
                          $measurementdata= $this->Api_model->getSingleRow('measurement_info', array('meas_pub_id'=>$product_infodata->meas_pub_id));
                        ?>
                        <tr style="height: 91px;">
                        <td><?=  $count++; ?></td>
                        <td><?php echo $product_infodata->pro_name; ?></td>
                        <td><?php echo $product_infodata->quantity; ?></td>
                        <td><?php echo $measurementdata->meas_title; ?></td>
                        <td><?php if($product_infodata->status==1){ ?>
                        <label class="badge badge-teal">Active</label>
                        <?php }elseif($product_infodata->status==0){ ?>
                        <label class="badge badge-danger">Deactive</label>
                        <?php } ?>
                        </td>
                        <td>
                         <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" style="margin-top: -39px;margin-left: 82px;">
                          <li><a style="padding: 3px 20px;" title="Active" class="" href="<?= base_url();?>Admin/change_product_status?id=<?php echo $product_infodata->id; ?>&amp;status=1">Active</a></li>
                          <li><a style="padding: 3px 20px;" title="Deactive" class="" href="<?= base_url();?>Admin/change_product_status?id=<?php echo $product_infodata->id; ?>&amp;status=0">Deactive</a></li>
                          <li>
                            <a style="padding: 3px 20px;" href="<?php echo base_url(); ?>Admin/editProduct/<?php echo $product_infodata->id; ?>" title="Edit" class="">Edit</a>
                          </li>
                        </ul>
                         
                      </div>
                        </td>

                        </tr>

                        <?php } ?>  
             
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

              </div>
            </div>

        