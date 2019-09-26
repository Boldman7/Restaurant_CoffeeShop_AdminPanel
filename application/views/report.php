 <!-- ============================================================== -->
<div id="page-wrapper">
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Purchase Report</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active">Purchase Report</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Purchase Report</div>
                 <div class="white-box">
                <?php $attributes = array('id' => 'form_validation', 'style'=>'margin-top: 13px; margin-bottom: 15px;','name'=>'add_coupon','class'=>'form-sample'); echo form_open_multipart('Admin/report', $attributes); ?>
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
                            <label>Select Company</label>
                          <select name="company_id" class="form-control">
                            <option>Select Company</option>
                            <?php foreach ($company as $company) 
                            { ?>
                            <option value="<?php echo $company->id; ?>" <?php if(isset($company_id)) { if($company_id == $company->id){ echo "selected"; } } ?>><?php echo $company->com_name; ?></option>
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
                                                <th class="text-center">Company</th>
                                                <th>Subtotal</th>
                                                <th>Tax</th>
                                                <th>Price (Tax)</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        <?php $count=1;

                                              $total=0;
                                              $totalTax=0;
                                              $totalSub=0;
                                              foreach ($purechase_info as $purechase_infoData) {
                                            ?>
                                            <tr>
                                            <td><?= $count++;?></td>
                                            <td><?php echo $purechase_infoData->DATE; ?></td>
                                            <td><?php if($company_name) { echo $company_name; } ?></td>
                                            <td><?php echo $purechase_infoData->totalSub; ?></td>
                                            <td><?php echo $purechase_infoData->totalTax; ?></td>
                                            <td><?php echo $purechase_infoData->total; ?></td>
                                            
                                            </tr>
                                            <?php $total += $purechase_infoData->total;  ?>
                                            <?php $totalTax += $purechase_infoData->totalTax;   ?>
                                            <?php $totalSub += $purechase_infoData->totalSub; }  ?>
                                        </tbody>
                                         <tfoot>
                                            <tr>
                                                <th colspan="3"> Total</th>
                                                <th><?php echo round($totalSub,2); ?></th>
                                                <th><?php echo round($totalTax,2); ?></th>
                                                <th><?php echo round($total,2); ?></th>
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