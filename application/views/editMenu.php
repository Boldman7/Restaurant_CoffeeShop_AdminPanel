  <div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Edit Menu</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form1', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/update_menu', $attributes); ?>
                            <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Category</label>
                          <select name="cat_id" required="required"  class="form-control" >
                            <option value="">Please Select Category</option>
                            <?php 
                            if(count($cat)>0){
                            foreach($cat as $catData){?>
                            <option <?php if($catData->id == $menudata->cat_id){echo 'selected';}?> value="<?= $catData->id;?>"><?= ucfirst($catData->cat_name);?></option>   
                          <?php } } ?>
                          </select>
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Menu Name</label>
                          <input  type="hidden"  name="menu_id" required="required" value="<?php echo $menudata->id;?>" class="form-control">
                        <input  type="text" id="first-name" name="menu_name" required="required" value="<?php echo $menudata->menu_name;?>" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Price</label>
                        <input  type="text" id="first-name" name="price" required="required" value="<?php echo $menudata->price;?>" class="form-control" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'');">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="col-sm-4">Menu Image</label>
                          <input  type="file" id="first-name" name="img_path" class="form-control">
                          </div>
                        </div>         
           
                        <div class="col-sm-12">             
                          <div class="form-group">
                            <label class="col-sm-6">Ingridiant</label>
                            <textarea name="desc" class="form-control"><?php echo $menudata->menu_desc;?></textarea>
                          </div>
                        </div>
                       <div class="col-sm-12">
                        <div class="form-group">
                         <label for="chkProduct">
                          <input type="checkbox" name="chkProduct" id="chkProduct" value="1" onclick="ShowHideDiv(this)" <?php if($menudata->is_countable=="true"){ ?> checked <?php } ?> />
                          Is Product Countable ?
                      </label>
                        </div>
                        </div>
                        <div class="col-sm-6" id="company" <?php if($menudata->is_countable=="false"){ ?> style="display: none" <?php } ?> >
                        <div class="form-group">
                          <label class="col-sm-4">Company</label>
                        <select name="company_id" onchange="getProductByCompanyId(this.value)" id="com_id"   class="form-control" >
                              <option value="">Please Select Company</option>
                               <?php 
                               // print_r($company);
                              if(count($company)>0){
                              foreach($company as $company){?>
                              <option value="<?= $company->id;?>" <?php if($menudata->company_id==$company->id) { echo "selected"; } ?> ><?= ucfirst($company->com_name);?></option>   
                            <?php } } ?>
                            </select>
                        </div>
                        </div>
                       <div class="col-sm-6" id="product" <?php if($menudata->is_countable=="false"){ ?> style="display: none" <?php } ?>>
                        <div class="form-group">
                          <label class="col-sm-4">Product Name</label>
                        <select name="product_pub_id" id="pro_id"   class="form-control" >
                              <option value="">Please Select Product</option>
                               <?php 
                               // print_r($company);
                              if(count($product_info)>0){
                              foreach($product_info as $product_info){?>
                              <option value="<?= $product_info->pro_pub_id;?>" <?php if($menudata->product_pub_id==$product_info->pro_pub_id) { echo "selected"; } ?>><?= ucfirst($product_info->pro_name);?></option>   
                            <?php } } ?>
                            </select>
                        </div>
                        </div>
                        <div class="col-sm-6" id="measurement" <?php if($menudata->is_countable=="false"){ ?> style="display: none" <?php } ?>>
                        <div class="form-group">
                          <label class="col-sm-4">Measurement</label>
                        <select name="meas_pub_id" id="meas_id"   class="form-control" >
                              <option value="">Please Select Measurement</option>
                               <?php 
                               // print_r($company);
                              if(count($measurement_info)>0){
                              foreach($measurement_info as $measurement_info){?>
                              <option value="<?= $measurement_info->meas_pub_id;?>" <?php if($menudata->meas_pub_id==$measurement_info->meas_pub_id) { echo "selected"; } ?>><?= ucfirst($measurement_info->meas_title);?></option>   
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
                    <button type="submit" class="btn btn-success" style="margin-top: 25px;">Submit</button>
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
      