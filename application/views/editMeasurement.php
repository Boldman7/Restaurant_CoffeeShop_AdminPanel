<div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Edit Measurment</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/update_measurment', $attributes); ?>
                           
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Measurement</label>
                          <input  type="hidden"  name="meas_id" required="required" value="<?php echo $measurementdata->id;?>" class="form-control">
                        <input  type="text" id="first-name" name="meas_title" required="required" value="<?php echo $measurementdata->meas_title;?>" class="form-control">
                          </div>
                        </div>
                       </div>
                    <div class="ln_solid"></div>
                    <div class="form-group" style="margin-top: 27px;">
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

        