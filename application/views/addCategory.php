<div id="page-wrapper">
            <div class="container-fluid">
               
       <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add Category</h3>
                         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <?php $attributes = array('id' => 'demo-form2', 'name'=>'randform','class'=>'form-horizontal form-label-left');
                            echo form_open_multipart('admin/add_Food', $attributes); ?>
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Category Name</label>
                        <input  type="text" id="first-name" name="cat_name" required="required" value="<?php echo set_value('cat_name');?>" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4">Category Image</label>
                        <input  type="file" id="first-name" name="img_path" required="required" value="" class="form-control">
                          </div>
                        </div>         
           
                        <div class="col-sm-12">             
                      <div class="form-group">
                      <label class="col-sm-4">Category Description</label>
                      <textarea name="desc" class="form-control"></textarea>
                          </div>
                        </div>
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
                            <div class="panel-heading">All Category</div>
                            <div class="table-responsive">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" >
                        <thead>
                        <tr>
                        <th>Sno.</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Category Description</th>
                        <th>Image</th>
                        <th>Action</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $count=1; foreach ($get_company as $company){ ?>
                        <tr>
                        <td><?=  $count++; ?></td>
                        <td><?php echo $company->cat_name; ?></td>
                         <td><?php if($company->status==1){ ?>
                        <label class="badge badge-teal">Active</label>
                        <?php }elseif($company->status==0){ ?>
                        <label class="badge badge-danger">Deactive</label>
                        <?php } ?>
                        </td>

                        <td><?php echo $company->cat_desc; ?></td>
                        <td>
                        <?php if($company->cat_img!=""){ ?>
                        <img style="border-radius: 50%;width: 50px;height: 50px;    background: #4dabe3;" src="<?php echo base_url();?><?php echo $company->cat_img; ?>" alt="image" width="50" height="50">
                      <?php } else { ?>
                      <img style="border-radius: 50%;width: 50px;height: 50px;    background: #4dabe3;" src="<?php echo base_url();?>assets/images/category/default.jpeg" alt="image" width="50" height="50">
                      <?php } ?>
                        </td>
                        <td>
                         
                          <div class="dropdown" >
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Manage
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" style="margin-top: -39px;margin-left: 82px;">
                          <li><a style="padding: 3px 20px;" title="Active" class="" href="<?= base_url();?>Admin/change_cat_status?id=<?php echo $company->id; ?>&amp;status=1">Active</a></li>
                          <li><a style="padding: 3px 20px;" title="Deactive" class="" href="<?= base_url();?>Admin/change_cat_status?id=<?php echo $company->id; ?>&amp;status=0">Deactive</a></li>
                          <li> <a style="padding: 3px 20px;" href="<?php echo base_url(); ?>Admin/editFood/<?php echo $company->id; ?>" title="Edit" class="">Edit</i></a>
                          </li>
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

        