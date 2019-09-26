<?php
    /**
    * 
    */
    class Api_model extends CI_Model
    {
        
        function __construct()
        {
            parent:: __construct();
        }

        /*Get single row data*/
        public function getSingleRow($table, $condition)
        {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($condition);
            $query = $this->db->get();
            return $query->row();       
        }
        
        /*Get single row data*/
        public function getUsereRow($mobile_no,$mobile_no1)
        {
          $query = $this->db->query("SELECT * FROM `users` WHERE  `mobile_no` = '".$mobile_no."' || `mobile_no` ='".$mobile_no1."'");
          return $query->row();       
        }

        public function getLastInventry($product_pub_id)
        {
          $query = $this->db->query("SELECT * FROM `inventory_info` WHERE  `pro_pub_id` = '".$product_pub_id."' order by created_at desc limit 1");
          return $query->row();       
        }

        public function getOperatorInfo($table, $condition)
        {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($condition);
            $query = $this->db->get();
            return $query->row();       
        }

         public function getUserInfo($table, $condition)
        {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($condition);
            $query = $this->db->get();
            return $query->row();       
        }

        public function getTrueFalse($table, $condition){
          $this->db->select('*');
           $this->db->from($table);
           $this->db->where($condition);
           $query = $this->db->get();
           $my =  $query->row();

           if ($my) {
               return 1;
             }
             else
             {
               return 0;
             }

       }


/* err responce */

         public function errResponse($status, $message){
            $arr = array('status' => $status,'message' => $message); 
            header('Content-Type: application/json');      
             echo json_encode($arr);
        }


        public function getSumWithWhere($columnName,$table,$where)
        {
            $this->db->select_sum($columnName);
            $this->db->from($table);
            $this->db->where($where);
            $query=$this->db->get();
            return $query->row();
        }
        /*Insert and get last Id*/
        public function insertGetId($table,$data)
        {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
        /*Check existing record*/
        function checkData($table, $condition, $columnName)
        {
            $this->db->select($columnName);
            $this->db->from($table);
            $this->db->like($condition);
            return $this->db->count_all_results();
        }   

        /*Update any data*/
         public function updateSingleRow($table, $where, $data)
        {                 
            $this->db->where($where);
            $this->db->update($table, $data);
            
            if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
            else
            {
              return FALSE;
            }
        }

        public function updateViewPet($pet_id)
        {
            $this->db->where('id', $pet_id);
            $this->db->set('view_profile', 'view_profile+1', FALSE);
            $this->db->update('pet');
             if ($this->db->affected_rows() > 0)
            {
             
              return TRUE;
            }
            else
            {
             
              return FALSE;
            }
        }

         public function updateRatingPet($pet_id, $rating)
        {
            $this->db->where('id', $pet_id);
            $this->db->set('total_rating_user', 'total_rating_user+1', FALSE);
            $this->db->set('rating', $rating, FALSE);
            $this->db->update('pet');
             if ($this->db->affected_rows() > 0)
            {
             
              return TRUE;
            }
            else
            {
             
              return FALSE;
            }
        }


        /*Add new data*/
        function insert($table,$data)
         {
            if($this->db->insert($table, $data))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }

         }

        /*Get All data*/
        public function getAllData($table)
        {
            $this->db->select("*");
            $this->db->from($table);
            $query = $this->db->get();          
            return $query->result();
        }

        public function getAllDataColumn($table, $columnName,$where)
        {
            $this->db->where($where);
            $this->db->select($columnName);
            $this->db->distinct();
            $query = $this->db->get($table);
            return $query->result();
        }
       
        public function getFilterData($table,$Data)
        {

            if (!empty($Data))
             {
              foreach ($Data as $key => $value)
                  {
                    if ($value) {
                   $this->db->where_in($key, $value);
                    }else{
                    }
                   
                  }
            }
             // $this->db->where_in($columnName2, $where2);
            // $this->db->where_in($columnName3, $where3);
              $this -> db -> where('deleted', false);
            $this->db->select("*");
            $this->db->distinct();

            $query = $this->db->get($table);
            return $query->result();
        }
     
        /*Get All data with where clause*/
        public function getAllDataWhere($where, $table)
        {
            $this->db->where($where);
            $this->db->select("*");
            $this->db->from($table);
            $query = $this->db->get();     
            return $query->result();
        }

           public function getAllBreed($where, $table)
        {
            $this->db->where($where);
            $this->db->select("*");
            $this->db->from($table);
            $this->db->order_by('breed_name');
            $query = $this->db->get();     
            return $query->result();
        }
       

        public function getSingleDataWhere($where, $table)
        {
            $this->db->where($where);
            $this->db->select("pet_img_path");
            $this->db->from($table);
            $query = $this->db->get();     
            return $query->result();
        }

         // Count avarage 
        public function getAvgWhere($columnName, $table,$where)
        {
            $this->db->select_avg($columnName);
            $this->db->from($table);
            $this->db->where($where);
            $query =$this->db->get(); 
            return $query->result(); 
        }

        public function deleteRecord($where, $table)
        {
            $this->db-> where($where);
            $query = $this->db->delete($table);  
        } 
      /*Added By Varun_Andro*/
        //Response Function TRUE WITH DATA

        public function responseSuccess($status, $message, $data){
            $arr = array('status' => $status,'message' => $message, 'data'=> $data); 
            header('Content-Type: application/json');      
             echo json_encode($arr); 
        }
        //Response Function TRUE 

        public function responseSuccessWithOutData($status, $message){
            $arr = array('status' => $status,'message' => $message); 
            header('Content-Type: application/json');      
             echo json_encode($arr); 
        }

         //Response Function FALSE

        public function responseFailed($status, $message){
            $arr = array('status' => $status,'message' => $message); 
            header('Content-Type: application/json');      
             echo json_encode($arr);
        }

        public function distance($lat1, $lon1, $lat2, $lon2) 
        {

          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
        
            return ($miles * 1.859344);
        }

        function get_user_record_by_user_id($user_id) {
        $this -> db -> where('id', $user_id);
        $this -> db -> from('users');
        $query = $this -> db -> get();
        return $query -> result();
    }   

    function get_reminder_history($app_id='',$user_id='',$pet_id='')
    {
        if ($user_id !='' && $pet_id!='') 
        {
            return $this->db->where('user_id',$user_id)->where('pet_id',$pet_id)->get('appointment');
        }
        elseif($user_id !='') 
        {
            return $this->db->where('user_id',$user_id)->get('appointment');
        }
      
    }

    // get all appointment

    function get_app($app_id='',$user_id='',$pet_id='')
    {
      if($app_id !='')
      {
          return $this->db->where('id',$app_id)->get('appointment');

      }
      elseif($user_id !='' && $pet_id!='')
      {
          return $this->db->where('user_id',$user_id)->where('pet_id',$pet_id)->where('status','0')->get('appointment');

      }
       elseif($user_id !='')
      {
          return $this->db->where('user_id',$user_id)->where('status','0')->get('appointment');

      }
      else
      {
         return $this->db->where('status','0')->get('appointment');
      }
    }

    function change_status($app_id,$status)
    {
      if(!empty($app_id))
      { 
          $changed = $this->db->where('id',$app_id)->update('appointment',array('status'=>$status));
          if($this->db->affected_rows()>0)
          {
            return true;
          }
          else
          {
            return false;
          }
      }
      else
      {
        return false;
      }

    }

    function create_notification($data)
    {        
      if($this->db->insert('notification',$data))
      {
          return true;
      }
      else
      {
          return false;
      }
    }

    public function add_appointment($data)
    {
        $this->db->insert('appointment', $data);
        return $this->db->insert_id();
    }

    public function get_manual_activity_bydate($pet_id,$user_id,$date)
    {
      $this ->db -> where('pet_id', $pet_id);
      $this ->db -> where('user_id', $user_id);
      $this ->db -> where ('date', $date );
      $this ->db -> from('manualactivity');
      $query = $this -> db -> get();
      return $query -> result();
    }

    public function update_manual_activity($pet_id,$user_id,$date,$data)
    {
          $this->db->where('pet_id', $pet_id);
          $this ->db -> where('user_id', $user_id);
          $this ->db -> where( 'date', $date);
          $this->db->update('manualactivity' , $data);
    }

    public function set_manual_activity($data)
    {
      //print_r($data);
      if($this ->db -> insert('manualactivity', $data))
      {
        //echo "data inserted";

      }
    }

    public function get_manual_activity($pet_id,$user_id)
    {
        $this ->db -> where('pet_id', $pet_id);
        $this ->db -> where('user_id', $user_id);
        $this->db->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');
        $this ->db -> from('manualactivity');
        $query = $this->db -> get();
        return $query -> result();

    }

     public function get_post($limit, $offset,$where) 
    {
      $this->db->where($where);  
      $this->db->select('*');
      $this->db->order_by('postID', 'desc');  
      $this->db->from('post');
      $this->db->limit($limit, $offset);
      $query = $this->db->get();
      return $query->result_array();
     }

      public function check_like($postID,$user_id)   
    {
        $this->db-> where('user_id', $user_id);
        $this->db-> where('postID', $postID);
        $this->db->select("*");
        $this->db->from('likes');
        $query = $this->db->get();
        return $query->row();   
    }

       public function get_user($user_id)   
    {
        $this->db-> where('id', $user_id);
        $this->db->select("*");
        $this->db->from('users');
        $query = $this->db->get();
        return $query->row();   
    }

       
       public function get_pet($user_id)   
    {
        $this->db-> where('user_id', $user_id);
        $this->db->select("*");
        $this->db->from('pet');
        $query = $this->db->get();
        return $query->row();   
    }

    public function no_of_records($table, $where)
     {
        $this->db->where($where);
        $this->db->from($table);
        return $this->db->count_all_results();
     }   
     public function count($table)
     {
        $this->db->from($table);
        return $this->db->count_all_results();
     }  
      public function get_my_post($limit, $offset, $user_id)
    {
      $this->db->where('user_id',$user_id);
      $this->db->where('flag',1);  
      $this->db->select('*');
      $this->db->order_by('postID', 'desc');  
      $this->db->from('post');
      $this->db->limit($limit, $offset);
      $query = $this->db->get();
      return $query->result_array();
     }

   
      public function like($data)
    {
        $this->db->insert('likes', $data);
        return $this->db->insert_id();
    }

     public function get_comments_true($postID) 
    {
      $this->db->where('postID', $postID);  
      $this->db->where('flag', 1);  
      $this->db->select('*');
      $this->db->order_by('commentID', 'desc');  
      $this->db->from('comments');
      $query = $this->db->get();
      return $query->result_array();
     }

      public function comment($data)
    {
        $this->db->insert('comments', $data);
        return $this->db->insert_id();
    }

     public function get_single_post($postID)   
    {
        $this->db-> where('postID', $postID);
        $this->db->select("*");
        $this->db->from('post');
        $query = $this->db->get();
        return $query->row();   
    }

    public function get_abuse($user_id, $postID) 
    {
      $this->db->where('user_id', $user_id);  
      $this->db->where('postID', $postID);  
      $this->db->select('*');
      $this->db->from('abuse_post');
      $query = $this->db->get();
      return $query->row();
    }

     public function abuse_post($data)
    {
        $this->db->insert('abuse_post', $data);
        return $this->db->insert_id();
    }

       public function check_post($postID,$user_id)   
    {
        $this->db-> where('postID', $postID);
        $this->db-> where('user_id', $user_id);        
        $this->db->select("*");
        $this->db->from('post');
        $query = $this->db->get();
        return $query->row();   
    }
    
    public function delete_post($data)
    {       
        $postID = $data['postID'];
        $this->db->where('postID',$postID);
        $this->db->update('post', $data);    
    }

    public function add_post($data)
    {
        $this->db->insert('post', $data);
        return $this->db->insert_id();
    }

     public function get_all_user() 
    {  
      $this->db->select('*');
      $this->db->from('users');
      $query = $this->db->get();
      return $query->result_array();
     }

     public function update_post($data)
    {       
        $postID = $data['postID'];
        $this->db->where('postID',$postID);
        $this->db->update('post', $data);    
    }

     public function check_review($user_id, $pet_id)
    {
        $this->db-> where('pet_id', $pet_id);
        $this->db-> where('user_id', $user_id);
        $this->db->select("*");
        $this->db->from('rating');
        $query = $this->db->get();
        return $query->result();   
    }
      public function add_review($data)
    {
        $this->db->insert('rating', $data);
        return true;
    }

     public function count_total_rating($pet_id) 
    {
      $this->db->select('AVG(rating) as average');
      $this->db->where('pet_id', $pet_id);
      $this->db->from('rating');
      $query = $this->db->get();
      return $query->row();   
    }
      public function count_total_rating_product($product_id) 
    {
      $this->db->select('AVG(rating) as average');
      $this->db->where('product_id', $product_id);
      $this->db->from('review_product');
      $query = $this->db->get();
      return $query->row();   
    }

     public function check_review_product($user_id, $product_id)
    {
        $this->db-> where('product_id', $product_id);
        $this->db-> where('user_id', $user_id);
        $this->db->select("*");
        $this->db->from('review_product');
        $query = $this->db->get();
        return $query->result();   
    }

     public function updateRatingProduct($product_id, $rating)
        {
            $this->db->where('p_id', $product_id);
            $this->db->set('product_rating', $rating, FALSE);
            $this->db->update('food_product');
             if ($this->db->affected_rows() > 0)
            {
             
              return TRUE;
            }
            else
            {
             
              return FALSE;
            }
        }
        /*By pankaj choudhary for new admin panel*/

       
         /*Get single row data*/
        public function getSingleRowCloumn($columnName,$table, $condition)
        {
            $this->db->select($columnName);
            $this->db->from($table);
            $this->db->where($condition);
            $query = $this->db->get();
            return $query->row();       
        }


        /*Check existing record*/
        function getCount($table, $condition)
        {
            $this->db->select("*");
            $this->db->from($table);
            $this->db->where($condition);
            return $this->db->count_all_results();
        }   

         /*Get no of records*/
        function getCountAll($table)
        {
            $this->db->select("*");
            $this->db->from($table);
            return $this->db->count_all_results();
        }

         /*Get All data with Limit*/
        public function getAllDataLimit($table, $limit)
        {
            $this->db->select("*");
            $this->db->from($table);
            $this->db->order_by('id', 'desc');
            $this->db->limit($limit);
            $query = $this->db->get();          
            return $query->result();
        }


        /*Get All data with where clause*/
        public function getAllDataWhereDistinct($where, $table)
        {   
            $this->db->distinct('user_id');
            $this->db->where($where);
            $this->db->select("user_id");
            $this->db->from($table);
            $query = $this->db->get();         
            return $query->result();
        }

         /*Get All data with where clause*/
        public function getAllDataWhereDistinctArtist($where, $table)
        {   
            $this->db->distinct('artist_id');
            $this->db->where($where);
            $this->db->select("artist_id");
            $this->db->from($table);
            $query = $this->db->get();         
            return $query->result();
        }

  
         // Count avarage 
        public function getTotalWhere($table,$where)
        {
            $this->db->from($table);
            $this->db->where($where);
            $query =$this->db->get(); 
            return $query->num_rows(); 
        }

         // Count avarage 
        public function getSum($columnName, $table)
        {
            $this->db->select_sum($columnName);
            $this->db->from($table);
            $query =$this->db->get(); 
            return $query->result(); 
        }
        
        public function getNearestData($lat,$lng,$table)
        {
            $this->db->select("*, ( 3959 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance");
            $this->db->from($table); 
            $this->db->having('distance <= ', '1');                    
            $this->db->order_by('distance');                    
            $this->db->limit(1, 0);
            $query =$this->db->get(); 
            return $query->row(); 
        }

         public function getNearestDataWhere($lat,$lng,$table,$where,$distance)
        {
            $this->db->select("*, ( 3959 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance");
            $this->db->from($table); 
            $this->db->where($where);
            $this->db->having('distance <= ', $distance);                    
            $this->db->order_by('distance');                    
            $this->db->limit(1, 0);
            $query =$this->db->get(); 
            return $query->result(); 
        }

        public function getWhereInStatus($table,$where,$columnName, $where_in)
        {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($where);
            $this->db->where_in($columnName, $where_in);
            $this->db->order_by('id', 'desc');
            $query =$this->db->get(); 
            return $query->row();
        }
         public function get_all_food()
    {
        $this->db->select("*");
        $this->db->from('food_company');
        $query = $this->db->get();
        return $query->result();   
    }
     // public function voteCount(){
     //  $this->db->select count("*");
     //  $this->db->from('$table');
     //  $this->db->where($condition);


     // }
     public function get_all_pet_type()
    {
        $this->db->select("*");
        $this->db->from('pet_type');
        $query = $this->db->get();
        return $query->result();   
    }

    public function updateComunity($user_id, $comunity_id)
        {
            $this->db->where('id', $user_id);
            $this->db->set('comunity_id', $comunity_id, FALSE);
            $this->db->update('users');
             if ($this->db->affected_rows() > 0)
            {
             
              return TRUE;
            }
            else
            {
             
              return FALSE;
            }
        }

    public function upload_image($user_id,$pet_id,$description,$created,$img)
    {
       $done = false;
       for($i=0;$i<count($img);$i++)
       {  
         $image = array(
          'pet_img_path' => $img[$i],
          'user_id'=>$user_id,
          'pet_id'=>$pet_id,
          'description'=>$description,
          'created'=>$created
          );
           if($this->db->insert('pet_memories',$image))
           {
              $done = true;
           }
           else
           {
             $done = false;
           }
       }
          return $done;
        
    }

    public function send_opt_mobile($country_code,$mobile, $msg)
    {
      //$authKey = "145610AaPIgqOsYXl58cfb1fe";
      $authKey = "205521AaBNspcwGS5ab512aa";
    
        //Multiple mobiles numbers separated by comma
        $mobileNumber = $country_code.$mobile;
        
        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "PETSTA";
        
        //Your message to send, Add URL encoding here.
        $message = urlencode($msg);
        
        //Define route 
        $route = "4";
        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );
        
        //API URL
        $url="https://api.msg91.com/api/sendhttp.php?authkey='$authKey'&mobiles='$mobileNumber'&message='$message'&sender='$senderId'&route=4&country=91";

        
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));
        

        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        
        //get response
        $output = curl_exec($ch);
        
        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }
        
        curl_close($ch);
      }

     

    public function send_email_invitation($email_id, $subject, $msg)
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

        $from_email = 'samyotechindore@gmail.com'; 
        
        $this->email->from($from_email, 'FabArtist'); 
        $this->email->to($email_id);
        $this->email->subject($subject); 
        //$this->CI->email->set_mailtype('html');

        $datas['msg']=$msg;
         $body = $this->load->view('mailer.php',$datas,TRUE);
         $this->email->message($body);

       return $this->email->send();
    }

     public function send_email_signup($email_id, $subject, $msg,$verify)
    {
        $userData = $this->Api_model->getSingleRow('user',array('email'=>$email_id));
        if($userData){
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

        $from_email = 'samyotechindore@gmail.com'; 
        
        $this->email->from($from_email, 'Restaurant'); 
        $this->email->to($email_id);
        $this->email->subject($subject); 
        //$this->CI->email->set_mailtype('html');

         $datas['msg']=$msg;
         $datas['verify'] = $verify;
         $datas['userName'] = $userData->name;
         $body = $this->load->view('verifyEmail.php',$datas,TRUE);
         $this->email->message($body);
         if($this->email->send()){
          echo "All Ok";
         }else{
          $this->email->print_debugger();
         }
       }
    }



     /*fetch data*/
     public function getUserDetails($postData){
 
    $response = array();
 
    if($postData['company_name'] ){
 
      // Select record
      $this->db->select('*');
      $this->db->where('com_name', $postData['company_name']);
      $q = $this->db->get('company');
      $response = $q->result_array();
 
    }
 
    return $response;
  }





   /* Get User Status*/
