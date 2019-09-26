<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Restaurant Email</title>
</head>
<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
  <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
      <tbody>
        <tr style="text-align: center;">
          <td><img src="<?= base_url();?>assets/images/logo.png" style="border:none; width: 170px; height: 170px;"> </td>
        </tr>
      </tbody>
    </table>
    <div style="padding: 40px; background: #fff;">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tbody>
          <tr>
            <td><b>Dear <?= $userName;?>,</b>
              <p>This is to inform you that, Your account with Elite Admin has been created successfully. Log it for more details.</p>
              <!-- <a style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #1e88e5; border-radius: 60px; text-decoration:none;" href='.base_url()."WebService/authAccount?verify=".$verify.'>Verify Account</a> -->
              
              <a style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #1e88e5; border-radius: 60px; text-decoration:none;"  href="<?php echo base_url('WebService/authAccount?verify=');?><?php echo $verify;?>">Verify Account</a>


              <p> <?= $msg; ?></p>
              <b>- Thanks (Restaurant)</b> </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
      <p> © 2018 Restaurant. All Rights Reserved. <br>
        <a href="javascript: void(0);" style="color: #b2b2b5; text-decoration: underline;">Unsubscribe</a> </p>
    </div>
  </div>
</div>
</body>
</html>
