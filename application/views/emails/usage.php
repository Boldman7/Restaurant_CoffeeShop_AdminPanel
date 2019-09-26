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
            <th class="service" style="vertical-align: top;  text-align: left;padding: 5px 20px; color: #5D6975;border-bottom: 1px solid #C1CED9; white-space: nowrap; font-weight: normal;">S. No.</th>

            <th style="padding: 5px 20px; color: #5D6975; border-bottom: 1px solid #C1CED9; white-space: nowrap; font-weight: normal; text-align: center;">Date</th>
            <th style="padding: 5px 20px; color: #5D6975; border-bottom: 1px solid #C1CED9; white-space: nowrap; font-weight: normal; text-align: center;">Item</th>
            <th style="padding: 5px 20px; color: #5D6975; border-bottom: 1px solid #C1CED9; white-space: nowrap; font-weight: normal; text-align: center;">Quantity</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          $count=1;
          if(count($inventory_info))
          {
          foreach ($inventory_info as $inventory_infoData) {
          $product = $this->Api_model->getSingleRow('product_info',array('pro_pub_id'=>$inventory_infoData->pro_pub_id));
        ?>
          <tr>
            <td class="service" style="vertical-align: top;  padding: 20px;  text-align: left; background: #F5F5F5;"><?= $count++;?></td>
            <td class="unit" style="font-size: 1.2em;  padding: 20px; text-align: center; background: #F5F5F5;"><?php echo date('d-m-Y',($inventory_infoData->created_at)/1000); ?></td>
            <td class="qty" style="font-size: 1.2em;  padding: 20px; text-align: center; background: #F5F5F5;"><?php echo $product->pro_name; ?></td>
            <td class="total" style="font-size: 1.2em;  padding: 20px; text-align: center; background: #F5F5F5;"><?php echo $inventory_infoData->quantity; ?></td>
          </tr>
          <?php } ?>
          <!-- <tr>
            <td colspan="3" style="padding: 20px; text-align: center;">TAX 25%</td>
            <td class="total" style="font-size: 1.2em;  padding: 20px; text-align: center;">$1,300.00</td>
          </tr> -->
          <!--   <tr>
            <td colspan="4" class="grand total" style="border-top: 1px solid #5D6975; text-align: center; padding-top: 10px;">GRAND TOTAL</td>
            <td class="grand total" style="border-top: 1px solid #5D6975; text-align: center; padding-top: 10px;"><?php echo $total; ?></td>
          </tr>  -->
          <?php } ?>
        </tbody>
      </table>

    </main>
    <footer style="color: #5D6975; width: 100%; height: 30px; position: absolute;  bottom: 0; border-top: 1px solid #C1CED9; padding: 8px 0; text-align: center;">
      It was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>