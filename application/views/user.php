

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
                            <div class="panel-heading">MANAGE USERS</div>
                            <div id="example23_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
                                    
                                     <thead>
                                    <tr role="row">
                                    <th>Sno.</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                <?php $count=1; foreach ($user as $user) { ?>
                                <tr>
                                <td><?= $count++;?></td>
                                <td><?php echo $user->name; ?></td>
                               <td><?php echo $user->mobile_no; ?></td>
                                <td><?php echo $user->floor_no.','.$user->flat_no.','.$user->building_no.','.$user->area.','.$user->city; ?></td>
                                <td class="text-center">
                                        
                                        
                                        <div class="dropdown">
                                          <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
                                          <span class="caret"></span></button>
                                          <ul class="dropdown-menu">
                                         <li><a  href="<?php echo base_url(); ?>Admin/editUser/<?php echo $user->id; ?>" title="Edit" class="">Edit</a></li>
                                            <li><a title="View Orders" href="<?php echo base_url();?>Admin/userOrderInfo/<?php echo $user->user_pub_id;?>" class="">View Orders</i>
                                        </a></li>
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
                  <script type="text/javascript">
                    function showDetails(id)
                    {
                   $("#"+id).modal("show");
                    }
                  </script>
