<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Restaurant App</title>
    <style type="text/css">
      .clearfix:after {
        content: "";
        display: table;
        clear: both;
      }
    </style>
  </head>
  <body style="position: relative;width: 21cm; height: 29.7cm; margin: 0 auto; color: #001028; background: #FFFFFF; font-family: Arial, sans-serif; font-size: 12px; font-family: Arial;">
    <header class="clearfix" style="padding: 10px 0; margin-bottom: 30px;">
      <div id="logo" style="text-align: center; margin-bottom: 10px;">
        <img src="<?php echo base_url('assets/plugins/images/favicon.png'); ?>" style="width: 125px; height: 28px;">
      </div>
      <h1 style=" border-top: 1px solid  #5D6975; border-bottom: 1px solid  #5D6975;color: #5D6975; font-size: 2.4em; line-height: 1.4em; font-weight: normal;text-align: center; margin: 0 0 20px 0; background: url(http://phpstack-132936-544601.cloudwaysapps.com/assets/images/dimension.png);"><?php echo $msg; ?> of <?php echo date('Y-m-d',strtotime("-1 days")); ?></h1>
    </header>
    <main>
      <table style="width: 100%; border-collapse: collapse; border-spacing: 0; margin-bottom: 20px;">
        <thead>
          <tr>
            <th class="service" style="vertical-align: top;  text-align: left;padding: 5px 20px; color: #5D6975;border-bottom: 1px solid #C1CED9; white-space: nowrap; font-weight: normal;">Date</th>

            <th style="padding: 5px 20px; color: #5D6975; border-bottom: 1px solid #C1CED9; white-space: nowrap; font-weight: normal; text-align: center;">Type</th>
            <th style="padding: 5px 20px; color: #5D6975; border-bottom: 1px solid #C1CED9; white-space: nowrap; font-weight: normal; text-align: center;">Customer</th>
            <th style="padding: 5px 20px; color: #5D6975; border-bottom: 1px solid #C1CED9; white-space: nowrap; font-weight: normal; text-align: center;">Status</th>
            <th style="padding: 5px 20px; color: #5D6975; border-bottom: 1px solid #C1CED9; white-space: nowrap; font-weight: normal; text-align: center;">Amount</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          $count=1;
          if(count($invoice))
          {
            $total=0;
            foreach ($invoice as $invoiceData) {
            $Operator = $this->Api_model->getOperatorInfo('staff',array('staff_pub_id'=>$invoiceData->operator_pub_id));
            $chef = $this->Api_model->getUserInfo('staff',array('staff_pub_id'=>$invoiceData->chef_pub_id));
             $name='';
             $delivery_address ='';
             $mobile_no ='';
            if($invoiceData->order_type=='2')
            {
              $user = $this->Api_model->getUserInfo('users',array('user_pub_id'=>$invoiceData->user_pub_id));
              $name = $user->name;
              $delivery_address = $invoiceData->delivery_address;
              $mobile_no = $user->mobile_no;
            }

            $total= $total + $invoiceData->final_price;
        ?>
          <tr>
            <td class="service" style="vertical-align: top;  padding: 20px;  text-align: left; background: #F5F5F5;"><?php  echo date('d-m-y', ($invoiceData->updated_at/1000) ); ?></td>
            <td class="unit" style="font-size: 1.2em;  padding: 20px; text-align: center; background: #F5F5F5;"><?php if($invoiceData->order_type=='1'){echo 'Walking';} ?>
                    <?php if($invoiceData->order_type=='2'){echo 'Delivery';} ?>
                    <?php if($invoiceData->order_type=='3'){echo 'Parcle';} ?></td>
            <td class="qty" style="font-size: 1.2em;  padding: 20px; text-align: center; background: #F5F5F5;"><?php echo $name; ?></td>
            <td class="total" style="font-size: 1.2em;  padding: 20px; text-align: center; background: #F5F5F5;"><?php if($invoiceData->invoice_status=='1')
                    { ?>
                       <?php echo 'Ongoing'; } 
                      if($invoiceData->invoice_status=='2') { ?>
                      <?php echo 'Completed'; } ?>
                      <?php if($invoiceData->invoice_status=='3'){?>
                      <?php echo 'Pending'; } 
                       if($invoiceData->invoice_status=='4'){?>
                      <?php echo 'Cancel'; } ?></td>
            <td class="total" style="font-size: 1.2em;  padding: 20px; text-align: center; background: #F5F5F5;"><?php echo $invoiceData->final_price; ?></td>
          </tr>
          <?php } ?>
          <!-- <tr>
            <td colspan="3" style="padding: 20px; text-align: center;">TAX 25%</td>
            <td class="total" style="font-size: 1.2em;  padding: 20px; text-align: center;">$1,300.00</td>
          </tr> -->
            <tr>
            <td colspan="4" class="grand total" style="border-top: 1px solid #5D6975; text-align: center; padding-top: 10px;">GRAND TOTAL</td>
            <td class="grand total" style="border-top: 1px solid #5D6975; text-align: center; padding-top: 10px;"><?php echo $total; ?></td>
          </tr> 
          <?php } ?>
        </tbody>
      </table>

    </main>
    <footer style="color: #5D6975; width: 100%; height: 30px; position: absolute;  bottom: 0; border-top: 1px solid #C1CED9; padding: 8px 0; text-align: center;">
      It was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>