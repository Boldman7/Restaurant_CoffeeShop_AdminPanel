 <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->

        <!-- ============================================================== -->
       
          <div id="page-wrapper">
            <div class="container-fluid">
              <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Usage</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li class="active">Usage</li>
                    </ol>
                </div>
              </div>

            <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add Usage</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="'x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/addUsageAction', $attributes); ?>


                            <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Company</label>
                        <select onchange="getProductByCompanyId(this.value)" name="company_name" id="com_id" required="required"  class="form-control" >
                              <option value="">Please Select Company</option>
                               <?php 
                               // print_r($company);
                              if(count($company)>0){
                              foreach($company as $company){?>
                              <option value="<?= $company->id;?>"><?= ucfirst($company->com_name);?></option>   
                            <?php } } ?>
                            </select>
                        </div>
                        </div>
        
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Date</label>
                        <input  type="date" id="date" name="date" required="required" value="" class="form-control">
                          </div>
                        </div> 

                       <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Product Name</label>
                        <select name="product_name" id="pro_id" required="required"  class="form-control" >
                              <option value="">Please Select Product</option>
                               <?php 
                               // print_r($company);
                              if(count($product_info)>0){
                              foreach($product_info as $product_info){?>
                              <option value="<?= $product_info->pro_pub_id;?>"><?= ucfirst($product_info->pro_name);?></option>   
                            <?php } } ?>
                            </select>
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Measurement</label>
                        <select name="measurement" id="meas_id" required="required"  class="form-control" >
                              <option value="">Please Select Measurement</option>
                               <?php 
                               // print_r($company);
                              if(count($measurement_info)>0){
                              foreach($measurement_info as $measurement_info){?>
                              <option value="<?= $measurement_info->meas_pub_id;?>"><?= ucfirst($measurement_info->meas_title);?></option>   
                            <?php } } ?>
                            </select>
                        </div>
                        <?php echo form_error('meas_title');?>
                        </div>
                         <div class="col-sm-4">
                         <div class="form-group">
                          <label class="col-sm-4">Quantity</label>
                        <input  type="number" id="quantity" required="required"  name="quantity" class="form-control" step="any">
                          </div>
                          <?php echo form_error('quantity');?>
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
              <script type="text/javascript">
                function getProductByCompanyId(val)
                    {
                       var xhttp = new XMLHttpRequest();
                       xhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("pro_id").innerHTML = this.responseText;
                    
                    }
                    };
                        xhttp.open("GET", "<?php echo base_url('Admin/getProductByCompanyId/') ?>"+val, true);
                        xhttp.send();
                    }

              </script>
                <!-- .row -->
                <div class="row">
                    
                 <div class="row">
                    <div class="col-md-12">
                      <div class="white-box">
                        <div class="panel">
                            <div class="panel-heading">Usage Information</div>
                           <div id="example23_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <?php $attributes = array('id' => 'form_validation', 'style'=>'margin-top: 13px; margin-bottom: 15px;','name'=>'add_coupon','class'=>'form-sample'); echo form_open_multipart('Admin/addUsage', $attributes); ?>
                                <div class="row">
                                  <div class="col-sm-4">
                                   <label class="col-sm-4">Start Date</label>
                                    <input type="date" name="date_fillter" required="" class="form-control">
                                  </div>
                                  <div class="col-sm-4">
                                  <label class="col-sm-4">End Date</label>
                                    <input type="date" name="date1_fillter" required="" class="form-control">
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Filter" style="margin-top: 25px;">
                                  </div>
                                </div>
                              </form>
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
                                    
                                     <thead>
                                    <tr role="row">
                                    <th>S No.</th>
                                    <th class="text-center">Date</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                  <?php 
                                    $count=1;
                                    if(count($inventory_info))
                                    {
                                    foreach ($inventory_info as $inventory_infoData) {
                                    $product = $this->Api_model->getSingleRow('product_info',array('pro_pub_id'=>$inventory_infoData->pro_pub_id));
                                    ?>
                                    <tr>
                                    <td><?= $count++;?></td>
                                    <td class="text-center"><?php echo date('d-m-Y',($inventory_infoData->created_at)/1000); ?></td>
                                    <td><?php echo $product->pro_name; ?></td>
                                    <td><?php echo $inventory_infoData->quantity; ?></td>
                                    <td><?php if($inventory_infoData->type==1) {
                                      echo "Sale";
                                    }
                                    if($inventory_infoData->type==0) {
                                      echo "Consumption";
                                    }
                                     ?></td>
                                    </tr>
                               <?php } } ?>
                                </tbody>
                                </table>
                                </div>
                              </div>
                             </div>
                            </div>
                            </div>          
                          </div>
                        </div>
      

<script type="text/javascript">
  function showDetails(id)
  {
 $("#"+id).modal("show");
  }
</script>
