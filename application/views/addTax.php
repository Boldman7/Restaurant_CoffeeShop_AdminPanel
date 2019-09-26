<div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add Tax</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/add_tax', $attributes); ?>
                      <?php if(count($tax)==0){?> 
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Tax(%)</label>
                        <input  type="number" id="first-name" name="tax" required="required" value="<?php echo set_value('tax');?>" class="form-control">
                          </div>
                          <?php echo form_error('tax');?>
                        </div>
                      <?php }
                      else{?>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Tax(%)</label>
                          <input  type="hidden"  name="tax_id" required="required" value="<?php echo $tax[0]->id;?>" class="form-control">
                        <input  type="number" id="first-name" name="tax" required="required" value="<?php echo $tax[0]->tax;?>" class="form-control">
                          </div>
                          <?php echo form_error('tax');?>
                        </div>
                      <?php } ?>
                       </div>
                    <div class="ln_solid"></div>
                    <div class="form-group" style="margin-top: 26px;">
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
         </div>


         <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">All Tax</div>
                            <div class="table-responsive">
                        <table class="table table-hover manage-u-table table-responsive" id="">
                        <thead>
                        <tr>
                        <th>Sno.</th>
                        <th>Tax</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $count=1; 
                        foreach ($tax as $taxdata){
                        ?>
                        <tr style="height: 91px;">
                        <td><?=  $count++; ?></td>
                        <td><?php echo $taxdata->tax; ?></td>
                        <td><?php if($taxdata->status==1){ ?>
                        <label class="badge badge-teal">Active</label>
                        <?php }elseif($taxdata->status==0){ ?>
                        <label class="badge badge-danger">Deactive</label>
                        <?php } ?>
                        </td>
                        <td>
                         <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" style="margin-top: -48px;margin-left: 82px;">
                          <li><a title="Active" class="" href="<?= base_url();?>Admin/change_tax_status?id=<?php echo $taxdata->id; ?>&amp;status=1">Active</a></li>
                          <li><a style="padding: 0px 20px;" title="Deactive" class="" href="<?= base_url();?>Admin/change_tax_status?id=<?php echo $taxdata->id; ?>&amp;status=0">Deactive</a></li>
                          <li>
                             <a href="<?php echo base_url(); ?>Admin/editTax/<?php echo $taxdata->id; ?>" title="Edit" class="">Edit</a>
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

        