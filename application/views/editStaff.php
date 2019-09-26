<div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Edit Staff</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('Admin/editStaffAction', $attributes); ?>
                    
                     

                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Name </label>
                        <input  type="hidden" id="first-name" name="staff_id" value="<?php echo $staff->id;?>" />
                        <input  type="text" id="first-name" name="name" value="<?php echo $staff->name;?>" required="required" class="form-control">
                          </div>
                        </div>
                         <span style="color:red;"><?php echo form_error('name'); ?></span>
                    <div class="col-sm-4">             
                      <div class="form-group">
                      <label class="col-sm-4">Username</label>
                     <input  type="text" id="" name="username" step="any" value="<?php echo $staff->user_name;?>" required="required" class="form-control">
                          </div>
                          <span style="color:red;"><?php echo form_error('username'); ?></span>
                        </div>

                      <div class="col-sm-4">             
                      <div class="form-group">
                      <label class="col-sm-4">Email</label>
                     <input  type="email" id="" name="email" step="any" value="<?php echo $staff->email;?>" required="required" class="form-control">
                          </div>
                        </div><span style="color:red;"><?php echo form_error('email'); ?></span>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Mobile</label>
                        
                          <select style="width: 33%;margin-top: 25px;margin-left:-125px;" class="form-control col-sm-1" required="required" name="country_code">
                            <option value="+91" <?php if($staff->country_code=="+91") { echo "selected"; } ?> >+91</option>
                            <option value="+971" <?php if($staff->country_code=="+971") { echo "selected"; } ?> >+971</option>
                          </select>
                      
                          <input style="width: 60%;margin-top: 25px;" type="text" id="" name="mobile" value="<?php echo $staff->mobile_no;?>" required="required" class="form-control col-sm-4" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" minlength="15" maxlength="15">
                        </div>
                        <span style="color:red;"><?php echo form_error('mobile'); ?></span>
                      </div>
              
                  <div class="col-sm-4">             
                      <div class="form-group">
                      <label class="col-sm-4">Address</label>
                     <input type="text" id="" name="address" value="<?php echo $staff->address;?>" required="required" class="form-control">
                          </div>
                       <span style="color:red;"><?php echo form_error('address'); ?></span>
                        </div>
                   <div class="col-sm-4">             
                      <div class="form-group">
                      <label class="col-sm-4" style="width:150px">Id Proof</label>
                    <input   type="file" id="" name="id_proof" step="any" value="<?php echo set_value('id_proof');?>" class="form-control">
                          </div>
                        </div>

                         <div class="col-sm-4">             
                      <div class="form-group">
                      <label class="col-sm-4">Password </label>
                     <input type="password" id="" name="password" value="<?php echo md5($staff->password);?>" required="required" class="form-control" >
                    </div>
                    </div>
                      <div class="col-sm-4">             
                      <div class="form-group">
                      <label class="col-sm-4">Profile Image</label>
                      <input type="file" id="" name="image_path" class="form-control ">
                          </div>
                        </div>
                        <div class="col-sm-4" style="display: none;">
                        <div class="form-group">
                          <label class="col-sm-4">Role</label>
                          <input type="text" id="" readonly="" name="password" value="<?php if($staff->role=='1'){echo 'Operator';}else{echo 'Chef';}?>" required="required" class="form-control" >
                        <!-- <select class="form-control" readonly="readonly" required="required" name="role">
                        <option <?php if($staff->role=='1'){echo 'selected';}?> value="1">Operator</option>
                        <option <?php if($staff->role=='2'){echo 'selected';}?> value="2">Chef</option>
                        </select> -->
                        </div>
                        </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
             </div>
</div>

