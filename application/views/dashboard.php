

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
                    <div class="col-lg-12 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Total sales</h3>
                             <ul class="list-inline two-part">
                                <li><i class="ti-wallet text-success"></i></li>
                                <li class="text-right"><span class=""><?= round($price[0]->final_price,2);?></span></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-sm-6 col-xs-12" style="display: none;">
                        <div class="white-box">
                            <h3 class="box-title">Total purchase</h3>
                            <ul class="list-inline two-part">
                                <li><i class="mdi mdi-cart-outline fa-fw text-danger"></i></li>
                                <li class="text-right"><span class=""><?= round($purechase_info[0]->final_price,2)   ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Products of Artist</h3>
                            <ul class="list-inline two-part">
                                <li><i class="ti-wallet text-success"></i></li>
                                <li class="text-right"><span class="">117</span></li>
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-lg-4 col-sm-6 col-xs-12" style="display: none;">
                        <div class="white-box">
                            <h3 class="box-title">Total Customer</h3>
                            <ul class="list-inline two-part">
                                <li><i class="fa fa-user text-success"></i></li>
                                <li class="text-right"><span class=""><?= $total_user -1 ;?></span></li>
                            </ul>
                        </div>
                    </div>
                    </div>
                  
                 <div class="row">
                    <div class="col-sm-8">
                        <div class="white-box">
                            <h3 class="box-title">Sales</h3>
                            <div>
                                <canvas id="chart10" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="display: none;">
                        <div class="white-box">
                            <h3 class="box-title">Purchase</h3>
                            <div>
                                <canvas id="chart21" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
               
               
                <!-- ============================================================== -->
                <!-- Demo table -->
                <!-- ============================================================== -->
             
            <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Pending order</h3>
                            <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF &amp; Print</p>
                            <div class="table-responsive">
                                <div id="example23_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
                                    
                                     <thead>
                                    <tr role="row">
                                    <th>Sno.</th>
                                     <th class="text-center">Order Date</th>
                                     <th>Order id</th>
                                     <th>Order Type</th>
                                     <th>Customer</th>
                                     <th>Delivery Address</th>
                                     <th>Total Price</th>
                                     <th>Status</th>
                                    <!-- <th>Invoice id</th>
                                    <th>Operator</th>
                                    <th>Chef</th>
                                    <th>Mobile No.</th>
                                    <th>Tax</th>
                                    <th>Final Price</th> -->
                                     <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php 
                                    $count=1;
                                    if(count($invoice))
                                    {
                                    foreach ($invoice as $invoiceData) {
                                    $Operator = $this->Api_model->getOperatorInfo('staff',array('staff_pub_id'=>$invoiceData->operator_pub_id));
                                $chef = $this->Api_model->getUserInfo('staff',array('staff_pub_id'=>$invoiceData->chef_pub_id));
                                 $name='';
                                 $delivery_address ='';
                                if($invoiceData->order_type=='2')
                                {
                                $user = $this->Api_model->getUserInfo('users',array('user_pub_id'=>$invoiceData->user_pub_id));
                                if($user)
                                {
                                  $name = $user->name;
                                }
                                else
                                {
                                  $name ='';
                                }
                                 
                                 $delivery_address = $invoiceData->delivery_address;
                                }
                                    ?>
                                    <tr>
                                    <td><?= $count++;?></td>
                                    <td class="text-center"><?php  echo date('d-m-y H:i:s', $invoiceData->updated_at ); ?></td>
                                    <td><?php echo $invoiceData->id; ?></td>
                                    <td>
                                      <?php if($invoiceData->order_type=='1'){echo 'Walking';} ?>
                                      <?php if($invoiceData->order_type=='2'){echo 'Delivery';} ?>
                                      <?php if($invoiceData->order_type=='3'){echo 'Parcle';} ?>
                                    </td>
                                     <td><?php echo $name; ?></td>
                                     <td><?php echo $delivery_address; ?></td>
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
                                    <!-- <td><?php echo $invoiceData->invoice_pub_id; ?></td>
                                    <td><?php echo $Operator->name; ?></td>
                                    <td><?php echo $chef->name; ?></td>
                                    <td><?php echo $user->mobile_no; ?></td>
                                    <td><?php echo $invoiceData->total_price; ?></td>
                                    <td><?php echo $invoiceData->tax; ?></td> -->
                                
                                    
                                    
                                      <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
              <span class="caret"></span></button>
              <ul class="dropdown-menu" style="margin-top: -23px;">
             <li><a style="padding: 0px 20px;" class="" href="<?php echo base_url('/Admin/change_order_status_dash');?>?id=<?php echo $invoiceData->id; ?>&status=3">Pending</a></li>
                <li><a style="padding: 0px 20px;" class="" href="<?php echo base_url('/Admin/change_order_status_dash');?>?id=<?php echo $invoiceData->id; ?>&status=1">Ongoing</a></li>
                <li><a style="padding: 0px 20px;" class="" href="<?php echo base_url('/Admin/change_order_status_dash');?>?id=<?php echo $invoiceData->id; ?>&status=4">Cancel</a></li>
                <li><a  style="padding: 0px 20px;" class="" href="<?php echo base_url('/Admin/change_order_status_dash');?>?id=<?php echo $invoiceData->id; ?>&status=2">Complete</a></li>
                 <li><a style="padding: 0px 20px;" class="" href="<?php echo base_url();?>Admin/invoiceInfo/<?php echo $invoiceData->invoice_pub_id;?>">View Order</a></li>
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