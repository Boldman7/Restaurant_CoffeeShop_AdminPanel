<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class WebService extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> library('session');
		$this -> load -> database();
	    $this -> load -> library('form_validation');
		$this -> load-> library('image_lib');
		$this -> load -> model('Api_model');
		$this -> load->library('api');
		//Reminders Functions

        header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	}
 /*Added By Varun_Andro*/
 	public function index()
	{
		$this->load->view('signup.php');
	}

	public function login()	
	{
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

	    $username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);
	
		$table= 'staff';       
        $condition = array('user_name'=>$username,'status'=>1);

        $check_user = $this->Api_model->getSingleRow($table, $condition);
        if ($check_user) 
		{  
            if($check_user->password!=md5($password))
            {
                $this->Api_model->responseSuccessWithOutData(0,"Invalid password.");
                exit();
            }
            if ($check_user->status==0) 
            { 
                $this->Api_model->responseSuccessWithOutData(0,"You are not active user. Please contact to admin.");
            }
            else
            {
                $this->Api_model->responseSuccess(1,LOGIN,$check_user);
            }
		}
		else
		{
			$this->Api_model->responseSuccessWithOutData(0,"User not available.");
		}    
	}

	public function getCategory()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $getCategory= $this->Api_model->getAllDataWhere(array('status'=>1), 'food_cat');
        if($getCategory)
        {
        	$this->Api_model->responseSuccess(1,"Get all categories.",$getCategory);
        }
        else
        {
        	$this->Api_model->responseSuccessWithOutData(0,"No category found.");
        }
	}

    public function getCompanies()
    {
        $this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $getCategory= $this->Api_model->getAllDataWhere(array('status'=>1), 'company');
        if($getCategory)
        {
            $this->Api_model->responseSuccess(1,"Get all company.",$getCategory);
        }
        else
        {
            $this->Api_model->responseSuccessWithOutData(0,"No company found.");
        }
    }

	public function addTocart()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
		$this->form_validation->set_rules('menu_pub_id','menu_pub_id','required');
		$this->form_validation->set_rules('quantity','quantity','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $data['operator_pub_id'] = $this->input->post('operator_pub_id',TRUE);
        $data['menu_pub_id'] = $this->input->post('menu_pub_id',TRUE);
        $data['quantity'] = $this->input->post('quantity',TRUE);
        $getId=$this->Api_model->insertGetId('product_basket',$data);
		if($getId)
         {
			$this->Api_model->responseFailed(1, "Cart updated successfully.");
         }
         else
         {
			$this->Api_model->responseFailed(0, NOT_RESPONDING);
         }
	}

	public function getMyCart()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $operator_pub_id = $this->input->post('operator_pub_id',TRUE);
        $getMyCart=$this->Api_model->getMyCart($operator_pub_id);
		if($getMyCart)
         {
            $getMyCarts= array();
            foreach ($getMyCart as $getMyCart) 
            {
               if($getMyCart->product_pub_id !="" || $getMyCart->product_pub_id !=null)
               {
                 $product_info = $this->Api_model->getSingleRow("product_info", array('pro_pub_id'=>$getMyCart->product_pub_id));
                 $getMyCart->product_quantity=$product_info->quantity;
               }
               else
               {
                 $getMyCart->product_quantity="available";
               }

               array_push($getMyCarts, $getMyCart);
            }
			$this->Api_model->responseSuccess(1,"Get all categories.",$getMyCarts);
         }
         else
         {
			$this->Api_model->responseFailed(0, NOT_RESPONDING);
         }
	}

	public function updateCartQuantity()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
		$this->form_validation->set_rules('menu_pub_id','menu_pub_id','required');
		$this->form_validation->set_rules('quantity','quantity','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $operator_pub_id = $this->input->post('operator_pub_id',TRUE);
        $menu_pub_id = $this->input->post('menu_pub_id',TRUE);
        $quantity = $this->input->post('quantity',TRUE);
        $this->Api_model->updateSingleRow('product_basket', array('menu_pub_id'=>$menu_pub_id,'operator_pub_id'=>$operator_pub_id), array('quantity'=>$quantity));
        
		$this->Api_model->responseFailed(1, "Cart updated successfully.");
	}

	public function removeCart()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
		$this->form_validation->set_rules('menu_pub_id','menu_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $operator_pub_id = $this->input->post('operator_pub_id',TRUE);
        $menu_pub_id = $this->input->post('menu_pub_id',TRUE);
        $this->Api_model->deleteRecord(array('menu_pub_id'=>$menu_pub_id,'operator_pub_id'=>$operator_pub_id),'product_basket');
        
		$this->Api_model->responseFailed(1, "Cart updated successfully.");
	}

	public function deleteCart()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $operator_pub_id = $this->input->post('operator_pub_id',TRUE);
        $this->Api_model->deleteRecord(array('operator_pub_id'=>$operator_pub_id),'product_basket');
        
		$this->Api_model->responseFailed(1, "Cart deleted successfully.");
	}

	public function getMeasurement()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $measurement_info= $this->Api_model->getAllDataWhere(array('status'=>1), 'measurement_info');
        if($measurement_info)
        {
        	$this->Api_model->responseSuccess(1,"Get all measurements.",$measurement_info);
        }
        else
        {
        	$this->Api_model->responseSuccessWithOutData(0,"No category found.");
        }
	}

	public function addUser()
	{
		$this->form_validation->set_rules('mobile_no','mobile_no','required');
		$this->form_validation->set_rules('staff_pub_id','staff_pub_id','required');
		$this->form_validation->set_rules('country_code','country_code','required');
		$this->form_validation->set_rules('name','name','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $data['mobile_no'] = $this->input->post('mobile_no',TRUE);
		$data['staff_pub_id'] = $this->input->post('staff_pub_id',TRUE);
		$data['country_code'] = $this->input->post('country_code',TRUE);
		$data['name'] = $this->input->post('name',TRUE);
		$data['area'] = $this->input->post('area',TRUE);
		$data['floor_no'] = $this->input->post('floor_no',TRUE);
        $data['building_no'] = $this->input->post('building_no',TRUE);
        $data['flat_no'] = $this->input->post('flat_no',TRUE);
        $data['city'] = $this->input->post('city',TRUE);
        $data['created_at'] = time();
		$data['updated_at'] = time();

		$check_user = $this->Api_model->getSingleRow("users", array('mobile_no'=>$data['mobile_no'],'country_code'=>$data['country_code']));
		if($check_user)
		{
			$this->Api_model->updateSingleRow('users', array('mobile_no'=>$data['mobile_no'],'country_code'=>$data['country_code']), $data);
            $check_user = $this->Api_model->getSingleRow("users", array('mobile_no'=>$data['mobile_no'],'country_code'=>$data['country_code']));
            $this->Api_model->responseSuccess(1,"User added successfully.",$check_user);
		}
		else
		{
            $data['user_pub_id']=$this->getToken(12);
			$getId=$this->Api_model->insertGetId('users',$data);
			$this->Api_model->responseSuccessWithOutData(1,"User added successfully.");

            $check_user = $this->Api_model->getSingleRow("users", array('id'=>$getId));

            $this->Api_model->responseSuccess(1,"User added successfully.",$check_user);
		}
	}

    public function checkUser()
    {
        $this->form_validation->set_rules('mobile_no','mobile_no','required');;
        $this->form_validation->set_rules('country_code','country_code','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $data['mobile_no'] = $this->input->post('mobile_no',TRUE);
        $data['country_code'] = $this->input->post('country_code',TRUE);


        $check_user = $this->Api_model->getSingleRow("users", array('mobile_no'=>$data['mobile_no'],'country_code'=>$data['country_code']));
        if($check_user)
        {
            
            $this->Api_model->responseSuccess(1,"Get all products.",$check_user);
        }
        else
        {
            $this->Api_model->responseSuccessWithOutData(0,"No user found.");
        }
    }

	public function getProduct()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $getProduct= $this->Api_model->getAllDataWhere(array('status'=>1), 'product_info');
        if($getProduct)
        {
        	$this->Api_model->responseSuccess(1,"Get all products.",$getProduct);
        }
        else
        {
        	$this->Api_model->responseSuccessWithOutData(0,"No product found.");
        }
	}

    public function getProductsByCompany()
    {
        $this->form_validation->set_rules('company_id','company_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $company_id = $this->input->post('company_id',TRUE);
        $getProduct= $this->Api_model->getProductsByCompany($company_id);
        if($getProduct)
        {
            $this->Api_model->responseSuccess(1,"Get all products.",$getProduct);
        }
        else
        {
            $this->Api_model->responseSuccessWithOutData(0,"No product found.");
        }
    }

	public function getSupplier()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $getSupplier= $this->Api_model->getAllDataWhere(array('status'=>1), 'supplier_info');
        if($getSupplier)
        {
        	$this->Api_model->responseSuccess(1,"Get all supplier.",$getSupplier);
        }
        else
        {
        	$this->Api_model->responseSuccessWithOutData(0,"No supplier found.");
        }
	}

	public function getChef()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $getChef= $this->Api_model->getAllDataWhere(array('status'=>1,'role'=>2), 'staff');
        if($getChef)
        {
        	$this->Api_model->responseSuccess(1,"Get all chef.",$getChef);
        }
        else
        {
        	$this->Api_model->responseSuccessWithOutData(0,"No chef found.");
        }
	}

	public function getPendingOder()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
		$this->form_validation->set_rules('status','status','required');
		$this->form_validation->set_rules('role','role','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $operator_pub_id=$this->input->post('operator_pub_id',TRUE);
        $status=$this->input->post('status',TRUE);
        $role=$this->input->post('role',TRUE);
        if($status==2)
        {
        	$getPendingOder= $this->Api_model->getPeddingOrder($operator_pub_id,$role,$status);
        }
        elseif ($status==3) 
        {
        	$getPendingOder= $this->Api_model->getPeddingOrderOr($operator_pub_id,$role,$status);
        }
        
        if($getPendingOder)
        {
        	$this->Api_model->responseSuccess(1,"Get orders chef.",$getPendingOder);
        }
        else
        {
        	$this->Api_model->responseSuccessWithOutData(0,"No order found.");
        }
	}

