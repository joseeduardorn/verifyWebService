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
	
	public function send_email($saveConfig)
	{
		$email_user = $saveConfig['email_user'];
		/*
		$saveConfig = array(
     		'email_user'=>'email@email.com',
     		'device_android_version'=>'version 8',
     		'device_android_sdk'=>'sdk',
     		'device_secure'=>true,
     		'bluetooth'=>true,
     		'nfc'=>true,
     		'gps'=>false,
     		'wifi_hostpot'=>true,
     		'power_save'=>false,
     		'airplane_mode'=>false,
     		'voice_assistant'=>true,
     		'touched_sound'=>false,
     		'haptic_feedback'=>false,
     		'lock_screen_sounds'=>true,
     		'screen_off_timeout'=>'time in second',
     		'text_show_password'=>true,
     		'lock_screen_after'=>'time in second',
     		'device_name'=>'android',
     		'bluetooth_name'=>'name bluetooth',
     		'dhcp_info'=>'9.8.9.9',
     		'hash_encode' => 'dfas',
    		'created_date' => date('Y-m-d H:i:s'),
    		'updated_date' => date('Y-m-d H:i:s'),
    		'file_save' => true
     	);*/
		//$this->load->view('send_email',$saveConfig);
		//$this->load->library('email');
		$fromemail="yourconfig@verify.wuhs.info";
		$toemail = $email_user;
		$subject = "Reporte Configuración Android";
		//$data=array();
		// $mesg = $this->load->view('template/email',$data,true);
		// or
		//$mesg = $this->load->view('template/email','',true);
		$mesg = $this->load->view('send_email',$saveConfig,true);

		$config=array(
		'charset'=>'utf-8',
		'wordwrap'=> TRUE,
		'mailtype' => 'html'
		);

		$this->email->initialize($config);
		//$this->email->set_header('MIME-Version', '1.0; charset=utf-8');
		//$this->email->set_header('Content-type', 'text/html');
		$this->email->to($toemail);
		$this->email->from($fromemail, "Configuración Android");
		$this->email->subject($subject);
		$this->email->message($mesg);
		$mail = $this->email->send();
		//echo $mesg = $this->load->view('send_email',$saveConfig,true);
	}

	public function save_file($saveConfig){
		$file_name = $saveConfig['hash_encode'];
		$file = 'Some file data';
     	$fileSave= false;
     	$strSave = "./public/files/".$file_name.".xccdf";
	    
	    if ( ! write_file($strSave, $file)){
	            $fileSave = true;
	    }
	   // return $fileSave;
	}

	public function process(){

		$entro = false;
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
		    $nfc = null;
		    $gps = null;
		    $wifi_hostpot = null;
		    $power_save = null;
		    $airplane_mode = null;
		    $voice_assistant = null; //name
		    $touched_sound = null;
		    $dtmf_tone = null;
		    $haptic_feedback = null;
		    $lock_screen_sounds = null;
		    $screen_off_timeout = null;
		    $text_show_password = null;
		    $lock_screen_after = null;
		    //names
		    $device_name = null;
		    $bluetooth_name = null;
		    $dhcp_info = null;


		    $post_data = json_decode(file_get_contents('php://input'), true);
		    
		    if(isset( $post_data['email_user']) ){
		    	$entro = $post_data['email_user'];
		    }
		   /* if(json_last_error() == JSON_ERROR_NONE)
		    {
		        $entro = $post_data;
		    }*/


		  //  if(isset( $_POST['config'] ) ){
		    if(isset( $post_data['email_user'] ) ){
		    	$entro = true;
		        //$array=true;
		       // $arrayPost = json_decode($_POST['config'],true);
		        
		        if (isset( $post_data ['device_android_version'] )) {
		            
		            $arrayConfig = $post_data;//$arrayPost['config'][0];
	             	
	             	$email_user = $arrayConfig['email_user'];
	             	$device_android_version = $arrayConfig['device_android_version'];
	             	$device_android_sdk = $arrayConfig['device_android_sdk'];
	             	//flags true or false
	             	$device_secure = $arrayConfig['device_secure'];
	             	$bluetooth = $arrayConfig['bluetooth'];
	             	$nfc = $arrayConfig['nfc'];
	             	$gps = $arrayConfig['gps'];
	             	$wifi_hostpot = $arrayConfig['wifi_hostpot'];
	             	$power_save = $arrayConfig['power_save'];
	             	$airplane_mode = $arrayConfig['airplane_mode'];
	             	$voice_assistant = $arrayConfig['voice_assistant'];
	             	$touched_sound = $arrayConfig['touched_sound'];
	             	$dtmf_tone = $arrayConfig['dtmf_tone'];
	             	$haptic_feedback = $arrayConfig['haptic_feedback'];
	             	$lock_screen_sounds = $arrayConfig['lock_screen_sounds'];
	             	$screen_off_timeout = $arrayConfig['screen_off_timeout']/1000;
	             	$lock_screen_after = $arrayConfig['lock_screen_after']/1000;
	             	//strings
	             	$device_name = $arrayConfig['device_name'];
	             	$bluetooth_name = $arrayConfig['bluetooth_name'];
	             	$dhcp_info = $arrayConfig['dhcp_info'];

	             	$saveConfig = array(
	             		'email_user'=>$email_user,
	             		'device_android_version'=>$device_android_version,
	             		'device_android_sdk'=>$device_android_sdk,
	             		'device_secure'=>$device_secure,
	             		'bluetooth'=>$bluetooth,
	             		'nfc'=>$nfc,
	             		'gps'=>$gps,
	             		'wifi_hostpot'=>$wifi_hostpot,
	             		'power_save'=>$power_save,
	             		'airplane_mode'=>$airplane_mode,
	             		'voice_assistant'=>$voice_assistant,
	             		'touched_sound'=>$touched_sound,
	             		'dtmf_tone'=>$dtmf_tone,
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
		        		'updated_date' => $updated_date
	             	);

	             	$this->send_email($saveConfig);
	             	//$this->save_file($saveConfig);

	             	$saveInfo = array('config' => json_encode($saveConfig),'hash_encode'=>$hash_encode);

				    //save teh info in DataBase
	             	//$this->device_config_model->insert( $saveInfo );


		        }
		        //$device_android_version = $arrayPost['device_android_version'];
		    }

    	 	$data = array(
		       // 'config' => $arrayPost,
		        //'user_email' => $user_email,
		        'entro'=>$entro,
		        'hash_encode' => $hash_encode
		        //'created_date' => $created_date,
		        //'updated_date' => $updated_date
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