
       
          <div id="page-wrapper">
            <div class="container-fluid">
              
                <!-- .row -->
                <div class="row">
                    
                 <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">Order Info</div>
                            <div id="example23_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                   <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
                                    
                                     <thead>
                                    <tr role="row">
                                    <th>Sno.</th>
                                    <th>invoice Id</th>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th class="text-center">Total Price</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                <?php  $count=1; 
                               if(count($orderData)>0){ 
                              foreach ($orderData as $order) {
                              $menu = $this->Api_model->getOperatorInfo('menu',array('menu_pub_id'=>$order->menu_pub_id));
                             
                             ?>
                                <tr>
                                <td><?= $count++;?></td>
                                <td><?php echo $order->invoice_pub_id; ?></td>
                                <td><?php echo $menu->menu_name; ?></td>
                                <td><img style="border-radius: 50%;width: 50px;height: 50px;    background: #4dabe3;" src="<?php echo base_url();?><?php echo $menu->photo;?>"></td>
                                <td><?php echo $order->quantity; ?></td>
                                <td><?php echo $menu->price; ?></td>
                                <td><?php echo $order->total_price; ?></td>
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
                    
