

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
                            <div class="panel-heading">Manage Order</div>
                            <div id="example23_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                   <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
                                    
                                     <thead>
                                    <tr role="row">
                                    <th>Sno.</th>
                                    <th>Order Date</th>
                                    <th>Order Id</th>
                                    <th>Order Type</th>
                                    <th>Customer</th>
                                    <th>Delivery Address</th>
                                    <th>Contact no</th>
                                    <th>Total Price including tax</th>
                                    <th>status</th>
                                    <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                <?php  $count=1; 
                               if(count($invoice)>0){ 
                              foreach ($invoice as $invoiceData) {
                              $Operator = $this->Api_model->getOperatorInfo('staff',array('staff_pub_id'=>$invoiceData->operator_pub_id));
                              $chef = $this->Api_model->getUserInfo('staff',array('staff_pub_id'=>$invoiceData->chef_pub_id));
                              $user = $this->Api_model->getUserInfo('users',array('user_pub_id'=>$invoiceData->user_pub_id));
                             ?>
                                <tr>
                                <td><?= $count++;?></td>
                                <td><?php echo date('d-m-y H:i:s', $invoiceData->created_at); ?></td>
                                <td><?php echo $invoiceData->id; ?></td>
                              <!--  <td>
                                     <a href="<?php echo base_url();?>Admin/invoiceInfo/<?php echo $invoiceData->invoice_pub_id;?>">
                                    <?php echo $invoiceData->invoice_pub_id; ?>
                                    </a>
                                  </td> -->
                                <!-- <td><?php echo $Operator->name; ?></td> -->
                                <!-- <td><?php echo $chef->name; ?></td> -->
                                 <td>
                                <?php if($invoiceData->order_type=='1'){echo 'Walking';} ?>
                                <?php if($invoiceData->order_type=='2'){echo 'Delivery';} ?>
                                <?php if($invoiceData->order_type=='3'){echo 'Parcle';} ?>
                              </td>
                                <td><?php echo $user->name; ?></td>
                                <td><?php echo $invoiceData->delivery_address; ?></td>
                                <td><?php echo $user->mobile_no; ?></td>
                                <td><?php echo $invoiceData->final_price; ?></td>
                                
                                
                               
                                <td>
                                  <?php if($invoiceData->invoice_status=='1'){?>
                                       <label class="badge badge-primary">
                                        <?php echo 'Ongoing';?>
                                        </label>
                                      <?php } ?>
                                    
                                   <?php if($invoiceData->invoice_status=='2'){ ?>
                                    <label class="badge badge-success">
                                    <?php echo 'Completed';?>
                                    </label>
                                  <?php } ?>
                                     
                                   </label>
                                   <?php if($invoiceData->invoice_status=='3'){?>
                                    <label class="badge badge-warning">
                                    <?php echo 'Pending';?>
                                  </label>
                                    <?php } ?>
                                    <?php if($invoiceData->invoice_status=='4'){?>
                                       <label class="badge badge-danger">
                                      <?php echo 'Cancel';?>
                                    </lable>
                                    <?php } ?>
                                  
                                
                                  </td>
                                  <td>
                                      <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
             <li><a title="Pending" class="" href="<?php echo base_url('/Admin/change_order_status');?>?id=<?php echo $invoiceData->id; ?>&status=3">Pending</a></li>
                <li><a title="Ongoing" class="" href="<?php echo base_url('/Admin/change_order_status');?>?id=<?php echo $invoiceData->id; ?>&status=1">Ongoing</a></li>
                <li><a title="Cancel" class="" href="<?php echo base_url('/Admin/change_order_status');?>?id=<?php echo $invoiceData->id; ?>&status=4">Cancel</a></li>
                <li><a title="Complete" class="" href="<?php echo base_url('/Admin/change_order_status');?>?id=<?php echo $invoiceData->id; ?>&status=2">Complete</a></li>
                <li><a title="View Oder" class="" href="<?php echo base_url();?>Admin/invoiceInfo/<?php echo $invoiceData->invoice_pub_id;?>">View Order</a></li>
              </ul>
            </div>
              </td>
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
                    
