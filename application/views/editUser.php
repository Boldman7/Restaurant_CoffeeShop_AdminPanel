<div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Edit User</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/editUserAction', $attributes); ?>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Full Name</label>
                          <input  type="hidden"  name="user_id" required="required" value="<?php echo $users->id;?>" class="form-control">
                         <input  type="text" id="" name="name" required="required" value="<?php echo $users->name;?>" class="form-control">
                         <?php echo form_error('name');?>
                          </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Area Name</label>
                         <input  type="text" id="" name="area" required="required" value="<?php echo $users->area;?>" class="form-control">
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Building Name</label>
                        <input  type="text" id="" name="building_no" required="required" value="<?php echo $users->building_no;?>" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Floor No.</label>
                        <input  type="text" id="" name="floor_no" required="required" value="<?php echo $users->floor_no;?>" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Flat No.</label>
                        <input  type="text" id="" name="flat_no" required="required" value="<?php echo $users->flat_no;?>" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">City</label>
                        <input  type="text" id="" name="city" required="required" value="<?php echo $users->city;?>" class="form-control">
                          </div>
                        </div>
                         <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Contact No.</label>
                          <input  type="text" id="" name="phone" required="required" value="<?php echo $users->mobile_no;?>" class="form-control" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" minlength="15" maxlength="15">
                          <div><?php echo form_error('phone');?></div>
                          </div>
                        </div>
                       </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                    <div class="col-md-6">
                    <button style="margin-top: 24px;" type="submit" class="btn btn-success">Submit</button>
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

              </div>
            </div>

        