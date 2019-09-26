 <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->

        <!-- ============================================================== -->
       
          <div id="page-wrapper">
            <div class="container-fluid">
                <!-- .row -->
                <div class="row">
                    
                 <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                          <div class="white-box">
                            <div class="panel-heading">All orders list</div>
                             <?php $attributes = array('id' => 'form_validation', 'style'=>'margin-top: 13px; margin-bottom: 15px;','name'=>'add_coupon','class'=>'form-sample'); echo form_open_multipart('Admin/allOrder', $attributes); ?>
                                <div class="row">
                                 <div class="col-md-12">
                                    <div class="col-sm-4">
                                      <label>Select Start Date</label>
                                      <input type="date" name="date_fillter" value="<?php if(isset($date_fillter)) { echo $date_fillter; } ?>" required="" class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                      <label>Select End Date</label>
                                      <input type="date" name="date1_fillter" value="<?php if(isset($date_fillter)) { echo $date_fillter1; } ?>" required="" class="form-control">
                                    </div>
                                     <div class="col-sm-4">
                                        <label>Select Order Type</label>
                                        <select name="order_type" class="form-control">
                                            <option>Select Order Type</option>
                                            <option value="1" <?php if(isset($order_type)) { if($order_type == 1){ echo "selected"; } } ?>>Walking</option>
                                            <option value="2" <?php if(isset($order_type)) { if($order_type == 2){ echo "selected"; } } ?>>Delivery</option>
                                            <option value="3" <?php if(isset($order_type)) { if($order_type == 3){ echo "selected"; } } ?>>Parcle</option>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="col-sm-4">
                                      <label>Select Operator</label>
                                      <select name="operator_pub_id" class="form-control">
                                          <option value="0">Select Operator</option>
                                            <?php foreach ($staff as $staff) { ?>
                                              <option value="<?php echo $staff->staff_pub_id; ?>" <?php if(isset($operator_pub_id)) { if($operator_pub_id == $staff->staff_pub_id){ echo "selected"; } } ?>><?php echo $staff->name; ?></option>
                                            <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-sm-4"  style="display: none;">
                                      <label>Select Chef</label>
                                      <select name="chef_pub_id" class="form-control">
                                          <option value="0">Select Chef</option>
                                            <?php foreach ($chef as $chef) { ?>
                                              <option value="<?php echo $chef->staff_pub_id; ?>" <?php if(isset($chef_pub_id)) { if($chef_pub_id == $chef->staff_pub_id){ echo "selected"; } } ?>><?php echo $chef->name; ?></option>
                                            <?php } ?>
                                      </select>
                                    </div>
                                    <div class="col-sm-4">
                                      <input type="submit" name="submit" class="btn btn-primary" value="Filter" style="margin-top: 25px;">
                                    </div>
                                  </div>
                                </div>
                              </form>
                            <div class="table-responsive">
                              <table id="orders" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
                                    <thead>
                                      <tr role="row">
                                        <th>Sno.</th>
                                        <th>Date</th>
                                        <th>Order id</th>
                                        <th>Invoice id</th>
                                        <th>Order Type</th>
                                        <th>Operator Name</th>
                                        <th  style="display: none;">Chef Name</th>
                                        <th>Customer</th>
                                        <th>Address</th>
                                        <th>Contact no</th>
                                        <th>Tax(%)</th>
                                        <th>Sub Total(₹)</th>
                                        <th>Total(₹)</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $count=1;
                                    if(count($invoice))
                                    {
                                      $tax=0;
                                      $total_price=0;
                                      $final_price=0;
                                      foreach ($invoice as $invoiceData) {
                                      $Operator = $this->Api_model->getOperatorInfo('staff',array('staff_pub_id'=>$invoiceData->operator_pub_id));
                                      //$chef = $this->Api_model->getUserInfo('staff',array('staff_pub_id'=>$invoiceData->chef_pub_id));
                                       $name='';
                                       $delivery_address ='';
                                       $mobile_no ='';
                                      if($invoiceData->order_type=='2')
                                      {
                                        $user = $this->Api_model->getUserInfo('users',array('user_pub_id'=>$invoiceData->user_pub_id));
                                         $name = $user->name;
                                         $delivery_address = $invoiceData->delivery_address;
                                         $mobile_no = $user->mobile_no;
                                      }
                                      ?>
                                      <tr>
                                      <td><?= $count++;?></td>
                                      <td class="text-center"><?php  echo date('d-m-Y', ($invoiceData->updated_at/1000) ); ?></td>
                                      <td><?php echo $invoiceData->id; ?></td>
                                      <td><?php echo $invoiceData->invoice_pub_id; ?></td>
                                      <td>
                                        <?php if($invoiceData->order_type=='1'){echo 'Walking';} ?>
                                        <?php if($invoiceData->order_type=='2'){echo 'Delivery';} ?>
                                        <?php if($invoiceData->order_type=='3'){echo 'Parcle';} ?>
                                      </td>
                                      <td><?php $operator = $this->Api_model->getUserInfo('staff',array('staff_pub_id'=>$invoiceData->operator_pub_id));
                                         $chef_name = $operator->name; echo $chef_name; ?></td>
                                      <td style="display: none;" ><?php $chef = $this->Api_model->getUserInfo('staff',array('staff_pub_id'=>$invoiceData->chef_pub_id));
                                         $chef_name = $chef->name; echo $chef_name; ?></td>
                                      <td><?php echo $name; ?></td>

                                      <td><?php echo $delivery_address; ?></td>
                                      <td><?php echo $mobile_no; ?></td>
                                      <td><?php echo round($invoiceData->tax,2); ?></td>
                                      <td><?php echo round($invoiceData->total_price,2); ?></td>
                                      <td><?php echo round($invoiceData->final_price,2); ?></td>
                                      <td>
                                        <?php if($invoiceData->invoice_status=='1')
                                        { ?>
                                          <label class="badge badge-primary">
                                           <?php echo 'Ongoing';?>
                                          </label>
                                          <?php } 
                                          if($invoiceData->invoice_status=='2') { ?>
                                          <label class="badge badge-success">
                                          <?php echo 'Completed';?>
                                          <?php } ?>
                                          </label>
                                          <?php if($invoiceData->invoice_status=='3'){?>
                                          <label class="badge badge-warning">
                                          <?php echo 'Pending';?>
                                          </label>
                                          <?php } 
                                           if($invoiceData->invoice_status=='4'){?>
                                          <label class="badge badge-danger">
                                          <?php echo 'Cancel';?>
                                          </label>
                                          <?php } ?>
                                        </td>
                                        <td>
                                      <div class="dropdown">
                                      <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
                                      <span class="caret"></span></button>
                                      <ul class="dropdown-menu" style="margin-top: -53px;margin-left: -96px;">
                                     <li><a style="padding: 2px 20px" class="" href="<?php echo base_url('/Admin/change_status_sales');?>?id=<?php echo $invoiceData->id; ?>&status=3">Pending</a></li>
                                        <li><a style="padding: 2px 20px" class="" href="<?php echo base_url('/Admin/change_status_sales');?>?id=<?php echo $invoiceData->id; ?>&status=1">Ongoing</a></li>
                                        <li><a style="padding: 2px 20px" class="" href="<?php echo base_url('/Admin/change_status_sales');?>?id=<?php echo $invoiceData->id; ?>&status=4">Cancel</a></li>
                                        <li><a style="padding: 2px 20px" class="" href="<?php echo base_url('/Admin/change_status_sales');?>?id=<?php echo $invoiceData->id; ?>&status=2">Complete</a></li>
                                        <li><a style="padding: 2px 20px"  class="" href="<?php echo base_url();?>Admin/invoiceInfo/<?php echo $invoiceData->invoice_pub_id;?>">View Order</a></li>
                                      </ul>
                                    </div>
                                    </td>
                                      </tr>
                                 <?php $tax += $invoiceData->tax; 
                                 $total_price += $invoiceData->total_price; 
                                 $final_price += $invoiceData->final_price; } ?>
                                </tbody>
                                <tfoot>
                                  <th class="text-center" colspan="11">Total (₹)</th>
                                  <th><?php echo round($total_price,2); ?></th>
                                  <th><?php echo round($final_price,2); ?></th>
                                  <th></th>
                                  <th></th>
                                </tfoot>
                                <?php } ?>
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
