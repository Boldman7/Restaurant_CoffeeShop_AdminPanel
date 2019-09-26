<div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add Menu</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/add_menu', $attributes); ?>
                           
                          <div class="col-sm-6">
                          <div class="form-group">
                            <label class="col-sm-4">Category</label>
                            <select name="cat_id" required="required"  class="form-control" >
                            	<option value="">Please Select Category</option>
                            	<?php 
                              if(count($cat)>0){
                              foreach($cat as $catData){?>
                              <option value="<?= $catData->id;?>"><?= ucfirst($catData->cat_name);?></option> 	
                            <?php } } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Menu Name</label>
                        <input  type="text" id="first-name" name="menu_name" required="required" value="<?php echo set_value('menu_name');?>" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Price</label>
                        <input  type="text" id="first-name" name="price" required="required" value="<?php echo set_value('price');?>" class="form-control" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'');">
                          </div>
                        </div>

                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Menu Image</label>
                        <input  type="file" id="first-name" name="img_path" required="required" value="" class="form-control">
                          </div>
                        </div>         
           
                        <div class="col-sm-12">             
                      <div class="form-group">
                      <label class="col-sm-4">Ingredient</label>
                      <textarea name="desc" class="form-control"></textarea>
                          </div>
                        </div>

                        <div class="col-sm-12">
                        <div class="form-group">
                         <label for="chkProduct">
                          <input type="checkbox" name="chkProduct" id="chkProduct" value="1" onclick="ShowHideDiv(this)" />
                          Is Product Countable ?
                      </label>
                        </div>
                        </div>

                        <div class="col-sm-6" id="company" style="display: none">
                        <div class="form-group">
                          <label class="col-sm-4">Company</label>
                        <select name="company_name" onchange="getProductByCompanyId(this.value)" id="com_id"   class="form-control" >
                              <option value="">Please Select Company</option>
                               <?php 
                               // print_r($company);
                              if(count($company)>0){
                              foreach($company as $company){?>
                              <option value="<?= $company->id;?>"><?= ucfirst($company->com_name);?></option>   
                            <?php } } ?>
                            </select>
                        </div>
                        </div>
                       <div class="col-sm-6" id="product" style="display: none">
                        <div class="form-group">
                          <label class="col-sm-4">Product Name</label>
                        <select name="product_name" id="pro_id"   class="form-control" >
                              <option value="">Please Select Product</option>
                               <?php 
                               // print_r($company);
                              if(count($product_info)>0){
                              foreach($product_info as $product_info){?>
                              <option value="<?= $product_info->pro_pub_id;?>"><?= ucfirst($product_info->pro_name);?></option>   
                            <?php } } ?>
                            </select>
                        </div>
                        </div>
                        <div class="col-sm-6" id="measurement" style="display: none">
                        <div class="form-group">
                          <label class="col-sm-4">Measurement</label>
                        <select name="measurement" id="meas_id"   class="form-control" >
                              <option value="">Please Select Measurement</option>
                               <?php 
                               // print_r($company);
                              if(count($measurement_info)>0){
                              foreach($measurement_info as $measurement_info){?>
                              <option value="<?= $measurement_info->meas_pub_id;?>"><?= ucfirst($measurement_info->meas_title);?></option>   
                            <?php } } ?>
                            </select>
                        </div>
                        <?php echo form_error('meas_title');?>
                        </div>
                        
                <script type="text/javascript">
                    function ShowHideDiv(chkProduct) {
                        var dvCompanvy = document.getElementById("company");
                        dvCompanvy.style.display = chkProduct.checked ? "block" : "none";
                        var dvproduct = document.getElementById("product");
                        dvproduct.style.display = chkProduct.checked ? "block" : "none";
                        var dvmeasurement = document.getElementById("measurement");
                        dvmeasurement.style.display = chkProduct.checked ? "block" : "none";
                        if(chkProduct.checked)
                        {
                          document.getElementById("com_id").setAttribute('required', 'required');
                           document.getElementById("pro_id").setAttribute('required', 'required');
                            document.getElementById("meas_id").setAttribute('required', 'required');
                        }
                        else
                        {
                           document.getElementById("com_id").removeAttribute('required');
                           document.getElementById("pro_id").removeAttribute('required');
                            document.getElementById("meas_id").removeAttribute('required');
                        }
                    }
                    function getProductByCompanyId(val)
                    {
                       var xhttp = new XMLHttpRequest();
                       xhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("pro_id").innerHTML = this.responseText;
                    
                    }
                    };
                        xhttp.open("GET", "<?php echo base_url('Admin/getProductByCompanyId/') ?>"+val, true);
                        xhttp.send();
                    }
                </script>

                <div class="ln_solid"></div>
                    <div class="form-group">
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


         <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">All Menu</div>
                            <div class="table-responsive">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" >
                        <thead>
                        <tr>
                        <th>S. No.</th>
                        <th>Category Name</th>
                        <th>Menu Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Action</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $count=1; 
                        foreach ($menu as $menudata){
                        $catData =$this->Api_model->getsingleRow('food_cat',array('id'=>$menudata->cat_id));   
                        ?>
                        <tr>
                        <td><?=  $count++; ?></td>
                        <td><?php echo $catData->cat_name; ?></td>
                        <td><?php echo $menudata->menu_name; ?></td>
                        <td><?php echo $menudata->price; ?></td>
                        <td><?php if($menudata->status==1){ ?>
                        <label class="badge badge-teal">Active</label>
                        <?php }elseif($menudata->status==0){ ?>
                        <label class="badge badge-danger">Deactive</label>
                        <?php } ?>
                        </td>
                        <td>
                        <?php if($menudata->photo!=""){ ?>
                        <img style="border-radius: 50%;width: 50px;height: 50px;    background: #4dabe3;" src="<?php echo base_url();?><?php echo $menudata->photo; ?>" alt="image" width="50" height="50">
                      <?php } else { ?>
                      <img style="border-radius: 50%;width: 50px;height: 50px;    background: #4dabe3;" src="<?php echo base_url();?>assets/images/category/default.jpeg" alt="image" width="50" height="50">
                      <?php } ?>
                        </td>
                        <td>
                         <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" style="margin-top: -39px;margin-left: 82px;">
                          <li><a style="padding: 3px 20px;"  title="Active" class="" href="<?= base_url();?>Admin/change_menu_status?id=<?php echo $menudata->id; ?>&amp;status=1">Active</a></li>
                          <li><a style="padding: 3px 20px;"  title="Deactive" class="" href="<?= base_url();?>Admin/change_menu_status?id=<?php echo $menudata->id; ?>&amp;status=0">Deactive</a></li>
                          <li><a style="padding: 3px 20px;"  href="<?php echo base_url(); ?>Admin/editMenu/<?php echo $menudata->id; ?>" title="Edit" class="">Edit</a></li>
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

        