/*	public function changeOrderStatus()
	{
		$this->form_validation->set_rules('invoice_pub_id','invoice_pub_id','required');
		$this->form_validation->set_rules('invoice_status','invoice_status','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $invoice_status = $this->input->post('invoice_status',TRUE);
        $invoice_pub_id = $this->input->post('invoice_pub_id',TRUE);
        $this->Api_model->updateSingleRow('invoice', array('invoice_pub_id'=>$invoice_pub_id), array('invoice_status'=>$invoice_status));
        
		$this->Api_model->responseFailed(1, "Order status updated successfully.");
	}*/

	public function menuEnableDisable()
	{
		$this->form_validation->set_rules('menu_pub_id','menu_pub_id','required');
		$this->form_validation->set_rules('menu_status','menu_status','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $menu_status = $this->input->post('menu_status',TRUE);
        $menu_pub_id = $this->input->post('menu_pub_id',TRUE);
        $this->Api_model->updateSingleRow('menu', array('menu_pub_id'=>$menu_pub_id), array('menu_status'=>$menu_status));
        
		$this->Api_model->responseFailed(1, "Menu status updated successfully.");
	}

	public function totalSalePurchase()
	{
        $start_date = $this->input->post('start_date',TRUE);
        $end_date = $this->input->post('end_date',TRUE);

        $total_sale_date=0;
        $today_purchase_date=0;
        if(isset($end_date))
        {
            $start_date  = strtotime($start_date)*1000;
            $end_date  = (strtotime($end_date)+86400)*1000;
        	$sale_date=$this->Api_model->getSumBetween("invoice",$start_date,$end_date);
        	if($sale_date->amt !=null)
	        {
	        	$total_sale_date=round($sale_date->amt,2);
	        }
	        else
	        {
	        	$total_sale_date=0;
	        }
        	$purchase_date=$this->Api_model->getSumBetween("purechase_info",$start_date,$end_date);
        	if($purchase_date->amt !=null)
	        {
	        	$today_purchase_date=round($purchase_date->amt,2);
	        }
	        else
	        {
	        	$today_purchase_date=0;
	        }
        }

        $total_sale=$this->Api_model->getSumAll("invoice");
        if($total_sale->amt !=null)
        {
        	$total_sale_var=round($total_sale->amt,2);
        }
        else
        {
        	$total_sale_var=0;
        }
        
        $today_sale=$this->Api_model->getTodaySum("invoice");
        if($today_sale->amt !=null)
        {
        	$today_sale_var=round($today_sale->amt,2);
        }
        else
        {
        	$today_sale_var=0;
        }

        $total_purchase=$this->Api_model->getSumAll("purechase_info");
        if($total_purchase->amt !=null)
        {
        	$total_purchase_var=round($total_purchase->amt,2);
        }
        else
        {
        	$total_purchase_var=0;
        }

        $today_purchase=$this->Api_model->getTodaySum("purechase_info");
        if($today_purchase->amt !=null)
        {
        	$today_purchase_var=round($today_purchase->amt,2);
        }
        else
        {
        	$today_purchase_var=0;
        }
        
        $data["today_purchase"]=$today_purchase_var;
        $data["total_purchase"]=$total_purchase_var;
        $data["today_sale"]=$today_sale_var;
        $data["total_sale"]=$total_sale_var;
        $data["total_sale_date"]=$total_sale_date;
        $data["total_purchase_date"]=$today_purchase_date;

		$this->Api_model->responseSuccess(1,"Get total sale purchse data.",$data);
	}

	public function order()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
        $this->form_validation->set_rules('order_type','order_type','required');
		$this->form_validation->set_rules('chef_pub_id','chef_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $order_type = $this->input->post('order_type',TRUE);
        $invoice_status = $this->input->post('invoice_status',TRUE);
        $chef_pub_id = $this->input->post('chef_pub_id',TRUE);
        $operator_pub_id = $this->input->post('operator_pub_id',TRUE);

        $getOrderData= $this->Api_model->getOrderData($operator_pub_id);

        if($getOrderData)
        {
            $invoice_pub_id= $this->getToken(8);
            $total_sum=0;
        	foreach ($getOrderData as $getOrderData) 
            {
                $getMenu= $this->Api_model->getSingleRow('menu',array('menu_pub_id'=>$getOrderData->menu_pub_id));
                if($getMenu->is_countable=='true' && $getMenu->product_pub_id!='')
                {
                    $getProduct= $this->Api_model->getSingleRow('product_info',array('pro_pub_id'=>$getMenu->product_pub_id));
                    
                    $data['pro_pub_id']= $getMenu->product_pub_id;
                    $data['company_id']= $getMenu->company_id;
                    $data['quantity']= $getOrderData->quantity;
                    $data['date']= date('d-m-Y');
                    $data['type']= 1;
                    $data['created_at']= time()*1000;

                    $getId=$this->Api_model->insertGetId('product_usage',$data);

                    $this->Api_model->updateSingleRow('product_info', array('pro_pub_id'=>$getMenu->product_pub_id), array('quantity'=>($getProduct->quantity-$getOrderData->quantity)));   
                }
                
                $orderData['menu_pub_id']= $getOrderData->menu_pub_id;
                $orderData['invoice_pub_id']= $invoice_pub_id;
                $orderData['quantity']= $getOrderData->quantity;
                $orderData['total_price']= round($getOrderData->total_price, 2);
                $orderData['order_date']= date('d-m-Y');
                $orderData['created_at']= time()*1000;
                $orderData['updated_at']= time()*1000;

                $getId=$this->Api_model->insertGetId('orders',$orderData);

                $delivery_address = 'Address Not found';
                $latitude = '0.00';
                $longitude = '0.00';
                $user_pub_id = 'Customer';

                if ($order_type == 2) 
                {
                    $delivery_address = $delivery_address;
                    $latitude = $latitude;
                    $longitude = $longitude;
                    $user_pub_id = $user_pub_id;
                }

                $total_sum = $total_sum + $getOrderData->total_price;

                $getTax= $this->Api_model->getSingleRow('tax_info',array('status'=>1));
                $final_price = $total_sum * ($getTax->tax / 100);
                $final_price = $total_sum + $final_price;
                
                $this->Api_model->deleteRecord(array('operator_pub_id'=>$operator_pub_id), 'product_basket');
            }
            $invoiceData['invoice_pub_id']= $invoice_pub_id;
            $invoiceData['operator_pub_id']= $operator_pub_id;
            $invoiceData['chef_pub_id']= $chef_pub_id;
            $invoiceData['user_pub_id']= $user_pub_id;
            $invoiceData['order_type']= $order_type;
            if(isset($invoice_status))
            {
                $invoiceData['invoice_status']= $invoice_status;
            }
            $invoiceData['total_price']= round($total_sum,2);
            $invoiceData['final_price']= round($final_price,2);
            $invoiceData['tax']= $getTax->tax;
            $invoiceData['delivery_address']= $delivery_address;
            $invoiceData['latitude']= $latitude;
            $invoiceData['invoice_date']= date('d-m-Y');;
            $invoiceData['longitude']= $longitude;
            $invoiceData['created_at']= time()*1000;
            $invoiceData['updated_at']= time()*1000;

            $getId=$this->Api_model->insertGetId('invoice',$invoiceData);

            $getInvoice=$this->Api_model->getSingleRow('invoice',array('invoice_pub_id'=>$invoice_pub_id));
            $produuct_info=$this->Api_model->getOrderInfoV2($invoice_pub_id);
            $getInvoice->produuct_info=$produuct_info;
            $this->Api_model->responseSuccess(1,"Get invoice data.",$getInvoice);
        }
        else
        {
            $this->Api_model->responseFailed(0, NOT_RESPONDING);
        }
	}

    public function deleteOrder()
    {
        $this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
        $this->form_validation->set_rules('invoice_pub_id','invoice_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

        $operator_pub_id = $this->input->post('operator_pub_id',TRUE);
        $invoice_pub_id = $this->input->post('invoice_pub_id',TRUE);

        $getInvoice=$this->Api_model->getSingleRow('invoice',array('invoice_pub_id'=>$invoice_pub_id));
        if($getInvoice)
        {
            $getId=$this->Api_model->insertGetId('deleted_invoice',$getInvoice);
            $orders= $this->Api_model->getAllDataWhere(array('invoice_pub_id'=>$invoice_pub_id), 'orders');
            foreach ($orders as $orders) 
            {
                $getMenu= $this->Api_model->getSingleRow('menu',array('menu_pub_id'=>$orders->menu_pub_id));

                if($getMenu->is_countable=='true' && $getMenu->product_pub_id!='')
                {
                    $getProduct= $this->Api_model->getSingleRow('product_info',array('pro_pub_id'=>$getMenu->product_pub_id));
                    
                    $this->Api_model->updateSingleRow('product_info', array('pro_pub_id'=>$getMenu->product_pub_id), array('quantity'=>($getProduct->quantity+$orders->quantity)));   
                }
            }
            
            $this->Api_model->deleteRecord(array('invoice_pub_id'=>$invoice_pub_id), 'invoice');
            $this->Api_model->deleteRecord(array('invoice_pub_id'=>$invoice_pub_id), 'orders');
            $this->Api_model->responseFailed(1,"Order deleted successfully.");
            exit();
        }
        else
        {
            $this->Api_model->responseFailed(0,"No order found.");
            exit();
        }
    }    

    function getToken($length)
    {
         $token = "";
         $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
         $codeAlphabet.= "0123456789";
         $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }

        return $token;
    }

	public function addInventory()
	{
        $this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
        $this->form_validation->set_rules('sup_pub_id','sup_pub_id','required');
        $this->form_validation->set_rules('inv_date','inv_date','required');
        $this->form_validation->set_rules('meas_pub_id','meas_pub_id','required');
        $this->form_validation->set_rules('pro_pub_id','pro_pub_id','required');
        $this->form_validation->set_rules('quantity','quantity','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }
        
		$data['sup_pub_id'] = $this->input->post('sup_pub_id',TRUE);
		$operator_pub_id = $this->input->post('operator_pub_id',TRUE);
        $purchase_date = $this->input->post('inv_date',TRUE);
		$data['inv_date'] = $purchase_date;
        $data['measurement'] = $this->input->post('meas_pub_id',TRUE);
		$data['company_id'] = $this->input->post('company_id',TRUE);
		$data['pro_pub_id'] = $this->input->post('pro_pub_id',TRUE);
		$data['quantity'] = $this->input->post('quantity',TRUE);
		$data['inv_pub_id'] = $this->api->strongToken(12);
		$data['created_at'] = strtotime($purchase_date)*1000;
		$data['updated_at'] = strtotime($purchase_date)*1000;
		$image = $this->input->post('image',TRUE);

		$this->load->library('upload');
		$config['image_library'] = 'gd2';
		$config['upload_path']   = './assets/images/'; 
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']      = 10000; 
		$config['file_name']     = time();
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 250;
		$config['height'] = 250;
		$this->upload->initialize($config);
		$imageFile="";
		if ( $this->upload->do_upload('image') && $this->load->library('image_lib', $config))
		{         
		  $imageFile='assets/images/'.$this->upload->data('file_name');
		  $data['filePath']=$imageFile;
		}

		$getId=$this->Api_model->insertGetId('inventory_info',$data);
		if($getId)
         {
            $getProduct = $this->Api_model->getSingleRow("product_info", array('pro_pub_id'=>$data['pro_pub_id'])); 
            if($getProduct)
            {
                $quantity=$getProduct->quantity+$data['quantity'];
                $quantity=$data['quantity'];
                $this->Api_model->updateSingleRow("product_info", array('pro_pub_id'=>$data['pro_pub_id']), array("quantity"=>$quantity)); 
            }
            
			$this->Api_model->responseFailed(1, "Purchase info uploaded successfully.");
         }
         else
         {
			$this->Api_model->responseFailed(0, NOT_RESPONDING);
         }
	}

	public function getFillterData()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
		$this->form_validation->set_rules('menu_name','menu_name','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

       	$menu_name= $this->input->post('menu_name',TRUE);
        $getFillterData= $this->Api_model->getFillterData($menu_name);
        if($getFillterData)
        {
        	$this->Api_model->responseSuccess(1,"Get filter data.",$getFillterData);
        }
        else
        {
        	$this->Api_model->responseSuccessWithOutData(0,"No data found.");
        }
	}

	public function getSingleOrder()
	{
		$this->form_validation->set_rules('operator_pub_id','operator_pub_id','required');
		$this->form_validation->set_rules('invoice_pub_id','invoice_pub_id','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }

       	$invoice_pub_id= $this->input->post('invoice_pub_id',TRUE);
        $getOrderInfo= $this->Api_model->getOrderInfoV1($invoice_pub_id);
        if($getOrderInfo)
        {
        	$this->Api_model->responseSuccess(1,"Get my order.",$getOrderInfo);
        }
        else
        {
        	$this->Api_model->responseSuccessWithOutData(0,"No data found.");
        }
	}

	public function addPurchase()
	{
		$data['company'] = $this->input->post('company',TRUE);
		$purchase_date = $this->input->post('purchase_date',TRUE);
		$data['purchase_date'] = $purchase_date;
		$data['phone'] = $this->input->post('phone',TRUE);
		$data['company_id'] = $this->input->post('company_id',TRUE);
		$data['email'] = $this->input->post('email',TRUE);
		$data['sub_total'] = $this->input->post('sub_total',TRUE);
		$data['tax'] = $this->input->post('tax',TRUE);
		$data['final_price'] = $this->input->post('final_price',TRUE);
		$data['purechase_pub_id'] = $this->api->strongToken(12);
		$data['created_at'] = strtotime($purchase_date)*1000;
		$data['updated_at'] = strtotime($purchase_date)*1000;
		$image = $this->input->post('image',TRUE);

		$this->load->library('upload');

		$config['image_library'] = 'gd2';
		$config['upload_path']   = './assets/images/'; 
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']      = 10000; 
		$config['file_name']     = time();
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 250;
		$config['height'] = 250;
		$this->upload->initialize($config);
		$imageFile="";
		if ( $this->upload->do_upload('image') && $this->load->library('image_lib', $config))
		{         
		  $imageFile='assets/images/'.$this->upload->data('file_name');
		  $data['filePath']=$imageFile;
		}

		$getId=$this->Api_model->insertGetId('purechase_info',$data);
		if($getId)
         {
			$this->Api_model->responseFailed(1, "Purchase info uploaded successfully.");
         }
         else
         {
			$this->Api_model->responseFailed(0, NOT_RESPONDING);
         }
	}
	

/*Update Profile Api user can send all perameter for update. Update user record where user id. 
This api provided user data*/
	public function updateProfileUser()
	{
		$user_pub_id = $this->input->post('user_pub_id',TRUE);
		$name = $this->input->post('name',TRUE);
		$gender = $this->input->post('gender',TRUE);
		$mobile_no = $this->input->post('mobile_no',TRUE);
		$email = $this->input->post('email',TRUE);
		$address = $this->input->post('address',TRUE);
		$postcode = $this->input->post('postcode',TRUE);
		$lati = $this->input->post('lat',TRUE);
		$longi = $this->input->post('long',TRUE);
		$profile_pic = $this->input->post('profile_pic',TRUE);

		if ($user_pub_id!=''||$user_pub_id!=NULL) 
		{
			$table= 'user';       
        	$condition = array('user_pub_id'=>$user_pub_id);	
      	
            $check_user = $this->Api_model->getSingleRow($table, $condition);
            if ($check_user)
             {
             	 $this->load->library('upload');
      
                 $config['upload_path']   = './assets/images/'; 
                 $config['allowed_types'] = 'gif|jpg|jpeg|png';
                 $config['max_size']      = 10000; 
                 $config['file_name']     = time();
                 $this->upload->initialize($config);
                 $profileimage="";
                 if ( $this->upload->do_upload('profile_pic'))
                {
                  $profileimage='assets/images/'.$this->upload->data('file_name'); 
                }

    	        if($profileimage)
    	        {
    	        	$data['image']= $profileimage;
    	        }
             	$data['mobile_no'] = $mobile_no;
             	$data['name'] = $name;
    			$data['email'] = $email;
    			$data['address'] = $address;
    			$data['postcode'] = $postcode;
    			$data['latitude'] = $lati;
    			$data['longitude'] = $longi;
    			$data['created_at']= date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
    			
    			$this->Api_model->updateSingleRow($table, array('user_pub_id'=>$user_pub_id), $data);      
    			$check_user = $this->Api_model->getSingleRow($table, array('user_pub_id'=>$user_pub_id)); 
    			$check_user->profile_pic=$this->config->base_url().$check_user->image;     

    			$sms_msg="Hi $check_user->name <br><br>If you have any queries or suggestions, please don’t hesitate to write to us at samyotechindore@gmail.com or drop a text on 7869999639.";
    			

    			$this->Api_model->responseSuccess(1, UPDATE_PROFILE, $check_user);
    			$this->Api_model->send_email_info($email, WELCOME_MSG, $sms_msg);
             }
             else
             {
    			$this->Api_model->responseFailed(0, PROFILE_UPDATE_FAILED);
             }     
		}
		else
         {
			$this->Api_model->responseFailed(0, NOT_RESPONDING);
         } 		
	}

    function forgotPassword()
    {
        $this->form_validation->set_rules('email','Email','required');
        if($this->form_validation->run()==false) 
        {
            $this->Api_model->responseFailed(0,CHKFIELD);
            exit();
        }
		else
		{
			$this->data['userInfo'] = $this->Api_model->getSingleRow('user',array('email'=>$this->input->post('email')));
			if(count($this->data['userInfo'])>0)
			{
				$str = str_shuffle("wt@4545gddfg54");
				$formData= array(
				'password'=> md5($str)
				);

				$id = $this->Api_model->updateSingleRow('user',array('email'=>$this->input->post('email')),$formData);
				if($id)
				{
					$sms_msg = FORGETPASS.$str;
					$this->Api_model->responseSuccessWithOutData(1,RESETPASS);
					$this->Api_model->send_email_info($email, RESETPASS, $sms_msg);
				}
			}
			else
			{
				$this->Api_model->responseFailed(0,NOEMAIL);
			}
		}
	}

	public function changeOrderStatus()
	{
		$where["invoice_pub_id"] = $this->input->post('invoice_pub_id',TRUE);
		$data["invoice_status"] = $this->input->post('invoice_status',TRUE);

		$this->Api_model->updateSingleRow("invoice",$where,$data);
		if($data["invoice_status"]==1)
		{
			$this->Api_model->responseFailed(1,"Your order is on going. Please wait.");
		}
		elseif ($data["invoice_status"]==2) 
		{
			$this->Api_model->responseFailed(1,"Your order completed successfully.");
		}
		elseif ($data["invoice_status"]==4) 
		{
			$this->Api_model->responseFailed(1,"Your order canceled.");
		}
		else
		{
			$this->Api_model->responseFailed(0,"Please try again.");
		}
	}
	
	public function getAllMenu()
	{
		$operator_pub_id = $this->input->post('operator_pub_id',TRUE);
		$role = $this->input->post('role',TRUE);
		$cat_id = $this->input->post('cat_id',TRUE);

		if($role==1)
		{
			$menus=array();
			$menu=$this->Api_model->getAllDisableMenu($cat_id);
			foreach ($menu as $menu) 
			{
				$pro_count=$this->Api_model->getSingleRowCloumn("quantity","product_info",array("pro_pub_id"=>$menu->product_pub_id));
				$product_basket=$this->Api_model->getSingleRowCloumn("quantity","product_basket",array("operator_pub_id"=>$operator_pub_id,'menu_pub_id'=>$menu->menu_pub_id));
				if($pro_count)
				{
					$menu->pro_count=$pro_count->quantity;
				}
				else
				{
					$menu->pro_count="available";
				}

				if($product_basket)
				{
					$menu->quantity=$product_basket->quantity;
				}
				else
				{
					$menu->quantity=0;
				}
				array_push($menus, $menu);
			}
		}
		else
		{	
			$menus=array();
			$menu=$this->Api_model->getAllMenu();
			foreach ($menu as $menu) 
			{
				$pro_count=$this->Api_model->getSingleRowCloumn("quantity","product_info",array("pro_pub_id"=>$menu->product_pub_id));
				$product_basket=$this->Api_model->getSingleRowCloumn("quantity","product_basket",array("operator_pub_id"=>$operator_pub_id,'menu_pub_id'=>$menu->menu_pub_id));
				if($pro_count)
				{
					$menu->pro_count=$pro_count->quantity;
				}
				else
				{
					$menu->pro_count="available";
				}

				if($product_basket)
				{
					$menu->quantity=$product_basket->quantity;
				}
				else
				{
					$menu->quantity=0;
				}
				array_push($menus, $menu);
			}
		}
		if($menus) 
		{  
            $this->Api_model->responseSuccess(1,"Get all menus",$menus);
		}
		else
		{
			$this->Api_model->responseSuccessWithOutData(0,"No menu found.");
		} 
	}

	public function usage()
	{
		$data['company_id'] = $this->input->post('company_id',TRUE);
		$pro_pub_id = $this->input->post('pro_pub_id',TRUE);
		$quantity = $this->input->post('quantity',TRUE);
		$data['date'] = $this->input->post('date',TRUE);

		$product = $this->Api_model->getSingleRow('product_info',array('pro_pub_id'=>$pro_pub_id));
		if($product)
		{
			$data['quantity']=$quantity;
			$pro_quantity=$product->quantity - $quantity;
			$data['pro_pub_id']=$pro_pub_id;
			$data['created_at']=strtotime($data['date'])*1000;
			$getId=$this->Api_model->insertGetId('product_usage',$data);

			$this->Api_model->updateSingleRow('product_info',array('pro_pub_id'=>$pro_pub_id),array('quantity'=>$pro_quantity));
			$this->Api_model->responseFailed(1,"Product usage updated successfully.");
		}
		else
		{
			$this->Api_model->responseFailed(0,"No product found.");
		}
	}

	public function send_message()
	{
		$this->load->library('email'); 
         $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'samyotechindore@gmail.com',
            'smtp_pass' => 'samyo123',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );

        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $from_email = "samyotechindore@gmail.com"; 
        
        $this->email->from($from_email, "APP_NAME"); 
        $this->email->to("pnkjrko@gmail.com");
        $this->email->subject("test"); 

        $datas['msg']="test";
        $body = $this->load->view('main.php',$datas,TRUE);
        $this->email->message($body);

        $this->email->send();
        echo $this->email->print_debugger();
	}

	public function send_order()
	{
		$report_mail=$this->Api_model->getSingleRow('report_mail',array('id'=>1));
        $datas['invoice']=$this->Api_model->getDataBetweenDay('invoice');
        if($datas['invoice'])
        {
			$this->load->library('email'); 
	         $config = array(
	            'protocol'  => 'smtp',
	            'smtp_host' => 'ssl://smtp.googlemail.com',
	            'smtp_port' => 465,
	            'smtp_user' => 'samyotechindore@gmail.com',
	            'smtp_pass' => 'samyo123',
	            'mailtype'  => 'html',
	            'charset'   => 'iso-8859-1'
	        );

	        $this->email->initialize($config);
	        $this->email->set_mailtype("html");
	        $this->email->set_newline("\r\n");

	        $from_email = "samyotechindore@gmail.com"; 
	        
	        $this->email->from($from_email, "Orders Report"); 
	        $this->email->to($report_mail->email);
	        $this->email->subject("Orders Report"); 

	        $datas['msg']="Orders Report";
	        $body = $this->load->view('emails/orders.php',$datas,TRUE);
	        $this->email->message($body);

	        $this->email->send();
	    }
	}

	public function send_inventory()
	{
		$report_mail=$this->Api_model->getSingleRow('report_mail',array('id'=>1));
        $datas['inventory_info']=$this->Api_model->getDataBetweenDay('inventory_info');
        if($datas['inventory_info'])
        {
			$this->load->library('email'); 
	         $config = array(
	            'protocol'  => 'smtp',
	            'smtp_host' => 'ssl://smtp.googlemail.com',
	            'smtp_port' => 465,
	            'smtp_user' => 'samyotechindore@gmail.com',
	            'smtp_pass' => 'samyo123',
	            'mailtype'  => 'html',
	            'charset'   => 'iso-8859-1'
	        );

	        $this->email->initialize($config);
	        $this->email->set_mailtype("html");
	        $this->email->set_newline("\r\n");

	        $from_email = "samyotechindore@gmail.com"; 
	        
	        $this->email->from($from_email, "Inventory Report"); 
	        $this->email->to($report_mail->email);
	        $this->email->subject("Inventory Report"); 

	        $datas['msg']="Inventory Report";
	        $body = $this->load->view('emails/inventory_info.php',$datas,TRUE);
	        $this->email->message($body);

	        $this->email->send();
	    }
	}

	public function send_usage()
	{
		$report_mail=$this->Api_model->getSingleRow('report_mail',array('id'=>1));
        $datas['inventory_info']=$this->Api_model->getDataBetweenDay('usage');
        if($datas['inventory_info'])
        {
			$this->load->library('email'); 
	         $config = array(
	            'protocol'  => 'smtp',
	            'smtp_host' => 'ssl://smtp.googlemail.com',
	            'smtp_port' => 465,
	            'smtp_user' => 'samyotechindore@gmail.com',
	            'smtp_pass' => 'samyo123',
	            'mailtype'  => 'html',
	            'charset'   => 'iso-8859-1'
	        );

	        $this->email->initialize($config);
	        $this->email->set_mailtype("html");
	        $this->email->set_newline("\r\n");

	        $from_email = "samyotechindore@gmail.com"; 
	        
	        $this->email->from($from_email, "Usage Report"); 
	        $this->email->to($report_mail->email);
	        $this->email->subject("Usage Report"); 

	        $datas['msg']="Usage Report";
	        $body = $this->load->view('emails/usage.php',$datas,TRUE);
	        $this->email->message($body);
	        $this->email->send();
	    }
	}

	public function send_purchase()
	{
		$report_mail=$this->Api_model->getSingleRow('report_mail',array('id'=>1));
        $datas['purechase_info']= $this->Api_model->getDataBetweenDay('purechase_info');
        if($datas['purechase_info'])
        {
			$this->load->library('email'); 
	         $config = array(
	            'protocol'  => 'smtp',
	            'smtp_host' => 'ssl://smtp.googlemail.com',
	            'smtp_port' => 465,
	            'smtp_user' => 'samyotechindore@gmail.com',
	            'smtp_pass' => 'samyo123',
	            'mailtype'  => 'html',
	            'charset'   => 'iso-8859-1'
	        );

	        $this->email->initialize($config);
	        $this->email->set_mailtype("html");
	        $this->email->set_newline("\r\n");

	        $from_email = "samyotechindore@gmail.com"; 
	        
	        $this->email->from($from_email, "Purchase Report"); 
	        $this->email->to($report_mail->email);
	        $this->email->subject("Purchase Report"); 

	        $datas['msg']="Purchase Report";
	        $body = $this->load->view('emails/purechase_info.php',$datas,TRUE);
	        $this->email->message($body);

	        $this->email->send();
	    }
	}

	public function cronJob()
	{
		$this->send_purchase();
		$this->send_order();
		$this->send_usage();
		$this->send_inventory();
	}
	public function getOrder()
	{
        $invoice=$this->Api_model->getDataBetweenDay('invoice');
        print_r($invoice);
	}
}
?>