<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this ->load-> library('session');
        $this ->load-> helper('form');
        $this ->load-> helper('url');
        $this ->load-> database();
        $this ->load-> library('form_validation');
        $this ->load-> model('Comman_model');
        $this ->load-> model('Api_model');
        $this -> load->library('api');
    }

    public function index()
    {
        $this ->load->view('login.php');
    }  
    
    public function dashboard()
    {
        if(isset($_SESSION['name'])) 
        { 
            $data['page']='home';
            $data['total_user']=  $this->Api_model->count('users');
            $data['price']=  $this->Api_model->getSum('final_price','invoice');
            $data['purechase_info']=  $this->Api_model->getSum('final_price','purechase_info');
            $data['invoice']= $this->Api_model->getAllDataWhere(array('invoice_status'=>'3'),'invoice');
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this -> load ->view('dashboard.php',$data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
            redirect('Admin/login');
        }
    }
   
    public function user()
    {
        if(isset($_SESSION['name'])) 
        {   
            $user= $this->Api_model->getAllDataWhere(array('status'=>1),'users');
            $data['user']= $user;
            $data['page']='user';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php', $data);
            $this -> load ->view('user.php', $data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
             redirect('Admin/login');
        }
      }

       public function userOrderInfo()
    {
        if(isset($_SESSION['name'])) 
        {   

            $user_pub_id= $this->uri->segment('3');
            $invoice = $this->Api_model->getAllDataWhere(array('user_pub_id'=>$user_pub_id),'invoice');
            //$invoice = $this->Api_model->getorderInfo($user_pub_id);
            $data['invoice']= $invoice;
            $data['page']='userorderInfo';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php', $data);
            $this -> load ->view('userOrderInfo.php', $data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
             redirect('Admin/login');
        }
      }
    
       public function invoiceInfo()
    {
        if(isset($_SESSION['name'])) 
        {   

            $invoice_pub_id= $this->uri->segment('3');
            $orderData = $this->Api_model->getAllDataWhere(array('invoice_pub_id'=>$invoice_pub_id),'orders');
            $data['orderData']= $orderData;
            $data['page']='userorderInfo';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php', $data);
            $this -> load ->view('InvoiceInfo.php', $data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
             redirect('Admin/login');
        }
      }
    
   public function allOrder()
    {
        if(isset($_SESSION['name'])) 
        {   
            $date_fillter  = $this->input->post('date_fillter');
            $date_fillter1 = $this->input->post('date1_fillter');
            $operator_pub_id = $this->input->post('operator_pub_id');
            $chef_pub_id = $this->input->post('chef_pub_id');
            $order_type = $this->input->post('order_type');
            $date  = strtotime($date_fillter)*1000;
            $date1  = strtotime($date_fillter1)*1000;

            if($date !="" && $date1 !="")
            { 

              $data['date_fillter1']=$date_fillter1;
              $data['date_fillter']=$date_fillter;

              if(isset($operator_pub_id) || is_numeric($order_type) || isset($chef_pub_id))
              {
                if($operator_pub_id !=0)
                {
                  $data['operator_pub_id']=$operator_pub_id;
                  $where['operator_pub_id']=$operator_pub_id;
                }

                if($chef_pub_id !=0)
                {
                  $data['chef_pub_id']=$chef_pub_id;
                  $where['chef_pub_id']=$chef_pub_id;
                }

                if(is_numeric($order_type))
                {
                  $data['order_type']=$order_type;
                  $where['order_type']=$order_type;
                }

                if(empty($where))
                {
                   $invoice= $this->Api_model->getDataBetween('invoice',$date,$date1);
                }
                else
                {
                  $invoice= $this->Api_model->getInvoiceWhere('invoice',$where,$date,$date1);
                }
                
              }
              else
              {
                $invoice= $this->Api_model->getDataBetween('invoice',$date,$date1);
              }
            }
            else
            {
                $invoice= $this->Api_model->getAllData('invoice');
            }
            $data['invoice']= array_reverse($invoice);
            $data['staff']= $this->Api_model->getAllDataWhere(array('role'=>1),'staff');
            $data['chef']= $this->Api_model->getAllDataWhere(array('role'=>2),'staff');
            $data['page']='Order information';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php', $data);
            $this -> load ->view('orders', $data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
             redirect('Admin/login');
        }
      }

      public function deletedOrder()
    {
        if(isset($_SESSION['name'])) 
        {   
            $date_fillter  = $this->input->post('date_fillter');
            $date_fillter1 = $this->input->post('date1_fillter');
            $operator_pub_id = $this->input->post('operator_pub_id');
            $chef_pub_id = $this->input->post('chef_pub_id');
            $order_type = $this->input->post('order_type');
            $date  = strtotime($date_fillter)*1000;
            $date1  = strtotime($date_fillter1)*1000;

            if($date !="" && $date1 !="")
            { 

              $data['date_fillter1']=$date_fillter1;
              $data['date_fillter']=$date_fillter;

              if(isset($operator_pub_id) || is_numeric($order_type) || isset($chef_pub_id))
              {
                if($operator_pub_id !=0)
                {
                  $data['operator_pub_id']=$operator_pub_id;
                  $where['operator_pub_id']=$operator_pub_id;
                }

                if($chef_pub_id !=0)
                {
                  $data['chef_pub_id']=$chef_pub_id;
                  $where['chef_pub_id']=$chef_pub_id;
                }

                if(is_numeric($order_type))
                {
                  $data['order_type']=$order_type;
                  $where['order_type']=$order_type;
                }

                if(empty($where))
                {
                   $invoice= $this->Api_model->getDataBetween('deleted_invoice',$date,$date1);
                }
                else
                {
                  $invoice= $this->Api_model->getInvoiceWhere('deleted_invoice',$where,$date,$date1);
                }
                
              }
              else
              {
                $invoice= $this->Api_model->getDataBetween('deleted_invoice',$date,$date1);
              }
            }
            else
            {
                $invoice= $this->Api_model->getAllData('deleted_invoice');
            }
            $data['invoice']= array_reverse($invoice);
            $data['staff']= $this->Api_model->getAllDataWhere(array('role'=>1),'staff');
            $data['chef']= $this->Api_model->getAllDataWhere(array('role'=>2),'staff');
            $data['page']='Order information';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php', $data);
            $this -> load ->view('deletedOrder', $data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
             redirect('Admin/login');
        }
      }

       public function allInventory()
       {
            if(isset($_SESSION['name'])) 
            {   
                $date_fillter  = $this->input->post('date_fillter');
                $pro_pub_id  = $this->input->post('pro_pub_id');
                $date_fillter1 = $this->input->post('date1_fillter');
                $date  = strtotime($date_fillter)*1000;
                $date1  = strtotime($date_fillter1)*1000;

                if($date !="" && $date1 !="")
                {
                     $data['date_fillter1']=$date_fillter1;
                     $data['date_fillter']=$date_fillter;
                    if($pro_pub_id)
                    {
                      $data['pro_pub_id']=$pro_pub_id;
                      $inventory_info= $this->Api_model->getDataBetweenItem('inventory_info',$pro_pub_id,$date,$date1);
                    }
                    else
                    {
                      $inventory_info= $this->Api_model->getDataBetween('inventory_info',$date,$date1);
                    }
                }
                else
                {
                    $inventory_info= $this->Api_model->getAllData('inventory_info');
                }

                $data['company']= $this->Api_model->getAllData('company');
                $data['supplier']=$this->Api_model->getAllData('supplier_info');
                $data['product_info']=$this->Api_model->getAllData('product_info');
                $data['allProducts']=$this->Api_model->getAllData('product_info');
                $data['measurement_info']=$this->Api_model->getAllData('measurement_info');
                $data['inventory_info']= array_reverse($inventory_info);
                $data['page']='bid information';
                $this -> load -> view('common/head.php');
                $this -> load -> view('common/sidebar.php', $data);
                $this -> load ->view('inventory', $data);
                $this -> load -> view('common/footer.php');
            }
            else
            {
                 redirect('Admin/login');
            }
      }

    public function addUsage()
    {
        if(isset($_SESSION['name'])) 
        {   
            $date  = $this->input->post('date_fillter');
            $date1 = $this->input->post('date1_fillter');
            $date  = strtotime($date)*1000;
            $date1  = strtotime($date1)*1000;

            if($date !="" && $date1 !="")
            {
               $usage= $this->Api_model->getDataBetween('product_usage',$date,$date1);
            }
            else
            {
              $usage= $this->Api_model->getAllData('product_usage');
            }

            $data['company']= $this->Api_model->getAllData('company');
            $data['supplier']=$this->Api_model->getAllData('supplier_info');
            $data['product_info']=$this->Api_model->getAllData('product_info');
            $data['measurement_info']=$this->Api_model->getAllData('measurement_info');
            $data['inventory_info']= $usage;
            $data['page']='bid information';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php', $data);
            $this -> load ->view('AddUsage', $data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
             redirect('Admin/login');
        }
    }

    function add_inventory() 
    {
       if(isset($_SESSION['name'])) 
        {
        	$product_pub_id= $this->input->post('product_name');
        	$quantity=$this->input->post('quantity');

    		     $data['inv_pub_id']   =   $this->getPubId();
             $data['sup_pub_id'] = $this->input->post('supplier_name');
             $data['company_id'] = $this->input->post('company_name');
             $data['inv_date'] = $this->input->post('date');
             $data['measurement'] = $this->input->post('measurement');
             $data['pro_pub_id'] = $this->input->post('product_name');
             $data['quantity'] = $this->input->post('quantity');
             $data['created_at'] =  strtotime($data['inv_date'])*1000;
             $data['updated_at'] = time();
             
             $product = $this->Api_model->getSingleRow('product_info',array('pro_pub_id'=>$data['pro_pub_id']));

             $pro_quantity=$product->quantity + $data['quantity'];
             $this->Api_model->updateSingleRow('product_info',array('pro_pub_id'=>$data['pro_pub_id']),array('quantity'=>$pro_quantity));

             $this->Api_model->insert('inventory_info', $data);
             redirect('Admin/allInventory');
         }
        else
        {
          redirect('Admin/login');
        }
    }

    function addUsageAction() 
    {
       if(isset($_SESSION['name'])) 
        {
            $product_pub_id= $this->input->post('product_name');
            $quantity=$this->input->post('quantity');
            
             $data['company_id'] = $this->input->post('company_name');
             $data['date'] = $this->input->post('date');
             $data['pro_pub_id'] = $this->input->post('product_name');
             $data['quantity'] = $this->input->post('quantity');
             $data['created_at'] = strtotime($data['date'])*1000;
                
            $product = $this->Api_model->getSingleRow('product_info',array('pro_pub_id'=>$data['pro_pub_id']));

             $pro_quantity=$product->quantity - $data['quantity'];
             $this->Api_model->updateSingleRow('product_info',array('pro_pub_id'=>$data['pro_pub_id']),array('quantity'=>$pro_quantity));

             $this->Api_model->insert('product_usage', $data);
             redirect('Admin/addUsage');
         }
        else
        {
          redirect('Admin/login');
        }
    }

       public function allpurechase()
       {
        if(isset($_SESSION['name'])) 
        {   
            $date  = $this->input->post('date_fillter');
            $date1 = $this->input->post('date1_fillter');
            $date  = strtotime($date)*1000;
            $date1  = strtotime($date1)*1000;

            if($date !="" && $date1 !="")
            {
                $purechase_info= $this->Api_model->getDataBetween('purechase_info',$date,$date1);
            }
            else
            {
                $purechase_info= $this->Api_model->getAllData('purechase_info');
            }

            $data['purechase_info'] =array_reverse($purechase_info);
            $data['company']= $this->Api_model->getAllData('company');
            $data['page']='purechase information';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php', $data);
            $this -> load ->view('purechase', $data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
             redirect('Admin/login');
        }
      }

     public  function addStaff()
     {
        if(isset($_SESSION['name'])) 
        {   
            $data['page']='Add Staff';
            $data['staff']= $this->Api_model->getAllData('staff');
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php', $data);
            $this -> load ->view('addStaff', $data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
             redirect('Admin/login');
        }
     }

     
        public function editStaff()
        {
             $staff_id=$this->uri->segment(3);
             $data['staff']= $this->Api_model->getSingleRow('staff', array('id'=>$staff_id));
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this -> load -> view('editStaff.php',$data);
            $this -> load -> view('common/footer.php');
        }


         public function editUser()
          {
             $user_id=$this->uri->segment(3);
             $data['users']= $this->Api_model->getSingleRow('users', array('id'=>$user_id));
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this -> load -> view('editUser.php',$data);
            $this -> load -> view('common/footer.php');
         }

        function editUserAction() {
       if(isset($_SESSION['name'])) 
         {  
            $user_id = $this->input->post('user_id');
             $data['users']= $this->Api_model->getSingleRow('users', array('id'=>$user_id));
             if($data['users']->mobile_no==$this->input->post('phone', TRUE))
                {
                    $this->form_validation->set_rules('phone', 'Phone', 'required');
                }
                else
                {
                $this->form_validation->set_rules('phone', 'Phone', 'required|is_unique[users.mobile_no]');
                }
               
            if ($this->form_validation->run() == FALSE)
            {

            $data['page']='User';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php',$data);
            $this -> load -> view('editUser', $data);
            $this -> load -> view('common/footer.php');
              }
              else
              {

            /*get values of input box from addbreed form*/ 
            
            
            $data1['name']           =   $this->input->post('name');
            $data1['area']          =   $this->input->post('area');
            $data1['building_no']        =   $this->input->post('building_no');
            $data1['floor_no']      =   $this->input->post('floor_no');
            $data1['flat_no']      =   $this->input->post('flat_no');
            $data1['city']      =   $this->input->post('city');
            $data1['mobile_no']      =   $this->input->post('phone');
            $data1['updated_at']     =   time();
            
            $this->Api_model->updateSingleRow('users',array('id'=>$user_id), $data1);
            redirect('Admin/user');
          }

        }
      
        else
            {
             redirect('Admin/login');
            }

      }
     
     
      function addStaffAction() {
       if(isset($_SESSION['name'])) 
         {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[staff.user_name]');
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[staff.email]');
            $this->form_validation->set_rules('password', 'Password', 'required'); 
            $this->form_validation->set_rules('country_code', 'Country code', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required');
            $this->form_validation->set_rules('address', 'address', 'required');
            $this->form_validation->set_rules('latitude', 'Longitude', 'required');
            $this->form_validation->set_rules('longitude', 'Longitude', 'required');
            $this->form_validation->set_rules('role', 'role', 'required');
            if ($this->form_validation->run() == FALSE)
            {

            $data['page']='Staff';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php',$data);
            $this -> load -> view('addStaff', $data);
            $this -> load -> view('common/footer.php');
              }
              else
              {

            /*get values of input box from addbreed form*/ 
            
            $data['staff_pub_id']   =   $this->getPubId();
            $data['name']           =   $this->input->post('name');
            $data['user_name']      =   $this->input->post('username');
            $data['email']          =   $this->input->post('email');
            $data['password']       =   md5($this->input->post('password'));
            $data['country_code']      =   $this->input->post('country_code');
            $data['mobile_no']      =   $this->input->post('mobile');
            $data['address']        =   $this->input->post('address');
            $data['role']           =   $this->input->post('role');
            $data['created_at']     =   time();
            $data['updated_at']     =   time();
            
            $config['upload_path']  =   './assets/images/photos/'; 
            $config['allowed_types']=   'gif|jpg|jpeg|png';
            $config['max_size']     =   10000; 
            $config['file_name']    =   time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $id_proof="";
          
            if($this->upload->do_upload('id_proof'))
            {
            
            $id_proof='assets/images/photos/'.$this->upload->data('file_name'); 

            }
            $data['id_photo'] = $id_proof;

            $config['upload_path']   =   './assets/images/photos/'; 
            $config['allowed_types'] =   'gif|jpg|jpeg|png';
            $config['max_size']      =   10000; 
            $config['file_name']     =   time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $profileImage="";
          
            if($this->upload->do_upload('image_path'))
            {
            
            $profileImage='assets/images/photos/'.$this->upload->data('file_name'); 

            }
            $data['profile_image'] = $profileImage;
            $this->Api_model->insertGetId('staff',$data);
            redirect('Admin/addStaff');
          }

        }
      
        else
            {
             redirect('Admin/login');
            }

      }
      
      function editStaffAction() {
       if(isset($_SESSION['name'])) 
         {  
            $staff_id = $this->input->post('staff_id');
            $this->form_validation->set_rules('country_code', 'Country code', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required');
            $this->form_validation->set_rules('address', 'address', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            /*get values of input box from addbreed form*/ 
            $data['name']           =   $this->input->post('name');
            $data['user_name']      =   $this->input->post('username');
            $data['email']          =   $this->input->post('email');
            $data['password']       =    md5($this->input->post('password'));
            $data['country_code']   =   $this->input->post('country_code');
            $data['mobile_no']      =   $this->input->post('mobile');
            $data['address']        =   $this->input->post('address');
            $data['created_at']     =   time();
            $data['updated_at']     =   time();
            if($_FILES['id_proof']['name']!="")
            {
                $config['upload_path']  =   './assets/images/photos/'; 
                $config['allowed_types']=   'gif|jpg|jpeg|png';
                $config['max_size']     =   10000; 
                $config['file_name']    =   time();
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $id_proof="";
                if($this->upload->do_upload('id_proof'))
                {
                    $id_proof='assets/images/photos/'.$this->upload->data('file_name'); 
                }
                $data['id_photo'] = $id_proof;
            }
            if($_FILES['image_path']['name']!="")
            {
                $config['upload_path']   =   './assets/images/photos/'; 
                $config['allowed_types'] =   'gif|jpg|jpeg|png';
                $config['max_size']      =   10000; 
                $config['file_name']     =   time();
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $profileImage="";
              
                if($this->upload->do_upload('image_path'))
                {
                
                $profileImage='assets/images/photos/'.$this->upload->data('file_name'); 

                }
                $data['profile_image'] = $profileImage;
            }
            $this->Api_model->updateSingleRow('staff',array('id'=>$staff_id), $data);
            redirect('Admin/addStaff');
          }
        else
        {
         redirect('Admin/login');
        }

      }

     public function change_staff_status()
    {
        $id= $_GET['id'];
        $status= $_GET['status'];
        $where = array('id'=>$id);
        $data = array('status'=>$status);

        $update= $this->Api_model->updateSingleRow('staff', $where, $data);

          //if($update){
          redirect('Admin/addStaff');
       // }        
    }

     public function addCategory(){
     if(isset($_SESSION['name'])) 
        {   

    {   $data['get_company']=$this->Api_model->getAllData('food_cat');

        $this -> load -> view('common/head.php');
        $this -> load -> view('common/sidebar.php');
        $this->load ->view('addCategory',$data);
        $this -> load -> view('common/footer.php');
    }
   }
    else
        {
             redirect('Admin/login');
        }
    }
    

      function add_Food() {
       if(isset($_SESSION['name'])) 
         {
         $data1['get_company']=$this->Api_model->getAllData('food_cat');
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required|is_unique[food_cat.cat_name]');
            if ($this->form_validation->run() == FALSE)
            {
            $data['page']='Add Company';
            
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php',$data);
            $this -> load -> view('addCategory.php', $data1);
            $this -> load -> view('common/footer.php');
             }
              else
              {

            $data['cat_name']         =   $this->input->post('cat_name');
            $data['cat_desc']         =   $this->input->post('desc');
            $data['created_at']       =   time();
            $data['updated_at']       =   time();
            $config['upload_path']    =   './assets/images/category/'; 
            $config['allowed_types']  =   'gif|jpg|jpeg|png';
            $config['max_size']       =   10000; 
            $config['file_name']      =   time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $productsimage="";
            if ( $this->upload->do_upload('img_path'))
            {
             
            $productsimage='assets/images/category/'.$this->upload->data('file_name'); 
            $data['cat_img'] =$productsimage;
            }
            else   
            {
                echo "image is not inserted";
            }

            $this->Api_model->insert('food_cat', $data);
            redirect('Admin/addCategory');

            }

          }
            else
            {
            redirect('Admin/login');
            }
        }
    

    function update_cat() 
    {
        if(isset($_SESSION['name'])) 
        {
            $where['id']         =   $this->input->post('cat_id');
            $data['cat_name']         =   $this->input->post('cat_name');
            $data['cat_desc']         =   $this->input->post('desc');
            $data['updated_at']       =   time();
            $config['upload_path']    =   './assets/images/category/'; 
            $config['allowed_types']  =   'gif|jpg|jpeg|png';
            $config['max_size']       =   10000; 
            $config['file_name']      =   time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $productsimage="";
            if ( $this->upload->do_upload('img_path'))
            {
             
            $productsimage='assets/images/category/'.$this->upload->data('file_name'); 
            $data['cat_img'] =$productsimage;
            }

            $this->Api_model->updateSingleRow('food_cat', $where, $data);
            redirect('Admin/addCategory');
        }
        else
        {
        redirect('Admin/login');
        }
    }


        public function editFood(){
             $cat_id=$this->uri->segment(3);
             $data['food_cat']= $this->Api_model->getSingleRow('food_cat', array('id'=>$cat_id));
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this -> load -> view('update_cat.php',$data);
            $this -> load -> view('common/footer.php');
        }

         public function editPurchase(){
             $purechase_pub_id=$this->uri->segment(3);
             $data['purechase_info']= $this->Api_model->getSingleRow('purechase_info', array('purechase_pub_id'=>$purechase_pub_id));
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this -> load -> view('editPurchase.php',$data);
            $this -> load -> view('common/footer.php');
      }

       public function editInventory(){
             $inv_pub_id=$this->uri->segment(3);
             $data['product']=$this->Api_model->getAllDataWhere(array('status'=>1),'product_info');
             $data['measurement']=$this->Api_model->getAllDataWhere(array('status'=>1),'measurement_info');
             $data['supplier']=$this->Api_model->getAllDataWhere(array('status'=>1),'supplier_info');
             $data['inventory_info']= $this->Api_model->getSingleRow('inventory_info', array('inv_pub_id'=>$inv_pub_id));
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this -> load -> view('editInventory.php',$data);
            $this -> load -> view('common/footer.php');
      }

        public function update_inventory()
          {
           if(isset($_SESSION['name'])) 
        {
         $inv_pub_id=$this->input->post('inv_pub_id');
         $data['sup_pub_id'] = $this->input->post('sup_pub_id');
         $data['inv_date'] = $this->input->post('inv_date');
         $data['measurement'] = $this->input->post('measurement');
         $data['pro_pub_id'] = $this->input->post('pro_pub_id');
         $data['quantity'] = $this->input->post('quantity');
         $data['updated_at'] = time();
         $where = array('inv_pub_id'=>$inv_pub_id);
         $this->Api_model->updateSingleRow('inventory_info', $where, $data);
         redirect('Admin/allInventory');
        

     }
        else{

          redirect('Admin/login');
        }
 }
   
    public function update_purchase()
          {
           if(isset($_SESSION['name'])) 
        {
         $purechase_pub_id=$this->input->post('purechase_pub_id');
         $data['company'] = $this->input->post('company');
         $data['purchase_date'] = $this->input->post('purechase_date');
         $data['email'] = $this->input->post('email');
         $data['phone'] = $this->input->post('phone');
         $data['sub_total'] = $this->input->post('sub_total');
         $data['tax'] = $this->input->post('tax');
         $data['final_price'] = $this->input->post('final_price');
         $data['updated_at'] = time();
         $productsimage="";
          if ($_FILES['img_path']['name']!="")
            { 
             $config['upload_path']   = './assets/purchase/'; 
             $config['allowed_types'] = 'gif|jpg|jpeg|png';
             $config['max_size']      = 10000; 
             $config['file_name']     = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $productsimage = "";
             if ( $this->upload->do_upload('img_path'))
             {
             
            $productsimage='assets/purchase/'.$this->upload->data('file_name'); 
            $data['filePath'] =$productsimage;
             }
             else   
             {
                echo "image is not inserted";
             }
           }
           $where = array('purechase_pub_id'=>$purechase_pub_id);
            $this->Api_model->updateSingleRow('purechase_info', $where, $data);
            redirect('Admin/allpurechase');
        

     }
        else{

          redirect('Admin/login');
        }
 }

 public function change_cat_status()
    {
        $id= $_GET['id'];
        $status= $_GET['status'];
        $where = array('id'=>$id);
        $data = array('status'=>$status);

        $update= $this->Api_model->updateSingleRow('food_cat', $where, $data);

          if($update){
          redirect('Admin/addCategory');
        }        
    }

     public function change_menu_status()
    {
        $id= $_GET['id'];
        $status= $_GET['status'];
        $where = array('id'=>$id);
        $data = array('status'=>$status);

        $update= $this->Api_model->updateSingleRow('menu', $where, $data);

          if($update){
          redirect('Admin/addMenu');
        }        
    }
    
    
     public function change_product_status()
    {
        $id= $_GET['id'];
        $status= $_GET['status'];
        $where = array('id'=>$id);
        $data = array('status'=>$status);

        $update= $this->Api_model->updateSingleRow('product_info', $where, $data);

          if($update){
          redirect('Admin/addProduct');
        }        
    }

      public function change_measurement_status()
    {
        $id= $_GET['id'];
        $status= $_GET['status'];
        $where = array('id'=>$id);
        $data = array('status'=>$status);

        $update= $this->Api_model->updateSingleRow('measurement_info', $where, $data);

          if($update){
          redirect('Admin/addMeasurement');
        }        
    }

     public function addMenu(){
     if(isset($_SESSION['name'])) 
        {   

       {   
        $data['menu']=$this->Api_model->getAllData('menu');
        $data['cat']=$this->Api_model->getAllDataWhere(array('status'=>1),'food_cat');
        //Aditional Data Code MTY
         $data['company']= $this->Api_model->getAllDataWhere(array('status'=>1),'company');
         $data['supplier']=$this->Api_model->getAllData('supplier_info');
         $data['product_info']=$this->Api_model->getAllData('product_info');
         $data['measurement_info']=$this->Api_model->getAllData('measurement_info');

        $this -> load -> view('common/head.php');
        $this -> load -> view('common/sidebar.php');
        $this->load ->view('addMenu',$data);
        $this -> load -> view('common/footer.php');
    }
   }
    else
        {
             redirect('Admin/login');
        }
    }
   
       function add_menu() {
       if(isset($_SESSION['name'])) 
         {
            
         $data1['menu']=$this->Api_model->getAllData('menu');
        $data1['cat']=$this->Api_model->getAllDataWhere(array('status'=>1),'food_cat');
         $data1['currency']= $this->Api_model->getSingleRow('currency_setting', array('status'=>1));
        $this->form_validation->set_rules('menu_name', 'Menu Name', 'required|is_unique[food_cat.cat_name]');
            if ($this->form_validation->run() == FALSE)
            {
            $data['page']='Add Menu';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php',$data);
            $this -> load -> view('addMenu', $data1);
            $this -> load -> view('common/footer.php');
             }
              else
              {
            $company_id       =   $this->input->post('company_name');
            $product_pub_id   =   $this->input->post('product_name');
            $meas_pub_id      =   $this->input->post('measurement');
            $is_countable     =   $this->input->post('chkProduct');
              if(isset($_POST['chkProduct'])) { $is_countable='true'; } else { $is_countable='false'; }
            $data['menu_pub_id']      =   $this->api->random_string('numeric',4);
            $data['cat_id']           =   $this->input->post('cat_id');
            $data['company_id']       =   isset($company_id) ? $company_id:'';
            $data['product_pub_id']   =   isset($product_pub_id) ? $product_pub_id:'';
            $data['meas_pub_id']      =   isset($meas_pub_id) ? $meas_pub_id:'';
            $data['is_countable']      =  $is_countable;  
            $data['menu_name']        =   $this->input->post('menu_name');
            $data['price']            =   $this->input->post('price');
            $data['menu_desc']        =   $this->input->post('desc');
            $data['created_at']       =   time();
            $data['updated_at']       =   time();

            $config['upload_path']    =   './assets/images/menu/'; 
            $config['allowed_types']  =   'gif|jpg|jpeg|png';
            $config['max_size']       =   10000; 
            $config['file_name']      =   time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $productsimage="";
            if ($this->upload->do_upload('img_path'))
            {
             
            $productsimage='assets/images/menu/'.$this->upload->data('file_name'); 
            $data['photo'] =$productsimage;
            }
           
            $this->Api_model->insert('menu', $data);
            redirect('Admin/addMenu');

            }

          }
            else
            {
            redirect('Admin/login');
            }
        }


        public function editMenu()
        {
            $menu_id=$this->uri->segment(3);
            $data['cat']=$this->Api_model->getAllDataWhere(array('status'=>1),'food_cat');
            $data['company']= $this->Api_model->getAllDataWhere(array('status'=>1),'company');
            $data['supplier']=$this->Api_model->getAllData('supplier_info');
            $data['product_info']=$this->Api_model->getAllData('product_info');
            $data['measurement_info']=$this->Api_model->getAllData('measurement_info');

            $data['menudata']= $this->Api_model->getSingleRow('menu', array('id'=>$menu_id));
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this -> load -> view('editMenu',$data);
            $this -> load -> view('common/footer.php');
        }
   

        public function update_menu()
          {
           if(isset($_SESSION['name'])) 
        {   $data1['currency']= $this->Api_model->getSingleRow('currency_setting', array('status'=>1));
            $menu_id                  =   $this->input->post('menu_id');
            $data['menu_name']        =   $this->input->post('menu_name');
            $data['cat_id']           =   $this->input->post('cat_id');
            $data['price']            =   $this->input->post('price');
            $data['menu_desc']        =   $this->input->post('desc');
            $data['updated_at']       =   time();
            $productsimage="";
             if(isset($_POST['chkProduct'])) { $is_countable='true'; } else { $is_countable='false'; }
             if($is_countable=="false")
             {
                $data['company_id']       =   '';
                $data['product_pub_id']   =   '';
                $data['meas_pub_id']      =  '';
             }
             else
             {

                $data['company_id']       =   $this->input->post('company_id');
                $data['product_pub_id']   =   $this->input->post('product_pub_id');
                $data['meas_pub_id']      =   $this->input->post('meas_pub_id');
             }

             $data['is_countable']=$is_countable;
            if($_FILES['img_path']['name']!="")
            { 
             $config['upload_path']   = './assets/images/menu/'; 
             $config['allowed_types'] = 'gif|jpg|jpeg|png';
             $config['max_size']      = 10000; 
             $config['file_name']     = time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $productsimage = "";
             if ( $this->upload->do_upload('img_path'))
             {
             
            $productsimage='assets/images/menu/'.$this->upload->data('file_name'); 
            $data['photo'] =$productsimage;
             }
           }
           $where = array('id'=>$menu_id);
           $this->Api_model->updateSingleRow('menu', $where, $data);
            redirect('Admin/addMenu');
         }
        else
        {
          redirect('Admin/login');
        }
 }

    public function addProduct()
    {
     if(isset($_SESSION['name'])) 
        {  

            $data['product_info']=$this->Api_model->getAllData('product_info');
            $data['measurement']=$this->Api_model->getAllDataWhere(array('status'=>1),'measurement_info');
            $data['company']=$this->Api_model->getAllData('company');
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this->load ->view('addProduct',$data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
             redirect('Admin/login');
        }
    }

    public function addCompany()
    {
        if(isset($_SESSION['name'])) 
        {  
            $data['company']=$this->Api_model->getAllData('company');
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this->load ->view('addComapny',$data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
             redirect('Admin/login');
        }
    }
    public function getProductByCompanyId($company_id)
    {
     $company=$this->Api_model->getAllDataWhere(array('status'=>1,'company_id'=>$company_id),'product_info');
     if(count($company)>0)
     {
      echo '<option value="">Please Select Product</option>';
      foreach ($company as  $data) {
      echo '<option value='.$data->pro_pub_id.'>'.$data->pro_name.'</option>';
    }
     }
     else
     {
      echo '<option value="">No Product Found</option>';
     }
    }
    function add_company() 
    {
       if(isset($_SESSION['name'])) 
        {
            $data['com_name']         =   $this->input->post('com_name');
            $data['email']         =   $this->input->post('email');
            $data['phone_no']      =   $this->input->post('phone_no');
            $data['created_at']       =   time();
            $data['updated_at']       =   time();
            $this->Api_model->insert('company', $data);
            redirect('Admin/addCompany');
        }
        else
        {
            redirect('Admin/login');
        }
    }

    function add_purchase() 
    {
       if(isset($_SESSION['name'])) 
        {   
            $data['purechase_pub_id']   =   $this->getPubId();
            $data['company']         =   $this->input->post('company_name');
            $data['email']         =   $this->input->post('email');
            $data['phone']      =   $this->input->post('phone_no');
            $data['sub_total']  = $this->input->post('Sub_total');
            $data['tax']  = $this->input->post('tax');
            $data['final_price']  = $this->input->post('total_price');
            $data['purchase_date'] = $this->input->post('date');
            $data['created_at']       =   time();
            $data['updated_at']       =   time();

            $config['upload_path']    =   './assets/images/'; 
            $config['allowed_types']  =   'gif|jpg|jpeg|png';
            $config['max_size']       =   10000; 
            $config['file_name']      =   time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $Purchaseimage="";
            if ($this->upload->do_upload('img_path'))
            {
             
            $Purchaseimage='assets/images/'.$this->upload->data('file_name'); 
            $data['filePath'] =$Purchaseimage;
            }

            $this->Api_model->insert('purechase_info', $data);
            redirect('Admin/allpurechase');
        }
        else
        {
            redirect('Admin/login');
        }
    }


    function report() 
    {
       if(isset($_SESSION['name'])) 
        {   
            $today = date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day'));
            $yesterday = date('Y-m-d', strtotime(date('Y-m-d') . ' +2 day'));
            $month = date('Y-m-d', strtotime(date('Y-m-d') . ' -30 day'));
            $yearly = date('Y-m-d', strtotime(date('Y-m-d') . ' -365 day'));
            $company_id  = $this->input->post('company_id');
            $date_fillter  = $this->input->post('date_fillter');
            $date_fillter1 = $this->input->post('date1_fillter');
            $date  = strtotime($date_fillter)*1000;
            $date1  = strtotime($date_fillter1)*1000;

            if($date_fillter !="" && $date_fillter1 !="")
            {
                $data['date_fillter1']=$date_fillter1;
                $data['date_fillter']=$date_fillter;

                if(is_numeric($company_id))
                {
                  $company=$this->Api_model->getSingleRow('company', array('id'=>$company_id));

                  $data['company_name']=$company->com_name;
                  $data['company_id']=$company_id;
                  $data['purechase_info']= $this->Api_model->getInvoiceReport('purechase_info',$company_id,$date,$date1);
                }
                else
                {
                  $data['company_name']="Not Selected";
                  $data['purechase_info']= $this->Api_model->getSumByDate('purechase_info',$date,$date1);
                }
                
            }
            else
            {
                $data['purechase_info']=array();
            }
            
            $data['company']= $this->Api_model->getAllData('company');
            $data['page']='purechase information';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php', $data);
            $this -> load ->view('report', $data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
            redirect('Admin/login');
        }
    }

    function sale_report_tax() 
    {
       if(isset($_SESSION['name'])) 
        {   
            $date_fillter  = $this->input->post('date_fillter');
            $date_fillter1 = $this->input->post('date1_fillter');
            $date  = strtotime($date_fillter)*1000;
            $date1  = (strtotime($date_fillter1)+86400)*1000;

            if($date_fillter !="" && $date_fillter1 !="")
            {
                $data['date_fillter1']=$date_fillter1;
                $data['date_fillter']=$date_fillter;
                $data['purechase_info']= $this->Api_model->getSumByDateInvoice('invoice',$date,$date1);
            }
            else
            {
                $data['purechase_info']=array();
            }
            $data['company']= $this->Api_model->getAllData('company');
            $data['page']='sale_report_tax';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php', $data);
            $this -> load ->view('sale_report_tax', $data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
            redirect('Admin/login');
        }
    }

    function sale_report() 
    {
       if(isset($_SESSION['name'])) 
        {   
            $date_fillter  = $this->input->post('date_fillter');
            $date_fillter1 = $this->input->post('date1_fillter');
            $menu_pub_id = $this->input->post('menu_pub_id');
            $date  = strtotime($date_fillter)*1000;
            $date1  = strtotime($date_fillter1)*1000;

            if($date_fillter !="" && $date_fillter1 !="")
            {
                $data['date_fillter1']=$date_fillter1;
                $data['date_fillter']=$date_fillter;
                $data['menu_pub_id']=$menu_pub_id;
                if($menu_pub_id !=0)
                {
                  $purechase_info= $this->Api_model->getSumByDateOrders('orders',$menu_pub_id,$date,$date1);
                  if($purechase_info)
                  {
                    $purechase_infos= array();
                    foreach ($purechase_info as $purechase_info) 
                    {
                      $menu= $this->Api_model->getSingleRow('menu', array('menu_pub_id'=>$purechase_info->menu_pub_id));
                      $purechase_info->menu_name= $menu->menu_name;

                      array_push($purechase_infos, $purechase_info);
                    }
                    $data['purechase_info']=$purechase_infos;
                  }
                  else
                  {
                    $data['purechase_info']=array();
                  }
                }
                else
                {
                  $purechase_info= $this->Api_model->getSumByDate('purechase_info',$date,$date1);

                   if($purechase_info)
                    {
                      $purechase_infos= array();
                      foreach ($purechase_info as $purechase_info) 
                      {
                        $purechase_info->menu_name= "Not Selected";
                        $purechase_info->quantity= 0;

                        array_push($purechase_infos, $purechase_info);
                      }
                      $data['purechase_info']=$purechase_infos;
                    }
                    else
                    {
                      $data['purechase_info']=array();
                    }
                }
            }
            else
            {
                $data['purechase_info']=array();
            }
            
            $data['company']= $this->Api_model->getAllData('company');
            $data['menu']= $this->Api_model->getAllData('menu');
            $data['page']='sale_report';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php', $data);
            $this -> load ->view('sale_report', $data);
            $this -> load -> view('common/footer.php');
        }
        else
        {
            redirect('Admin/login');
        }
    }

     public function editMeasurement(){
            $menu_id=$this->uri->segment(3);
            $data['measurementdata']= $this->Api_model->getSingleRow('measurement_info', array('id'=>$menu_id));
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this -> load -> view('editMeasurement',$data);
            $this -> load -> view('common/footer.php');
        }

    function add_product() 
    {
       if(isset($_SESSION['name'])) 
         {
         $data1['product_info']=$this->Api_model->getAllData('product_info');
         $data1['measurement']=$this->Api_model->getAllDataWhere(array('status'=>1),'measurement_info');
         $this->form_validation->set_rules('pro_name', 'Product Name','required|is_unique[product_info.pro_name]');
            if ($this->form_validation->run() == FALSE)
            {
            $data['page']='Add Product';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php',$data);
            $this -> load -> view('addProduct', $data1);
            $this -> load -> view('common/footer.php');
             }
              else
              {

            $data['pro_pub_id']       =   $this->getPubId();
            $data['pro_name']         =   $this->input->post('pro_name');
            $data['quantity']         =   $this->input->post('quantity');
            $data['company_id']       =   $this->input->post('company_id');
            $data['meas_pub_id']      =   $this->input->post('meas_pub_id');
            $data['created_at']       =   time();
            $data['updated_at']       =   time();
            $this->Api_model->insert('product_info', $data);
            redirect('Admin/addProduct');

            }

          }
            else
            {
            redirect('Admin/login');
            }
        }
      
    public function addMeasurement()
    {
     if(isset($_SESSION['name'])) 
        {   

       {   
        $data['measurement_info']=$this->Api_model->getAllData('measurement_info');
        $this -> load -> view('common/head.php');
        $this -> load -> view('common/sidebar.php');
        $this->load ->view('addMeasurement',$data);
        $this -> load -> view('common/footer.php');
    }
   }
    else
        {
             redirect('Admin/login');
        }
    }


     function add_measurement() {
       if(isset($_SESSION['name'])) 
         {
         $data1['measurement_info']=$this->Api_model->getAllData('measurement_info');
        $this->form_validation->set_rules('meas_title', 'Measurement', 'required|is_unique[measurement_info.meas_title]');
            if ($this->form_validation->run() == FALSE)
            {
            $data['page']='Add Supplier';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php',$data);
            $this -> load -> view('addMeasurement', $data1);
            $this -> load -> view('common/footer.php');
             }
              else
              {
            $data['meas_pub_id']      =   $this->getPubId();
            $data['meas_title']       =   $this->input->post('meas_title');
            $data['created_at']       =   time();
            $data['updated_at']       =   time();
            $this->Api_model->insert('measurement_info', $data);
            redirect('Admin/addMeasurement');

            }

          }
            else
            {
            redirect('Admin/login');
            }
        }


   public function addSupplier(){
     if(isset($_SESSION['name'])) 
        {   

       {   
        $data['supplier']=$this->Api_model->getAllData('supplier_info');
        $this -> load -> view('common/head.php');
        $this -> load -> view('common/sidebar.php');
        $this->load ->view('addSupplier',$data);
        $this -> load -> view('common/footer.php');
    }
   }
    else
        {
             redirect('Admin/login');
        }
    }

     public function addTax()
     {
        if(isset($_SESSION['name'])) 
        {  
          $data['tax']=$this->Api_model->getAllData('tax_info');
          $this -> load -> view('common/head.php');
          $this -> load -> view('common/sidebar.php');
          $this->load ->view('addTax',$data);
          $this -> load -> view('common/footer.php');
        }
        else
        {
          redirect('Admin/login');
        }
      }

      public function adminSetting()
      {
        if(isset($_SESSION['name'])) 
        {  
          $data['admin']=$this->Api_model->getAllData('admin');
          $this -> load -> view('common/head.php');
          $this -> load -> view('common/sidebar.php');
          $this->load ->view('adminSetting',$data);
          $this -> load -> view('common/footer.php');
        }
        else
        {
          redirect('Admin/login');
        }
      }

      public function adminSettingAction()
      {
          if(isset($_SESSION['name'])) 
          {
              $id  =   $this->input->post('id');
              $data['password'] = md5($this->input->post('password'));
              $data['email'] = $this->input->post('email');
              $where = array('id'=>$id);
              $this->Api_model->updateSingleRow('admin', $where, $data);
              redirect('Admin/adminSetting');
           }
          else
          {
            redirect('Admin/login');
          }
      }

      public function editProduct()
      {
            $data['company']=$this->Api_model->getAllData('company');
            $product_id=$this->uri->segment(3);
           $data['product_info']= $this->Api_model->getSingleRow('product_info', array('id'=>$product_id));
           $data['measurement']=$this->Api_model->getAllDataWhere(array('status'=>1),'measurement_info');
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this -> load -> view('editProduct',$data);
            $this -> load -> view('common/footer.php');
        }
   
   public function editSupplier(){
            $supplier_id=$this->uri->segment(3);
           $data['supplierData']= $this->Api_model->getSingleRow('supplier_info', array('id'=>$supplier_id));
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this -> load -> view('editSupplier',$data);
            $this -> load -> view('common/footer.php');
    }

     public function editTax(){
            $supplier_id=$this->uri->segment(3);
           $data['taxData']= $this->Api_model->getSingleRow('tax_info', array('id'=>$supplier_id));
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php');
            $this -> load -> view('editTax',$data);
            $this -> load -> view('common/footer.php');
    }


    function add_supplier() {
       if(isset($_SESSION['name'])) 
         {
         $data1['supplier']=$this->Api_model->getAllData('supplier_info');
        $this->form_validation->set_rules('name', 'Supplier Name', 'required|is_unique[supplier_info.name]');
            if ($this->form_validation->run() == FALSE)
            {
            $data['page']='Add Supplier';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php',$data);
            $this -> load -> view('addSupplier', $data1);
            $this -> load -> view('common/footer.php');
             }
              else
              {
            $data['sup_pub_id']       =   $this->getPubId();
            $data['name']             =   $this->input->post('name');
            $data['created_at']       =   time();
            $data['updated_at']       =   time();
            $this->Api_model->insert('supplier_info', $data);
            redirect('Admin/addSupplier');

            }

          }
            else
            {
            redirect('Admin/login');
            }
        }

          function add_tax() {
       if(isset($_SESSION['name'])) 
         {
         $data1['tax']=$this->Api_model->getAllData('tax_info');
        $this->form_validation->set_rules('tax', 'Tax', 'required|is_unique[tax_info.tax]');
            if ($this->form_validation->run() == FALSE)
            {
            $data['page']='Add Tax';
            $this -> load -> view('common/head.php');
            $this -> load -> view('common/sidebar.php',$data);
            $this -> load -> view('addTax', $data1);
            $this -> load -> view('common/footer.php');
             }
            else
            {
                if(count($data1['tax'])<0)
                {
            $data['tax_pub_id']       =   $this->getPubId();
            $data['tax']             =   $this->input->post('tax');
            $data['created_at']       =   time();
            $data['updated_at']       =   time();
            $this->Api_model->insert('tax_info', $data);
            }
              else
              {
            $tax_id            =   $this->input->post('tax_id');
            $updata['tax']           =   $this->input->post('tax');
            $updata['updated_at']     =   time();
            $where = array('id'=>$tax_id);
            $this->Api_model->updateSingleRow('tax_info', $where, $updata);
              }
               redirect('Admin/addTax');
            }

          }
            else
            {
            redirect('Admin/login');
            }
        }



         public function update_supplier()
          {
           if(isset($_SESSION['name'])) 
        {
            $supplier_id            =   $this->input->post('supplier_id');
            $data['name']           =   $this->input->post('name');
            $data['updated_at']     =   time();
            $where = array('id'=>$supplier_id);
            $this->Api_model->updateSingleRow('supplier_info', $where, $data);
            redirect('Admin/addSupplier');
         }
        else{

          redirect('Admin/login');
        }
    }

     public function update_tax()
          {
           if(isset($_SESSION['name'])) 
        {
            $tax_id            =   $this->input->post('tax_id');
            $data['tax']           =   $this->input->post('tax');
            $data['updated_at']     =   time();
            $where = array('id'=>$tax_id);
            $this->Api_model->updateSingleRow('tax_info', $where, $data);
            redirect('Admin/addtax');
         }
        else{

          redirect('Admin/login');
        }
    }
    
    public function update_product()
          {
           if(isset($_SESSION['name'])) 
        {
            $pro_id            =   $this->input->post('pro_id');
            $data['pro_name']  =   $this->input->post('name');
            $data['quantity']  =   $this->input->post('quantity');
            $data['meas_pub_id'] = $this->input->post('meas_pub_id');
            $data['company_id'] = $this->input->post('company_id');
            $data['updated_at']=   time();
            $where = array('id'=>$pro_id);
            $this->Api_model->updateSingleRow('product_info', $where, $data);
            redirect('Admin/addProduct');
         }
        else{

          redirect('Admin/login');
        }
    }

     public function update_measurment()
          {
           if(isset($_SESSION['name'])) 
        {
            $meas_id            =   $this->input->post('meas_id');
            $data['meas_title'] =   $this->input->post('meas_title');
            $data['updated_at'] =   time();
            $where = array('id'=>$meas_id);
            $this->Api_model->updateSingleRow('measurement_info', $where, $data);
            redirect('Admin/addMeasurement');
         }
        else{

          redirect('Admin/login');
        }
    }

    public function change_supplier_status()
    {
        $id= $_GET['id'];
        $status= $_GET['status'];
        $where = array('id'=>$id);
        $data = array('status'=>$status);

        $update= $this->Api_model->updateSingleRow('supplier_info', $where, $data);

          // if($update){
          redirect('Admin/addSupplier');
        //}        
    }

    public function change_tax_status()
    {
        $id= $_GET['id'];
        $status= $_GET['status'];
        $where = array('id'=>$id);
        if($status==0)
        {
        $data = array('status'=>$status,'tax'=>0);
        }
        else
        {
          $data = array('status'=>$status);  
        }
        $update= $this->Api_model->updateSingleRow('tax_info', $where, $data);

          //if($update){
          redirect('Admin/addTax');
       // }        
    }
    

    public function change_order_status()
    {
        
        $id= $_GET['id'];
         $invoice=$this->Api_model->getSingleRow('invoice',array('id'=>$id));
          $users=$this->Api_model->getSingleRow('users',array('user_pub_id'=>$invoice->user_pub_id));
        $status= $_GET['status'];
        $where = array('id'=>$id);
        $data = array('invoice_status'=>$status);

        $update= $this->Api_model->updateSingleRow('invoice', $where, $data);

          //if($update){
          redirect('Admin/userOrderInfo/'.$users->user_pub_id);
        //}        
    }
public function login()
    {     

        $email= $this->input->post('email', TRUE);
        $password=$this->input->post('password', TRUE);
        
        $data['email']= $email;
        $data['password']= md5($password);
        $sess_array=array();
        $getdata=$this->Api_model->getSingleRow('admin',$data);
        if($getdata)
        {           

            $this->session->unset_userdata($sess_array);
            $sess_array = array(
             'name' => $getdata->name,
             'email' => $getdata->email,
             'id' => $getdata->id,
           );

           $this->session->set_userdata( $sess_array);
            $dataget['get_data'] =$getdata;
            $dataget['see_data'] =$sess_array;
            redirect('Admin/dashboard');    
        }
        else
        {

        $this->session->set_flashdata('msg',LOGIN_FLASH);
        redirect('');

        }
    }
  
  public function notification()
    {

        $data['user']= $this->Api_model->getAllData('user');
        $data['page']='notification';

        $this -> load -> view('common/head.php');
        $this -> load -> view('common/sidebar.php', $data);
        $this -> load ->view('notification.php', $data);
        $this -> load -> view('common/footer.php');
    }

 public function putnotification()
    {
      $id=explode(',', $_POST['uid']);

      $count=count($id);
      for ($i=0; $i<$count ; $i++) { 

      $user_id = $id[$i];
      $title=$_POST['title'];
      $msg=$_POST['message'];
      $this->firebase_notification($user_id,$title,$msg);
      $data['user_id'] = $user_id;
      $data['title'] = $title;
      $data['description'] = $msg;
      $this->Api_model->insert('admin_notification',$data);
    }
    
      redirect('Admin/notification');    
  }

   /*Firebase for notification*/
   public function firebase_notification($user_id,$title,$msg)
   {

     $get_data= $this->Api_model->getSingleRow('user',array('id'=>$user_id));
   
     if($get_data->device_tokan)
     {
         if($get_data->role_id==1)
       {
          $API_ACCESS_KEY= FIRE_BASE_KEY;
       }
       else
       {
          $API_ACCESS_KEY= FIRE_BASE_KEY;
       
       }

       $registrationIds = $get_data->device_tokan;

         $msg = array
             (
                  'body'    => $msg,
                  'title'   => $title,
                  'icon'    => 'myIcon',/*Default Icon*/
                  'sound'   => 'mySound'/*Default sound*/
             );

         $fields = array
         (
             'to' => $registrationIds,
             'notification' => $msg
         );
         $headers = array
         (
             'Authorization: key=' . $API_ACCESS_KEY,
             'Content-Type: application/json'
         );
         #Send Reponse To FireBase Server
         $ch = curl_init();
         curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
         curl_setopt( $ch,CURLOPT_POST, true );
         curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
         curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
         curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
         curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
         $result = curl_exec( $ch );
         curl_close( $ch );
     }
   }
  
  public function change_order_status_dash()
    {
        
        $id= $_GET['id'];
         $invoice=$this->Api_model->getSingleRow('invoice',array('id'=>$id));
         $status= $_GET['status'];
        $where = array('id'=>$id);
        $data = array('invoice_status'=>$status);

        $update= $this->Api_model->updateSingleRow('invoice', $where, $data);

          //if($update){
          redirect('Admin/dashboard');
        //}        
    }


    public function change_status_sales()
    {
        
        $id= $_GET['id'];
         $invoice=$this->Api_model->getSingleRow('invoice',array('id'=>$id));
         $status= $_GET['status'];
        $where = array('id'=>$id);
        $data = array('invoice_status'=>$status);

        $update= $this->Api_model->updateSingleRow('invoice', $where, $data);

          //if($update){
          redirect('Admin/allOrder');
        //}        
    }

  public function getPubId()
  {
    return uniqid();
  }

  public function userDetails(){
  // POST data
  $postData = $this->input->post();

  //load model
  $this->load->model('Api_model');

  // get data
  $data = $this->Api_model->getUserDetails($postData);

  echo json_encode($data);
 }
 

 public function logout()
 {
    $this->session->sess_destroy();
    redirect();
 }
  

  public function setEmail()
  {
    if(isset($_SESSION['name'])) 
    {   
      $data['report_mail']=$this->Api_model->getSingleRow('report_mail',array('id'=>1));
      $this -> load -> view('common/head.php');
      $this -> load -> view('common/sidebar.php');
      $this->load ->view('setEmail',$data);
      $this -> load -> view('common/footer.php');
    }
    else
    {
      redirect('Admin/login');
    }
  }

  public function sendEmailAction()
  {
    $data['email']=$this->input->post('email');
    $this->Api_model->updateSingleRow('report_mail',array('id'=>1), $data);
    redirect('Admin/setEmail');
  }
}