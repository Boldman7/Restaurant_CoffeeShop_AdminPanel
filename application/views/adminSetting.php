<div id="page-wrapper">
  <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Setting</h3>
             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                        echo form_open_multipart('admin/adminSettingAction', $attributes); ?>
                        <div class="row">
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="col-sm-4">Email Address</label>
                          <input  type="email" id="first-name" name="email" required="required" value="<?php echo $admin[0]->email;?>" class="form-control">
                            </div>
                            <?php echo form_error('tax');?>
                          </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Password</label>
                        <input  type="Password" id="first-name" name="password" required="required" value="<?php echo $admin[0]->password;?>" class="form-control">
                        <input  type="hidden" id="first-name" name="id" required="required" value="<?php echo $admin[0]->id;?>" class="form-control">
                          </div>
                          <?php echo form_error('tax');?>
                        </div>
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
        </div>
      </div>