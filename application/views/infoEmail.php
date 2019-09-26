<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Auction Email</title>
</head>
<body style="font-family: "Lato", sans-serif;font-weight: normal;word-break: break-word;margin:0px;padding:0px;">
    <div class="main_background" style="float: left;width: 100%;">
        <div class="temp_container" style="width:86%;margin-left: auto;margin-right: auto;">
            <div class="logo_area" style="float: left;width: 100%;text-align: center;padding: 2% 14% 2%;box-sizing: border-box;background-color: #eaeaea;">
                <img src="<?= base_url();?>assets/images/logo.png" alt="logo" style="width: 190px;">
            </div>
            <div class="temp_container_in" style="float: left;width: 100%;box-sizing: border-box;margin: 0px 0px 20px;">
                <div class="temp_text" style="float: left;width: 100%;padding:0% 14% 2.5%;box-sizing: border-box;background-color: #eaeaea;border-radius: 2px;">
                    <div class="temp_text_in" style="background-color: white;padding: 2% 4% 1%;box-sizing: border-box;float: left;width: 100%;border-radius: 3px;">
                        
                        
                        <h1 style="color: #505050;font-size: 24px;margin: 0;padding: 0;font-weight: normal;">Hello  <?php echo ucfirst($name) ?></h1>
                        <br>
                        <br>
                        <p style="color: #505050;font-size: 16px;margin: 0;padding: 0;"> <?= $msg ?></p>
                        
                        <div class="btn_area" style="padding: 30px 25% 20px;">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="temp_footer" style="float: left;width: 100%;padding: 0px 0px 10px;box-sizing: border-box;text-align: center;border-bottom: 25px solid #EDEDED;">
                
                <h6 style="margin: 0px; padding: 10px 0px 15px;font-weight: 300;font-size: 11px;color: #848484;"> © 2018 Auction. All Rights Reserved.</h6>
            </div>
        </div>
    </div>
</body>
</html>