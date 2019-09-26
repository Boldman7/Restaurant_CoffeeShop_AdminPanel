<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Restaurant extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> library('session');
		$this -> load -> database();
		$this -> load -> library('form_validation');
		/*Added By Varun_Andro*/
		$this -> load-> library('image_lib');
		$this -> load -> model('Api_model');
		//Reminders Functions

        header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	}
 /*Added By Varun_Andro*/
 	public function index()
	{
		$this->load->view('signup.php');
	}

    public function addUser()
     {
        // $this->form_validation->set_rules('country_code', 'Country Code', 'required');
        // $this->form_validation->set_rules('mobile_no', 'Mobile no.', 'required');
        // $this->form_validation->set_rules('name ', 'Name', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        // $this->form_validation->set_rules('address', 'Address', 'required');
        // $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        // $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        // if ($this->form_validation->run() == FALSE)
        // {
        //     $errors = array_values($this->form_validation->error_array());
        //     //$this->response(["success" => false, "message" =>$errors[0]]);
        //     $this->Api_model->errResponse(0, $errors[0]);
        // }
        // else
        // {
        // $condition = array('country_code'=>$this->input->post('country_code'),'mobile_no'=>$this->input->post('mobile_no'),'country_code'=>$this->input->post('country_code1'),'mobile_no'=>$this->input->post('mobile_no1'));
        //$userData = $this->Api_model->getUsereRow('users',$condition);
        $userData = $this->Api_model->getUsereRow($this->input->post('mobile_no'),$this->input->post('mobile_no1'));
        if(empty($userData))
        {
          
        $data['user_pub_id']   = $this->getPubId();
        //$data['country_code']  = $this->input->post('country_code', TRUE);
        $data['mobile_no']     = $this->input->post('mobile_no', TRUE);
        $data['name']          = $this->input->post('name', TRUE);
        $data['email']         = $this->input->post('email', TRUE);
        $data['address']       = $this->input->post('address', TRUE);
        $data['latitude']      = $this->input->post('latitude', TRUE);
        $data['longitude']     = $this->input->post('longitude', TRUE);
        $data['created_at']    = time();
        $data['updated_at']    = time();
        $getId = $this->Api_model->insertGetId('users', $data);

        if($getId)
        {    
             $con = array('id'=>$getId); 
             $user = $this->Api_model->getsingleRow('users',$con);
             $this->Api_model->responseSuccess(1, USER_INFO, $user);
        }
        else
        {
            $this->Api_model->responseFailed(0, NOT_RESPONDING);
        }
      }
      else
      {
        $this->Api_model->responseSuccess(1, USER_INFO, $userData);
      }
    //}
        
     }


    /*Add to Cart*/
     public function addTocart()
     {
        
        $data['operator_pub_id'] =$this->input->post('operator_pub_id', TRUE);
        //$data['chef_pub_id'] =$this->input->post('chef_pub_id', TRUE);
        $data['user_pub_id'] =$this->input->post('user_pub_id', TRUE);
        $data['menu_pub_id'] =$this->input->post('menu_pub_id', TRUE);
        $data['quantity'] =$this->input->post('quantity', TRUE);
        $data['created_at']= time();
        $data['updated_at']= time();
        $getId = $this->Api_model->insertGetId('product_basket', $data);

        if($getId)
        {
            $this->Api_model->responseFailed(1, CART_UPDATE);
        }
        else
        {
            $this->Api_model->responseFailed(0, NOT_RESPONDING);
        }
        
        
     }
   
    /*Get My Cart*/
     public function getMyCart()
     {
        $user_pub_id= $this->input->post('user_pub_id', TRUE);
        //$chef_pub_id= $this->input->post('chef_pub_id', TRUE);
        $operator_pub_id= $this->input->post('operator_pub_id', TRUE);

        $staff = $this->Api_model->getSingleRow('staff',array('status'=>1,'staff_pub_id'=>$operator_pub_id));
        if($staff)
        {
        $get_cart= $this->Api_model->getAllDataWhere(array('user_pub_id'=>$user_pub_id,'operator_pub_id'=>$operator_pub_id), 'product_basket');

        if($get_cart)
        {
            $get_carts= array();
            foreach ($get_cart as $get_cart) 
            {   
                $menu_pub_id = $get_cart->menu_pub_id;
                $product = $this->Api_model->getSingleRow('menu', array('menu_pub_id'=>$menu_pub_id));
                $currency_setting= $this->Api_model->getSingleRow('currency_setting',array('status'=>1));
                
                $quantity= $get_cart->quantity;
                $price= $product->price;

                // $price_dicount=$price - ($price*$product->discount)/100;
                $get_cart->currency_type = $currency_setting->currency_symbol;
                $get_cart->menu_name=$product->menu_name;
                $get_cart->menu_desc=$product->menu_desc;
                $get_cart->price=$product->price;
                /*$get_cart->discount=$product->discount;
                $get_cart->price_dicount=$price_dicount;*/
                $get_cart->photo=$this->config->base_url().$product->photo;
                $get_cart->total_price= $price*$quantity;
                array_push($get_carts, $get_cart);
            }
            
            $this->Api_model->responseSuccess(1, GET_CART, $get_carts);

        }
        else
        {

            $this->Api_model->responseFailed(0, CART_EMPTY);
        }
      }
      else
      {
      $this->Api_model->responseFailed(3, ACCOUNT_STATUS);
      }
     }

     /*update Cart Quantity*/
     public function updateCartQuantity()
     {
        $menu_pub_id = $this->input->post('menu_pub_id',TRUE);
        $quantity = $this->input->post('quantity',TRUE);    
        $user_pub_id = $this->input->post('user_pub_id',TRUE);  
        $table= 'product_basket';       
        $condition = array('menu_pub_id'=>$menu_pub_id, 'user_pub_id'=> $user_pub_id);    
        
        $check_basket = $this->Api_model->updateSingleRow('product_basket', array('menu_pub_id'=>$menu_pub_id), array('quantity'=>$quantity));

        if ($check_basket)
        {
            $this->Api_model->responseFailed(1, CART_UPDATE);
        }
        else
        {
            $this->Api_model->responseFailed(0, NOT_RESPONDING);
        }
     }
    
    
 public function order()
     {
        $user_pub_id= $this->input->post('user_pub_id', TRUE);
        $chef_pub_id= $this->input->post('chef_pub_id', TRUE);
        $operator_pub_id= $this->input->post('operator_pub_id', TRUE);
        $order_type= $this->input->post('order_type', TRUE);
        $delivery_address= $this->input->post('delivery_address', TRUE);
        $latitude= $this->input->post('latitude', TRUE);
        $longitude= $this->input->post('longitude', TRUE);
        $tax= $this->input->post('tax', TRUE);
        $condition = array('operator_pub_id'=>$operator_pub_id);
        $get_cart= $this->Api_model->getAllDataWhere($condition, 'product_basket');
        if($get_cart)
        {
            $current_time= $this->getPubId();
            $get_carts= array();
            foreach ($get_cart as $get_cart) 
            {    
                $menu_pub_id=$get_cart->menu_pub_id;
                $product= $this->Api_model->getSingleRow('menu', array('menu_pub_id'=>$menu_pub_id));
                $quantity= $get_cart->quantity;
                $price = $product->price;


                //$price_discount= $price-($price*$product->discount/100);
                $data['menu_pub_id']=$menu_pub_id;
                $data['invoice_pub_id']=$current_time;
                //$data['user_pub_id']=$menu_pub_id;
                $data['quantity']=$quantity;
                $data['total_price']=$quantity*$price;
                $data['updated_at']=time();
                $data['created_at']=time();
                $this->Api_model->insertGetId('orders', $data);
            }

            $get_total_price=$this->Api_model->getSumWithWhere('total_price','orders',array('invoice_pub_id'=>$current_time));

          
              $finalP = $get_total_price->total_price*$tax/100;
              $finalPrice = $finalP+$get_total_price->total_price;
              $dataorder['invoice_pub_id']=$current_time;
              $dataorder['operator_pub_id']=$operator_pub_id;
              $dataorder['chef_pub_id']=$chef_pub_id;
              $dataorder['user_pub_id']=$user_pub_id;
              $dataorder['order_type']=$order_type;
              $dataorder['total_price']=round($get_total_price->total_price, 2); 
              $dataorder['final_price']= round($finalPrice, 2);  
              $dataorder['tax']= $tax;  
              $dataorder['delivery_address']= $delivery_address;  
              $dataorder['latitude']= $latitude;  
              $dataorder['longitude']= $longitude;  
              $dataorder['updated_at']=time();
              $dataorder['created_at']=time();
              $getID=$this->Api_model->insertGetId('invoice', $dataorder);

            if($getID)
            {   $getOrder = $this->Api_model->getSingleRow('invoice', array('id'=>$getID)); 
                $this->Api_model->deleteRecord($condition, 'product_basket');
                $this->Api_model->responseSuccess(1, MAKE_ORDER, $getOrder);
            }
            else
            {
                $this->Api_model->responseFailed(0, FAILED);    
            }
        }
        else
        {
            $this->Api_model->responseFailed(0, NO_PRODUCT);
        }
    }

     public function addPurchase()
     {
        $operator_pub_id= $this->input->post('operator_pub_id', TRUE);
        $com_name= $this->input->post('com_name', TRUE);
        $pur_date= $this->input->post('pur_date', TRUE);
        $email= $this->input->post('email', TRUE);
        $phone= $this->input->post('phone', TRUE);
        $sub_total_price= $this->input->post('sub_total_price', TRUE);
        $total_price= $this->input->post('total_price', TRUE);
        $tax= $this->input->post('tax', TRUE);
        $userStatus =  $this->Api_model->getSingleRow('staff', array('staff_pub_id'=>$operator_pub_id,'status'=>1)); 
        
        if($userStatus)
        {
       
          $data['purechase_pub_id']=$this->getPubId();
          $data['company']=$com_name;
          $data['purechase_date']=$pur_date;
          $data['email']=$email;
          $data['phone']=$phone;
          $data['sub_total']=$sub_total_price; 
          $data['final_price']=$total_price; 
          $data['tax']=$tax; 
          $data['updated_at']=time();
          $data['created_at']=time();

          $this->load->library('upload');
  
             $config['upload_path']   = './assets/purchase/'; 
             $config['allowed_types'] = 'gif|jpg|jpeg|png';
             $config['max_size']      = 10000; 
             $config['file_name']     = time();
             $this->upload->initialize($config);
             $profileimage="";
             if ( $this->upload->do_upload('image_path'))
             {
              $profileimage='assets/purchase/'.$this->upload->data('file_name'); 
             }
             else   
             {

             }

          if($profileimage)
          {
            $data['filePath']= $profileimage;
          }
         
          $getID=$this->Api_model->insertGetId('purechase_info', $data);
          if($getID)
            {  
               $this->Api_model->responseFailed(1, PUR_ADD);
            }
            else
            {
                $this->Api_model->responseFailed(0, FAILED);    
            }
        }
       else
      {
          $this->Api_model->responseFailed(3, ACCOUNT_STATUS);    
      }
    }

     public function editPurchase()
     {
        $purechase_pub_id= $this->input->post('purechase_pub_id', TRUE);
        $operator_pub_id= $this->input->post('operator_pub_id', TRUE);
        $com_name= $this->input->post('com_name', TRUE);
        $pur_date= $this->input->post('pur_date', TRUE);
        $email= $this->input->post('email', TRUE);
        $phone= $this->input->post('phone', TRUE);
        $sub_total_price= $this->input->post('sub_total_price', TRUE);
        $total_price= $this->input->post('total_price', TRUE);
        $tax= $this->input->post('tax', TRUE);
        $userStatus =  $this->Api_model->getSingleRow('staff', array('staff_pub_id'=>$operator_pub_id,'status'=>1)); 
        
        if($userStatus)
        {
       
          $data['company']=$com_name;
          $data['purechase_date']=$pur_date;
          $data['email']=$email;
          $data['phone']=$phone;
          $data['sub_total']=$sub_total_price; 
          $data['final_price']=$total_price; 
          $data['tax']=$tax; 
          $data['updated_at']=time();
          $data['created_at']=time();
          if($_FILES['id_proof']['name']!="")
             {
             $this->load->library('upload');
             $config['upload_path']   = './assets/purchase/'; 
             $config['allowed_types'] = 'gif|jpg|jpeg|png';
             $config['max_size']      = 10000; 
             $config['file_name']     = time();
             $this->upload->initialize($config);
             $profileimage="";
             if ( $this->upload->do_upload('image_path'))
             {
              $profileimage='assets/purchase/'.$this->upload->data('file_name'); 
             }
             else   
             {

             }

            if($profileimage)
            {
              $data['filePath']= $profileimage;
            }
           }
          $getID=$this->Api_model->updateSingleRow('purechase_info',array('purechase_pub_id'=>$purechase_pub_id), $data);
          if($getID)
            {  
               $this->Api_model->responseFailed(1, PUR_ADD);
            }
            else
            {
                $this->Api_model->responseFailed(0, FAILED);    
            }
        }
       else
      {
          $this->Api_model->responseFailed(3, ACCOUNT_STATUS);    
      }
    }

    
      public function getCategory()
      {
        $operator_pub_id = $this->input->post('operator_pub_id');
        $staff = $this->Api_model->getSingleRow('staff',array('status'=>1,'staff_pub_id'=>$operator_pub_id));
        if($staff)
        {
        $food_cat = $this->Api_model->getAllDataWhere(array('status'=>1),'food_cat');
        if($food_cat)
        { $foodData = array();
          foreach($food_cat as $food)
          {
            $food->cat_img =  $this->config->base_url().$food->cat_img;
            array_push($foodData,$food);
          }	
          $this->Api_model->responseSuccess(1, GET_CAT, $foodData);
        }
        else
        {
          $this->Api_model->responseFailed(0, NO_CAT);
        }
       }
       else
       {
           $this->Api_model->responseFailed(3, ACCOUNT_STATUS);
       }
      }

      public function getAllMenu()
      {
        $cat_id= $this->input->post('cat_id', TRUE);
        $operator_pub_id= $this->input->post('operator_pub_id', TRUE);
        $staff = $this->Api_model->getSingleRow('staff',array('status'=>1,'staff_pub_id'=>$operator_pub_id));
        if($staff)
        {
        if($cat_id)
        {
          $menulist = $this->Api_model->getAllDataWhere(array('status'=>1,'cat_id'=>$cat_id),'menu');
        }
        else
        {
        $menulist = $this->Api_model->getAllDataWhere(array('status'=>1),'menu');
        }
        if($menulist)
        { $menuData = array();
          foreach($menulist as $menu)
          {
            $menu->photo =  $this->config->base_url().$menu->photo;
            array_push($menuData,$menu);
          } 
          $this->Api_model->responseSuccess(1, GET_MENU, $menuData);
        }
        else
        {
          $this->Api_model->responseFailed(0, NO_MENU);
        }
      }
      else
      {
        $this->Api_model->responseFailed(3, ACCOUNT_STATUS);
      }
      }

      public function getPeddingOrder()
      {
        $operator_pub_id = $this->input->post('operator_pub_id');
        $user_pub_id = $this->input->post('user_pub_id');
        $invoicePendding = $this->Api_model->getAllDataWhere(array('invoice_status'=>1,'user_pub_id'=>$user_pub_id,'operator_pub_id'=>$operator_pub_id),'invoice');
        if($invoicePendding)
        { $invoiceData = array();
          foreach($invoicePendding as $invoice)
          {
            //$this->Api_model->getSingleRow('menu',array('menu_pub_id'=>));
            $menu->photo =  $this->config->base_url().$menu->photo;
            array_push($menuData,$menu);
          } 
          $this->Api_model->responseSuccess(1, GET_MENU, $menuData);
        }
        else
        {
          $this->Api_model->responseFailed(0, NO_MENU);
        }
      }

      public function getPubId()
      {
        return uniqid();
      }
      

}


?>