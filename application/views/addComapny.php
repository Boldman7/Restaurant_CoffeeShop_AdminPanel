<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
          <div class="white-box">
              <h3 class="box-title m-b-0">Add Company</h3>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/add_company', $attributes); ?>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label class="col-sm-4">Name</label>
                            <input  type="text" id="first-name" name="com_name" required="required" class="form-control">
                          </div>
                          <?php echo form_error('com_name');?>
                        </div>

                         <div class="col-sm-4">
                           <div class="form-group">
                              <label class="col-sm-4">Email</label>
                              <input  type="text" id="first-name" name="email" class="form-control">
                           </div>
                            <?php echo form_error('email');?>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label class="col-sm-4">Phone No.</label>
                              <input  type="text" id="first-name"  name="phone_no" class="form-control">
                            </div>
                          <?php echo form_error('phone_no');?>
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

         <div class="row">
            <div class="col-md-12">
              <div class="white-box">
                <div class="panel">
                    <div class="panel-heading">All Companies</div>
                      <div class="table-responsive">
                        <table id="example23" class="table table-hover manage-u-table table-responsive" id="">
                        <thead>
                        <tr>
                          <th>Sno.</th>
                          <th>Company Name</th>
                          <th>Email Address</th>
                          <th>Phone No.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $count=1; 
                        foreach ($company as $company) { ?>
                        <tr style="height: 91px;">
                          <td><?=  $count++; ?></td>
                          <td><?php echo $company->com_name; ?></td>
                          <td><?php echo $company->email; ?></td>
                          <td><?php echo $company->phone_no; ?></td>
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