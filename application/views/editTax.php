<div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Edit Tax</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/update_tax', $attributes); ?>
                           
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Tax</label>
                          <input  type="hidden"  name="tax_id" required="required" value="<?php echo $taxData->id;?>" class="form-control">
                        <input  type="text" id="first-name" name="tax" required="required" value="<?php echo $taxData->tax;?>" class="form-control">
                          </div>
                        </div>
                       </div>
                    <div class="ln_solid"></div>
                    <div class="form-group" style="margin-top:26px;">
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

        