  <div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Edit Purchase</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form1', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/update_purchase', $attributes); ?>
                           
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Company</label>
                          <input  type="hidden"  name="purechase_pub_id" required="required" value="<?php echo $purechase_info->purechase_pub_id;?>" class="form-control">
                        <input  type="text" id="" name="company" required="required" value="<?php echo $purechase_info->company;?>" class="form-control" readonly>
                          </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Date</label>
                         <input  type="text" id="" name="purechase_date" required="required" value="<?php echo $purechase_info->purchase_date;?>" class="form-control" readonly>
                          </div>
                        </div>
                      </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Email</label>
                        <input  type="email" id="" name="email" required="required" value="<?php echo $purechase_info->email;?>" class="form-control" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Contact</label>
                        <input  type="text" id="" name="phone" class="form-control" value="<?php echo $purechase_info->phone;?>" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" minlength="15" maxlength="15">
                          </div>
                        </div>         
           
                       <div class="col-sm-4">           
                         <div class="form-group">
                           <label class="col-sm-6">Sub Total</label>
                            <input  type="text" id="sub_total" name="sub_total" class="form-control" value="<?php echo $purechase_info->sub_total;?>">
                          </div>
                        </div>

                        <div class="col-sm-4">           
                      <div class="form-group">
                      <label class="col-sm-6">Tax</label>
                       <input  type="number" id="tax" name="tax" class="form-control" value="<?php echo $purechase_info->tax;?>" onKeyup="calculatePrice(this.value);">
                        </div>
                        </div>

                         <div class="col-sm-4">           
                      <div class="form-group">
                      <label class="col-sm-6">Total Price</label>
                       <input  type="text" id="total_price" readonly="" name="final_price" class="form-control" value="<?php echo $purechase_info->final_price;?>">
                        </div>
                        </div>
                         <div class="col-sm-4">           
                      <div class="form-group">
                      <label class="col-sm-6">Image</label>
                       <input  type="file" id="" name="img_path" class="form-control">
                        </div>
                        </div>
                   <div class="ln_solid"></div>
                    <div class="form-group">
                    <div class="col-md-6">
                    <button style="margin-top: 26px;" type="submit" class="btn btn-success">Submit</button>
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
      <script type="text/javascript">
        function calculatePrice (val)
        {
          var sub_total  = document.getElementById("sub_total").value;
          var total_price = eval(sub_total)*eval(val)/100;
          var final_price = eval(sub_total)+eval(total_price);
          document.getElementById("total_price").value=final_price;
         }
      </script>