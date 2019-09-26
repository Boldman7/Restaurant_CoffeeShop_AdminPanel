 <!-- ============================================================== -->
<div id="page-wrapper">
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Sale Report</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active">Sale Report</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Sale Report</div>
                 <div class="white-box">
                <?php $attributes = array('id' => 'form_validation', 'style'=>'margin-top: 13px; margin-bottom: 15px;','name'=>'add_coupon','class'=>'form-sample'); echo form_open_multipart('Admin/sale_report', $attributes); ?>
                      <div class="row">
                        <div class="col-sm-4">
                        <label>Start Date</label>
                          <input type="date" name="date_fillter" value="<?php if(isset($date_fillter)) { echo $date_fillter; } ?>" required="" class="form-control">
                        </div>
                        <div class="col-sm-4">
                          <label>End Date</label>
                          <input type="date" name="date1_fillter" value="<?php if(isset($date_fillter)) { echo $date_fillter1; } ?>" required="" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Select Menu</label>
                              <select name="menu_pub_id" class="form-control">
                              <option value="0">Please Select Menu</option>
                                <?php foreach ($menu as $menu) { ?>
                                <option value="<?php echo $menu->menu_pub_id; ?>" <?php if(isset($date_fillter)) { if($menu_pub_id == $menu->menu_pub_id){ echo "selected"; } } ?>><?php echo $menu->menu_name; ?></option>
                              <?php } ?>
                              </select>
                        </div>
                        <div class="col-sm-4">
                          <input type="submit" name="submit" class="btn btn-primary" value="Filter" style="margin-top: 25px;">
                        </div>
                      </div>
                    </form> 
                <div class="panel-body">
                    <ul class="nav nav-pills m-b-30 ">
                    </ul>
                    <div class="tab-content br-n pn">
                        <div id="navpills-1" class="tab-pane active">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="example23 display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th class="text-center">Date</th>
                                                <th>Menu Name</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        <?php $count=1;

                                              $total=0;
                                              $quantity=0;
                                              $totalSub=0;
                                              foreach ($purechase_info as $purechase_infoData) {
                                            ?>
                                            <tr>
                                            <td><?= $count++;?></td>
                                            <td><?php echo $purechase_infoData->DATE; ?></td>
                                            <td><?php echo $purechase_infoData->menu_name; ?></td>
                                            <td><?php echo $purechase_infoData->quantity; ?></td>
                                            <td><?php echo round($purechase_infoData->totalSub,2); ?></td>
                                            
                                            </tr>
            
                                            <?php $totalSub += $purechase_infoData->totalSub;   ?>
                                            <?php $quantity += $purechase_infoData->quantity; }  ?>
                                        </tbody>
                                         <tfoot>
                                            <tr>
                                                <th colspan="3"> Total</th>
                                                <th><?php echo $quantity; ?></th>
                                                <th><?php echo round($totalSub,2); ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>