public function getUserStatus($operator_pub_id)
{
    $query = $this->db->query("SELECT * FROM `staff` WHERE `status`='1' AND `staff_pub_id`='".$operator_pub_id."'");
    return $query->row();
}

   public function insertfile($data = array()){
        $insert = $this->db->insert_batch('auction_pro_img',$data);
        return $insert?true:false;
    }
    public function getorderInfo($user_pub_id)
    {
     $query =  $this->db->query("SELECT i.*,od.quantity,od.menu_pub_id,m.menu_name,m.price FROM `invoice` AS i  INNER JOIN `orders` AS od ON od.invoice_pub_id = i.invoice_pub_id INNER JOIN `menu` AS m ON m.menu_pub_id = od.menu_pub_id WHERE i.user_pub_id ='".$user_pub_id."'");
       return $query->result();  
    }
    

      public function send_email_info($email_id, $subject, $msg)
    {   
        $userData = $this->Api_model->getSingleRow('user',array('email'=>$email_id));
        if($userData){
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

        $from_email = 'samyotechindore@gmail.com'; 
        
        $this->email->from($from_email, 'Restaurant'); 
        $this->email->to($email_id);
        $this->email->subject($subject); 
        //$this->CI->email->set_mailtype('html');

         $datas['msg']=$msg;
         $datas['name']=$userData->name;
         $body = $this->load->view('infoEmail.php',$datas,TRUE);
         $this->email->message($body);
         if($this->email->send()){
          echo "All Ok";
         }else{
          $this->email->print_debugger();
         }
       }
    }

    function getAllDisableMenu($cat_id)
    {
      $query =  $this->db->query( "select m.*,fc.cat_name,c.currency_symbol AS currency_type,CONCAT( '".base_url()."',  m.photo) AS photo,IFNULL(pb.quantity,0) AS quantity from  menu  as m LEFT  join product_basket as pb on m.menu_pub_id = pb.menu_pub_id JOIN `food_cat` AS fc on fc.id = m.cat_id  INNER JOIN `currency_setting` AS c  WHERE m.`status`='1' AND m.`menu_status`='1' AND m.`cat_id`='".$cat_id."' AND c.status=1");
       return $query->result(); 
    }

    function getAllMenu()
    {
      $query =  $this->db->query("select m.*,fc.cat_name,c.currency_symbol AS currency_type,CONCAT( '".base_url()."',  m.photo) AS photo,IFNULL(pb.quantity,0) AS quantity from  menu  as m LEFT  join product_basket as pb on m.menu_pub_id = pb.menu_pub_id JOIN `food_cat` AS fc on fc.id = m.cat_id  INNER JOIN `currency_setting` AS c  WHERE m.`status`='1' AND c.status=1");
       return $query->result(); 
    }

    function getMyCart($operator_pub_id)
    {
      $query =  $this->db->query("select *,Pb.quantity*m.price AS total_price,c.currency_symbol AS currency_type,t.tax AS tax,CONCAT( '".base_url()."',  m.photo) AS photo FROM `product_basket` AS Pb JOIN `menu` AS m ON m.menu_pub_id = Pb.menu_pub_id INNER JOIN `currency_setting` AS c INNER JOIN `tax_info` AS t WHERE  Pb.operator_pub_id='".$operator_pub_id."' AND c.status=1");
       return $query->result(); 
    }
    
    function getFillterData($menu_name)
    {
      $query =  $this->db->query("select m.*,fc.cat_name,CONCAT( '".base_url()."',  m.photo) AS photo,IFNULL(pb.quantity,0) AS quantity from  menu  as m LEFT  join product_basket as pb on m.menu_pub_id = pb.menu_pub_id JOIN `food_cat` AS fc on fc.id = m.cat_id  WHERE m.`status`='1' AND m.`menu_name` LIKE '%".$menu_name."%'");
       return $query->result(); 
    }

    function getOrderInfoV1($invoice_pub_id)
    {
      $query =  $this->db->query("select i.*,od.quantity,od.menu_pub_id,c.currency_symbol AS currency_type,CONCAT( '".base_url()."',  m.photo) AS photo,m.menu_name,m.price,fc.cat_name,u.name,u.mobile_no,u.country_code  FROM `invoice` AS i  INNER JOIN `orders` AS od ON od.invoice_pub_id = i.invoice_pub_id INNER JOIN `menu` AS m ON m.menu_pub_id = od.menu_pub_id INNER JOIN `food_cat` AS fc ON fc.id = m.cat_id INNER JOIN `users` AS u ON u.user_pub_id =i.user_pub_id INNER JOIN `currency_setting` AS c WHERE i.invoice_pub_id ='".$invoice_pub_id."' AND c.status=1");
       return $query->result(); 
    }

    function getPeddingOrder($operator_pub_id,$role,$status)
    {
      if($role==1)
      {
          $query = $this->db->query("select i.*,c.currency_symbol AS currency_type,u.name,u.mobile_no,u.country_code FROM `invoice` AS i INNER JOIN `currency_setting` AS c ON i.operator_pub_id ='".$operator_pub_id."' AND i.invoice_status='".$status."' AND c.status=1 INNER JOIN `users` AS u ON u.user_pub_id =i.user_pub_id ORDER BY i.id DESC");
      }
      else
      {
          $query = $this->db->query("select i.*,c.currency_symbol AS currency_type,u.name,u.mobile_no,u.country_code FROM `invoice` AS i INNER JOIN `currency_setting` AS c ON i.chef_pub_id ='".$operator_pub_id."' AND i.invoice_status='".$status."' AND c.status=1 INNER JOIN `users` AS u ON u.user_pub_id =i.user_pub_id ORDER BY i.id DESC");
      }
      return $query->result(); 
    }

    function getPeddingOrderOr($operator_pub_id,$role,$status)
    {
      if($role==1)
      {
          $query = $this->db->query("select i.*,c.currency_symbol AS currency_type,u.name,u.mobile_no,u.country_code FROM `invoice` AS i INNER JOIN `currency_setting` AS c ON i.operator_pub_id ='".$operator_pub_id."' AND ( i.invoice_status='3' OR i.invoice_status='1' ) AND c.status=1 INNER JOIN `users` AS u ON u.user_pub_id =i.user_pub_id ORDER BY i.id DESC");
      }
      else
      {
          $query = $this->db->query("select i.*,c.currency_symbol AS currency_type,u.name,u.mobile_no,u.country_code FROM `invoice` AS i INNER JOIN `currency_setting` AS c ON i.chef_pub_id ='".$operator_pub_id."' AND ( i.invoice_status='3' OR i.invoice_status='1' ) AND c.status=1 INNER JOIN `users` AS u ON u.user_pub_id =i.user_pub_id ORDER BY i.id DESC");
      }
      return $query->result(); 
    }

    public function getDataBetween($table,$start_date,$end_date)
    {
      $query =  $this->db->query("SELECT * FROM ".$table."  WHERE `created_at` BETWEEN ".$start_date." AND ".$end_date);
       return $query->result();
    }

    public function getInvoiceWhere($table,$where='',$start_date,$end_date)
    {
      if($where !='')
      {
        $this->db->where($where);
      }
      $this->db->where('created_at >=', $start_date);
      $this->db->where('created_at <=', $end_date);
      $this->db->select("*");
      $this->db->from($table);
      $query = $this->db->get();     
      return $query->result();
    }

    public function getDataBetweenItem($table,$pro_pub_id,$start_date,$end_date)
    {
      $query =  $this->db->query("SELECT * FROM ".$table."  WHERE pro_pub_id='".$pro_pub_id."' AND `created_at` BETWEEN ".$start_date." AND ".$end_date);
       return $query->result();
    }

    public function getSumBetween($table,$start_date,$end_date)
    {
      $query =  $this->db->query("select sum(final_price) as amt FROM ".$table."  WHERE `created_at` BETWEEN ".$start_date." AND ".$end_date);
       return $query->row();
    }

    public function getSumAll($table)
    {
      $query =  $this->db->query("select sum(final_price) as amt FROM ".$table);
       return $query->row();
    }

    public function getTodaySum($table)
    {
      $date  = strtotime(date("Y-m-d"))*1000;
      $query =  $this->db->query("select sum(final_price) as amt FROM ".$table."  WHERE `created_at` BETWEEN ".$date." AND ".time()*1000);
       return $query->row();
    }

    public function getOrderData($operator_pub_id)
    {
      $query =  $this->db->query("select m.price,Pb.*,Pb.quantity*m.price AS total_price,CONCAT( '".base_url()."',  m.photo) AS photo FROM `product_basket` AS Pb JOIN `menu` AS m ON m.menu_pub_id = Pb.menu_pub_id WHERE  Pb.operator_pub_id='".$operator_pub_id."'");
       return $query->result();
    }

    public function getMenuWithProduct($menu_pub_id)
    {
      $query =  $this->db->query("select * FROM menu WHERE is_countable ='true' AND product_pub_id !='' AND menu_pub_id='".$menu_pub_id."'");
       return $query->row();
    }

    public function getOrderInfoV2($invoice_pub_id)
    {
      $query =  $this->db->query("select i.*,od.quantity,od.menu_pub_id,c.currency_symbol AS currency_type,CONCAT( '".base_url()."',  m.photo) AS photo,m.menu_name,m.price,fc.cat_name,u.name,u.mobile_no,u.country_code  FROM `invoice` AS i  INNER JOIN `orders` AS od ON od.invoice_pub_id = i.invoice_pub_id INNER JOIN `menu` AS m ON m.menu_pub_id = od.menu_pub_id INNER JOIN `food_cat` AS fc ON fc.id = m.cat_id INNER JOIN `users` AS u ON u.user_pub_id =i.user_pub_id INNER JOIN `currency_setting` AS c WHERE i.invoice_pub_id ='".$invoice_pub_id."' AND c.status=1");
       return $query->result();
    }

    public function getProductsByCompany($company_id)
    {
      $query =  $this->db->query("select p.*,m.meas_title FROM `product_info` AS p INNER JOIN `measurement_info` AS m ON m.meas_pub_id =p.meas_pub_id WHERE `company_id`=".$company_id);
       return $query->result();
    }

    public function getDataBetweenDay($table)
    {
      $date  = strtotime(date("Y-m-d"))*1000;
      $date1  = strtotime(date('Y-m-d',strtotime("-1 days")))*1000;

      $query =  $this->db->query("SELECT * FROM ".$table."  WHERE `created_at` BETWEEN ".$date1." AND ".$date);
       return $query->result();
    }

    public function getSumByDate($table,$date,$date1)
    {
      $query =  $this->db->query("SELECT purchase_date as DATE, SUM(`final_price`) AS total, SUM(`tax`) AS totalTax, SUM(`sub_total`) AS totalSub FROM ".$table." WHERE created_at BETWEEN '".$date."' AND '".$date1."' GROUP BY  purchase_date");
       return $query->result();
    }

     public function getInvoiceReport($table,$company_id,$date,$date1)
    {
      $query =  $this->db->query("SELECT purchase_date as DATE, SUM(`final_price`) AS total, SUM(`tax`) AS totalTax, SUM(`sub_total`) AS totalSub FROM ".$table." WHERE company_id=".$company_id." AND created_at BETWEEN '".$date."' AND '".$date1."' GROUP BY  purchase_date");
       return $query->result();
    }

    public function getSumByDateInvoice($table,$date,$date1)
    {
      $query =  $this->db->query("SELECT  invoice_date as DATE, SUM(`final_price`) AS total, SUM(`tax`) AS totalTax, SUM(`total_price`) AS totalSub FROM ".$table." WHERE created_at BETWEEN '".$date."' AND '".$date1."' GROUP BY  invoice_date");
       return $query->result();
    }

    public function getSumByDateOrders($table,$menu_pub_id,$date,$date1)
    {
      $query =  $this->db->query("SELECT  order_date as DATE, SUM(`quantity`) AS quantity, SUM(`total_price`) AS totalSub,menu_pub_id  FROM ".$table." WHERE menu_pub_id =".$menu_pub_id."  AND created_at BETWEEN '".$date."' AND '".$date1."' GROUP BY  order_date");
       return $query->result();
    }
    
    /*Get All data with Limit*/
      public function getAllBetween($first_date,$second_date,$table)
      {
          $this->db->select("*");
          $this->db->where('created_at <=', $first_date);
          $this->db->where('created_at >=', $second_date);
          $this->db->from($table);
          $this->db->order_by('id', 'desc');
          $query = $this->db->get();          
          return $query->result();
      }
  }       