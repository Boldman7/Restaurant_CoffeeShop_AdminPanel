<div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add Supplier</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/add_supplier', $attributes); ?>
                           
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Supplier Name</label>
                        <input  type="text" id="first-name" name="name" required="required" value="<?php echo set_value('name');?>" class="form-control">
                          </div>
                          <?php echo form_error('name');?>
                        </div>
                       </div>
                    <div class="ln_solid"></div>
                    <div class="form-group" style="margin-top: 44px;">
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
        


         <div class="row">
                    <div class="col-md-12">
                    <div class="white-box">
                        <div class="panel">
                            <div class="panel-heading">All Supplier</div>
                            <div class="table-responsive">
                        <table id="example23" class="table table-hover manage-u-table table-responsive" id="">
                        <thead>
                        <tr>
                        <th>Sno.</th>
                        <th>Supplier Name</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $count=1; 
                        foreach ($supplier as $supplierdata){
                        ?>
                        <tr style="height: 91px;">
                        <td><?=  $count++; ?></td>
                        <td><?php echo $supplierdata->name; ?></td>
                        <td><?php if($supplierdata->status==1){ ?>
                        <label class="badge badge-teal">Active</label>
                        <?php }elseif($supplierdata->status==0){ ?>
                        <label class="badge badge-danger">Deactive</label>
                        <?php } ?>
                        </td>
                        <td>
                         <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" style="margin-top: -39px;margin-left: 82px;">
                          <li><a style="padding: 3px 20px;"  title="Active" class="" href="<?= base_url();?>Admin/change_supplier_status?id=<?php echo $supplierdata->id; ?>&amp;status=1">Active</a></li>
                          <li><a style="padding: 3px 20px;" title="Deactive" class="" href="<?= base_url();?>Admin/change_supplier_status?id=<?php echo $supplierdata->id; ?>&amp;status=0">Deactive</a></li>
                          <li>
                             <a style="padding: 3px 20px;" href="<?php echo base_url(); ?>Admin/editSupplier/<?php echo $supplierdata->id; ?>" title="Edit" class="">Edit</a>
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
            </div>
         </div>