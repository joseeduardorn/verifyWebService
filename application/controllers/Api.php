<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	//$this->load->view('welcome_message');
	$arr = array('version'=>1, 'update'=>'November 2019');    

   //add the header here
   	//header('Content-Type: application/json');
    echo json_encode( $arr );
	
	}
	
	public function pro(){
	    $arr = array('version'=>1, 'update'=>'November 2019');
	    $value = false;
	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	        $value = true;
	    }else{
	        $value = false;
	    }
	    
	    $arrayPOst = json_decode($_POST['config'],true);
	    
	    $data = array(
		        //'config' => $arrayPOst,
		        //'user_email' => $user_email,
		        'post' => $value,
		        'hash_encode' => "HASH",
		        'created_date' => date('Y-m-d H:i:s'),
		        'updated_date' => date('Y-m-d H:i:s')
			);
			
		echo json_encode($arrayPOst);
	}

	public function process(){

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    	 	//$config = $this->input->post('config');
    	    //	$user_email = $this->input->post('user_email');

    	 	$id = 1000000+$this->device_config_model->last_id()+1;
			$hash_encode = base_convert($id, 10, 36);
		    //get hash_encode
		    //echo intval($str,36);
		    $array = false;
		    $created_date = date('Y-m-d H:i:s');
		    $updated_date = date('Y-m-d H:i:s');
		    $email_user = 0;
		    $device_android_version = 0;
		    $device_android_sdk = null;
		    $device_secure = null;
		    $bluetooth = null;
		    $ncf = null;
		    $gps = null;
		    $wifi_hostpot = null;
		    $power_save = null;
		    $airplane_mode = null;
		    $voice_assistant = null;
		    $touched_sound = null;
		    $dtmf_tone = null;
		    $haptic_feedback = null;
		    $lock_screen_sounds = null;
		    $screen_off_timeout = null;
		    $text_show_password = null;
		    $lock_screen_after = null;
		    $device_name = null;
		    $bluetooth_name = null;
		    $dhcp_info = null;
		
		    if(isset( $_POST['config'] ) ){
		        $array=true;
		        $arrayPost = json_decode($_POST['config'],true);
		        
		        if (is_array( $arrayPost['config'] )) {
		            
		            $arrayConfig = $arrayPost['config'][0];
	             	
	             	$email_user = $arrayConfig['email_user'];
	             	$device_android_version = $arrayConfig['device_android_version'];
	             	$device_android_sdk = $arrayConfig['device_android_sdk'];
	             	$device_secure = $arrayConfig['device_secure'];
	             	$bluetooth = $arrayConfig['bluetooth'];
	             	$ncf = $arrayConfig['ncf'];
	             	$gps = $arrayConfig['gps'];
	             	$wifi_hostpot = $arrayConfig['wifi_hostpot'];
	             	$power_save = $arrayConfig['power_save'];
	             	$airplane_mode = $arrayConfig['airplane_mode'];
	             	$voice_assistant = $arrayConfig['voice_assistant'];
	             	$touched_sound = $arrayConfig['touched_sound'];
	             	$dtmf_tone = $arrayConfig['dtmf_tone'];
	             	$haptic_feedback = $arrayConfig['haptic_feedback'];
	             	$lock_screen_sounds = $arrayConfig['lock_screen_sounds'];
	             	$screen_off_timeout = $arrayConfig['screen_off_timeout'];
	             	$lock_screen_after = $arrayConfig['lock_screen_after'];
	             	$device_name = $arrayConfig['device_name'];
	             	$bluetooth_name = $arrayConfig['bluetooth_name'];
	             	$dhcp_info = $arrayConfig['dhcp_info'];

	             	$file = 'Some file data';
	             	$fileSave= false;
				    if ( ! write_file('./public/files/file.xccdf', $file)){
				            $fileSave = true;
				    }

	             	$saveConfig = array(
	             		'email_user'=>$email_user,
	             		'device_android_version'=>$device_android_version,
	             		'device_android_sdk'=>$device_android_sdk,
	             		'device_secure'=>$device_secure,
	             		'bluetooth'=>$bluetooth,
	             		'ncf'=>$ncf,
	             		'gps'=>$gps,
	             		'wifi_hostpot'=>$wifi_hostpot,
	             		'power_save'=>$power_save,
	             		'airplane_mode'=>$airplane_mode,
	             		'voice_assistant'=>$voice_assistant,
	             		'touched_sound'=>$touched_sound,
	             		'haptic_feedback'=>$haptic_feedback,
	             		'lock_screen_sounds'=>$lock_screen_sounds,
	             		'screen_off_timeout'=>$screen_off_timeout,
	             		'text_show_password'=>$text_show_password,
	             		'lock_screen_after'=>$lock_screen_after,
	             		'device_name'=>$device_name,
	             		'bluetooth_name'=>$bluetooth_name,
	             		'dhcp_info'=>$dhcp_info,
	             		'hash_encode' => $hash_encode,
		        		'created_date' => $created_date,
		        		'updated_date' => $updated_date,
		        		'file_save' => $fileSave
	             	);

	             	$saveInfo = array('config' => json_encode($saveConfig),'hash_encode'=>$hash_encode);

				    //save teh info in DataBase
	             	//$this->device_config_model->insert( $saveInfo );


		        }
		        //$device_android_version = $arrayPost['device_android_version'];
		    }

    	 	$data = array(
		       // 'config' => $arrayPost,
		        //'user_email' => $user_email,
		        'array'=>$array,
		        'hash_encode' => $hash_encode,
		        'created_date' => $created_date,
		        'updated_date' => $updated_date
			);
			
		 echo json_encode($data);

		} else  {
		
		//intval($hash_encode,36);
		//print_r($data);
        //$arr = array('version'=>1, 'update'=>'November 2019');
		// echo json_encode($arr);
		//$this->db->insert('device_config', $data);	
		//echo 'Please, send post';
		}
		
	}

}