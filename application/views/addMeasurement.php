<div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add Measurement</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/add_measurement', $attributes); ?>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Measurement</label>
                        <input  type="text" id="first-name" name="meas_title" required="required" value="<?php echo set_value('meas_title');?>" class="form-control">
                          </div>
                          <?php echo form_error('meas_title');?>
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
                            <div class="panel-heading">All Measurement</div>
                            <div class="table-responsive">
                        <table class="table table-hover manage-u-table table-responsive table-responsive" id="">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Measurement</th>
                        <th>Action</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $count=1; 
                        foreach ($measurement_info as $measurement){
                        ?>
                        <tr style="height: 91px;">
                        <td><?=  $count++; ?></td>
                        <td><?php echo $measurement->meas_title; ?></td>
                        <td><?php if($measurement->status==1){ ?>
                        <label class="badge badge-teal">Active</label>
                        <?php }elseif($measurement->status==0){ ?>
                        <label class="badge badge-danger">Deactive</label>
                        <?php } ?>
                        </td>
                        <td>
                         <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" style="margin-top: -35px;margin-left: 84px;">
                          <li><a style="padding: 3px 20px;" title="Verified" class="" href="<?= base_url();?>Admin/change_measurement_status?id=<?php echo $measurement->id; ?>&amp;status=1">Active</a></li>
                          <li><a style="padding: 3px 20px;" title="Not Verified" class="" href="<?= base_url();?>Admin/change_measurement_status?id=<?php echo $measurement->id; ?>&amp;status=0">Deactive</a></li>
                          <li>
                            <a style="padding: 3px 20px;" href="<?php echo base_url(); ?>Admin/editMeasurement/<?php echo $measurement->id; ?>" title="Edit" class="">Edit</a> </li>
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

        