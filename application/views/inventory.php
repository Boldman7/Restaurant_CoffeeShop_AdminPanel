 <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->

        <!-- ============================================================== -->
       
          <div id="page-wrapper">
            <div class="container-fluid">


            <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add Inventory</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="'x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/add_inventory', $attributes); ?>

                             <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Supplier</label>
                        <select name="supplier_name" id="sup_id" required="required" class="form-control" >
                              <option value="">Please Select Supplier</option>
                               <?php 
                               // print_r($company);
                              if(count($supplier)>0){
                              foreach($supplier as $supplier){?>
                              <option value="<?= $supplier->sup_pub_id;?>"><?= ucfirst($supplier->name);?></option>   
                            <?php } } ?>
                            </select>
                        </div>
                        </div>


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
                        <input  type="number" id="quantity" required="required"  name="quantity" class="form-control">
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
                    <div class="col-md-12">
                      <div class="white-box">
                        <div class="panel">
                            <div class="panel-heading">Inventory Information</div>
                           <div id="example23_wrapper" class="dataTables_wrapper dt-bootstrap4">
                           <?php $attributes = array('id' => 'form_validation', 'style'=>'margin-top: 13px; margin-bottom: 15px;','name'=>'add_coupon','class'=>'form-sample'); echo form_open_multipart('Admin/allInventory', $attributes); ?>
                                <div class="row">
                                  <div class="col-sm-4">
                                   <label class="col-sm-4">Start Date</label>
                                    <input type="date" name="date_fillter" value="<?php if(isset($date_fillter)) { echo $date_fillter; } ?>" required="" class="form-control">
                                  </div>
                                  <div class="col-sm-4">
                                  <label class="col-sm-4">End Date</label>
                                    <input type="date" name="date1_fillter" value="<?php if(isset($date_fillter)) { echo $date_fillter1; } ?>" required="" class="form-control">
                                  </div>
                                  <div class="col-sm-4">
                                      <label>Select Item</label>
                                    <select name="pro_pub_id" class="form-control">
                                      <option>Select Item</option>
                                      <?php foreach ($allProducts as $allProducts) 
                                      { ?>
                                      <option value="<?php echo $allProducts->pro_pub_id; ?>" <?php if(isset($pro_pub_id)) { if($pro_pub_id == $allProducts->pro_pub_id){ echo "selected"; } } ?>><?php echo $allProducts->pro_name; ?></option>
                                      <?php } ?>
                                    </select>
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
                                    <th>Supplier name</th>
                                    <th>Unit Of Measurement</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                <tbody>
              <?php 
                $count=1;
                if(count($inventory_info))
                {
                foreach ($inventory_info as $inventory_infoData) {
                $operator = $this->Api_model->getSingleRow('supplier_info',array('sup_pub_id'=>$inventory_infoData->sup_pub_id));
                $product = $this->Api_model->getSingleRow('product_info',array('pro_pub_id'=>$inventory_infoData->pro_pub_id));
                $measurement = $this->Api_model->getSingleRow('measurement_info',array('meas_pub_id'=>$inventory_infoData->measurement));
                ?>
                <tr>
                <td><?= $count++;?></td>
                <td class="text-center"><?php echo date('d-m-Y',($inventory_infoData->created_at)/1000); ?></td>
                <td><?php echo $operator->name; ?></td>
                <td><?php echo $measurement->meas_title; ?></td>
                <td><?php echo $product->pro_name; ?></td>
                <td><?php echo $inventory_infoData->quantity; ?></td>
                <td>
              <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
              <span class="caret"></span></button>
              <ul class="dropdown-menu" style="margin-top: -53px;margin-left: -96px;">
                <li><a class="" href="<?php echo base_url(); ?>Admin/editInventory/<?php echo $inventory_infoData->inv_pub_id;?>">Edit</a></li>
              </ul>
            </div>
              </td>
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
      

<script type="text/javascript">
  function showDetails(id)
  {
 $("#"+id).modal("show");
  }
</script>
