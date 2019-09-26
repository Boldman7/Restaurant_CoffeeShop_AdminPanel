<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="white-box">
          <h3 class="box-title m-b-0">Add Staff</h3>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">
                  <br />
                  <?php $attributes=array( 'id'=>'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left'); echo form_open_multipart('Admin/addStaffAction', $attributes); ?>
                  <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="col-sm-4">Name</label>
                      <input type="text" id="first-name" name="name" value="<?php echo set_value('name');?>" required="required" class="form-control col-sm-6">
                    </div>
                  </div> <span style="color:red;"><?php echo form_error('name'); ?></span>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="col-sm-4">Username</label>
                      <input type="text" id="" name="username" step="any" value="<?php echo set_value('username');?>" required="required" class="form-control col-sm-6">
                    </div>
                  </div><span style="color:red;"><?php echo form_error('username'); ?></span>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="col-sm-4">Email</label>
                      <input type="email" id="" name="email" step="any" value="<?php echo set_value('email');?>" required="required" class="form-control col-sm-6">
                    </div>
                  </div><span style="color:red;"><?php echo form_error('email'); ?></span>
                  </div>
                  <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="col-sm-4" style="width:150px">Passsword</label>
                      <input type="password" id="" name="password" step="any" value="<?php echo set_value('password');?>" required="required" class="form-control col-sm-6">
                    </div>
                  </div><span style="color:red;"><?php echo form_error('password'); ?></span>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="col-sm-4">Mobile</label>
                      <select style="width: 33%;margin-top: 25px;margin-left:-125px;" class="form-control col-sm-1" required="required" name="country_code">
                        <option value="+91">+91</option>
                      </select>
                      <input style="width: 66%;margin-top: 25px;" type="text" id="" name="mobile" value="<?php echo set_value('mobile');?>" required="required" class="form-control col-sm-3" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                    </div>
                  </div> <span style="color:red;"><?php echo form_error('mobile'); ?></span>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="col-sm-4">Address</label>
                      <input type="text" id="" name="address" value="<?php echo set_value('address'); ?>" required="required" class="form-control col-sm-6">
                    </div>
                  </div> <span style="color:red;"><?php echo form_error('address'); ?></span>
                  </div>
                  <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="col-sm-4" style="width:150px">Id Proof</label>
                      <input class="form-control col-sm-6" type="file" id="" name="id_proof" step="any" value="<?php echo set_value('id_proof');?>" required="required" >
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="col-sm-4">Latitude</label>
                      <input type="text" id="" name="latitude" value="<?php echo set_value('latitude'); ?>" required="required" class="form-control col-sm-6" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'');">
                    </div>
                  </div> <span style="color:red;"><?php echo form_error('latitude'); ?></span>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="col-sm-4" style="width:150px">Longitude</label>
                      <input type="text" id="" name="longitude" step="any" value="<?php echo set_value('longitude');?>" required="required" class="col-sm-6 form-control" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'');">
                    </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="col-sm-4">Image</label>
                      <input class="col-sm-6 form-control" type="file" id="" name="image_path" required="required" >
                    </div>
                  </div>
                  <div class="col-sm-4"  style="display: none;">
                    <div class="form-group">
                      <label class="col-sm-4">Role</label>
                      <select class="form-control col-sm-6" required="required" name="role">
                        <option value="1">Operator</option>
                        <option value="2">Chef</option>
                      </select>
                    </div>
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
        <div class="">
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading">List of Staff</div>
              <div class="table-responsive">
                <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
                  <thead>
                    <tr role="row">
                      <tr>
                        <th class="text-center" style="width: 70px">S. No.</th>
                        <th>Name</th>
                        <th>User name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Mobile no.</th>
                        <th style="display: none;">Staff Type</th>
                        <th>Profile</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; if(count($staff)>0){ foreach ($staff as $staffData){ $i++; ?>
                    <tr>
                      <td>
                        <?php echo $i; ?>
                      </td>
                      <td>
                        <?php echo ucfirst($staffData->name); ?></td>
                      <td>
                        <?php echo ucfirst($staffData->user_name); ?></td>
                      <td>
                        <?php echo ucfirst($staffData->email); ?></td>
                      <td>
                        <?php echo wordwrap($staffData->address,30,"
                        <br>\n"); ?></td>
                      <td>
                        <?php echo ucfirst($staffData->country_code."-".$staffData->mobile_no); ?></td>
                      <td style="display: none;">
                        <?php if($staffData->role =="1"){ ?>
                        <label class="badge badge-teal">Operator</label>
                        <?php }else{ ?>
                        <label class="badge badge-danger">Chef</label>
                        <?php } ?>
                      </td>
                      <td class="py-1">
                        <?php if($staffData->profile_image){ ?>
                        <img style="border-radius: 50%;width: 40px;height: 40px;" src="<?php echo  base_url().$staffData->profile_image; ?>" width="80" height="80" alt="image" />
                        <?php }else{ ?>
                        <img style="border-radius: 50%;width: 40px;height: 40px;" src="<?php echo  base_url('/assets/images/faces-clipart/userblank.png'); ?>" width="80" height="80" alt="image" />
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($staffData->status=="1"){ ?>
                        <label class="badge badge-teal">Activate</label>
                        <?php }else{ ?>
                        <label class="badge badge-danger">Dactivated</label>
                        <?php } ?>
                      </td>
                      <td class="text-center">
                        <!-- <a href="<?php echo base_url(); ?>Admin/editStaff/<?php echo $staffData->id; ?>" title="Edit" class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i class="ti-pencil-alt"></i></a> -->
                        <div class="dropdown">
                          <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a title="Active" class="" href="<?php echo base_url('/Admin/change_staff_status');?>?id=<?php echo $staffData->id; ?>&status=1">Activate</a>
                            </li>
                            <li><a title="Deactive" class="" href="<?php echo base_url('/Admin/change_staff_status');?>?id=<?php echo $staffData->id; ?>&status=0">Deactivate</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>Admin/editStaff/<?php echo $staffData->id; ?>" title="Edit" class="">Edit</a>
                            </li>
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
      </div>