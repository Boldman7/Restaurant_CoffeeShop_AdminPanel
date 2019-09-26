<!-- ============================================================== -->
<!-- End Left Sidebar -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page Content -->

<!-- ============================================================== -->

<div id="page-wrapper">
  <div class="container-fluid">
   <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Purchase</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li class="active">Purchase</li>
        </ol>
    </div>
  </div>
    <div class="row">
      <div class="col-sm-12">
          <div class="white-box">
              <h3 class="box-title m-b-0">Add Purchase</h3>
           <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/add_purchase', $attributes); ?>
                            <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Company</label>
                        <select name="company_name" id='sel_user'  required="required"  class="form-control" >
                              <option value="0">Please Select Company</option>
                               <?php 
                               // print_r($company);
                              if(count($company)>0){
                              foreach($company as $company){?>
                              <option value="<?= $company->id;?>"><?= ucfirst($company->com_name);?></option>   
                            <?php } } ?>
                            </select>
                        </div>
                        </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                          <label class="col-sm-4">Email</label>
                        <input  type="email" value="" id="email"  required="required" name="email" class="form-control">
                          </div>
                          <?php echo form_error('email');?>
                        </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                          <label class="col-sm-4">Contact</label>
                        <input  type="number" id="contact"  required="required" name="phone_no" class="form-control">
                          </div>
                          <?php echo form_error('phone_no');?>
                        </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                          <label class="col-sm-4">Sub-total</label>
                        <input  type="number" id="Sub_total"  required="required" name="Sub_total" class="form-control">
                          </div>
                          <?php echo form_error('sub_total');?>
                        </div>
                        <div class="col-sm-4">
                         <div class="form-group">
                          <label class="col-sm-4">Tax</label>
                        <input  type="number" id="tax"  required="required"  name="tax" class="form-control">
                          </div>
                          <?php echo form_error('tax');?>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Total Price</label>
                        <input  type="number" id="total" name="total_price" required="required" value="" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Date</label>
                        <input  type="date" id="date" name="date" required="required" value="" class="form-control">
                          </div>
                        </div> 

                        <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-sm-4">Image</label>
                        <input  type="file" id="image" name="img_path" required="required" value="" class="form-control">
                          </div>
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
  <!-- .row -->
  <div class="row">
      
   <div class="row">
      <div class="col-md-12">
          <div class="panel">
            <div class="white-box">
              <div class="panel-heading">Purchase Information</div>
               <?php $attributes = array('id' => 'form_validation', 'style'=>'margin-top: 13px; margin-bottom: 15px;','name'=>'add_coupon','class'=>'form-sample'); echo form_open_multipart('Admin/allpurechase', $attributes); ?>
                  <div class="row">
                    <div class="col-sm-4">
                      <input type="date" name="date_fillter" required="" class="form-control">
                    </div>
                    <div class="col-sm-4">
                      <input type="date" name="date1_fillter" required="" class="form-control">
                    </div>
                    <div class="col-sm-4">
                      <input type="submit" name="submit" class="btn btn-primary" value="Filter">
                    </div>
                  </div>
                </form>
              <div class="table-responsive">
                <table id="purchase" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
                  <thead>
                      <tr role="row">
                      <th>S.No.</th>
                      <th class="text-center">Date</th>
                      <th>Company name</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Subtotal</th>
                      <th>Tax</th>
                      <th>Price (Tax)</th>
                      <th>Image</th>
                      <th class="text-center">Action</th>
                      </tr>
                   </thead>
                <?php 
                $count=1;
                if(count($purechase_info))
                {
                  $tax=0;
                  $total_price=0;
                  $final_price=0;
                  foreach ($purechase_info as $purechase_infoData) {
                  ?>
                  <tr>
                    <td><?= $count++;?></td>
                    <td class="text-center"><?php  echo date('d-m-Y', strtotime($purechase_infoData->purchase_date)); ?></td>
                    <td><?php echo $purechase_infoData->company; ?></td>
                    <td><?php echo $purechase_infoData->email; ?></td>
                    <td><?php echo $purechase_infoData->phone; ?></td>
                    <td><?php echo $purechase_infoData->sub_total; ?></td>
                    <td><?php echo $purechase_infoData->tax; ?></td>
                    <td><?php echo $purechase_infoData->final_price; ?></td>
                    <td><a href="<?php echo base_url();?><?php echo $purechase_infoData->filePath; ?>" target="_blank"><img style="border-radius: 50%;width: 50px;height: 50px;    background: #4dabe3;" src="<?php echo base_url();?><?php echo $purechase_infoData->filePath; ?>"></a></td>
                    <td>
                      <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" style="margin-top: -53px;margin-left: -96px;">
                          <li><a class="" href="<?php echo base_url();?>Admin/editPurchase/<?php echo $purechase_infoData->purechase_pub_id;?>">Edit</a></li>
                        </ul>
                     </div>
                    </td>
                   <?php 
                   $tax += $purechase_infoData->tax; 
                 $total_price += $purechase_infoData->sub_total; 
                 $final_price += $purechase_infoData->final_price; } ?>
                </tbody>
                <tfoot>
                  <th class="text-center" colspan="5">Total (₹)</th>
                  <th><?php echo $tax; ?></th>
                  <th><?php echo $total_price; ?></th>
                  <th><?php echo $final_price; ?></th>
                  <th></th>
                  <th></th>
                </tfoot>
                <?php } ?>
            </table>
            </div>
          </div>
         </div>
        </div>
       </div>         
        </div>
      </div>
<script type="text/javascript">
    var BASE_URL = "<?php echo base_url();?>";
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>
  $(document).ready(function(){
 
   $('#sel_user').change(function(){
    var company_name = $(this).val();
    $.ajax({
     url:'<?=base_url()?>Admin/allpurechase',
     method: 'post',
     data: {com_name: company_name},
     dataType: 'json',
     success: function(response){
      var len = response.length;
      // print_r(len);
      // die();

      if(len > 0){
       // Read values
       var email = response[0].email;
       var phone = response[0].phone_no;
 
       $('#semail').text(email);
       $('#phone').text(phone);
 
      }else{
       $('#semail').text('');
       $('#phone').text('');
      }
 
     }
   });
  });
 });
 </script>
