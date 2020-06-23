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
	//header('Content-Type: application/json');
	public function index()
	{
		//API version
		$arr = array('version'=>VERSION, 'update'=>UPDATE_DATE);    

	   //print json
	    echo json_encode( $arr );
	
	}
	
	public function send_email($saveConfig)
	{
		//get mail provided for user
		$to_email = $saveConfig['email_user'];
		
		//no email address, no email to send
		if(empty($to_email))
			return false;

		$subject = "Reporte Configuración Android";

		//load view before send
		$mesg = $this->load->view('send_email',$saveConfig,true);

		//Config for clients read the email
		$config=array(
			'charset'=>'utf-8',
			'wordwrap'=> TRUE,
			'mailtype' => 'html'
		);

		//very clear
		$this->email->initialize($config);
		
		//prepare email
		$this->email->to($to_email);
		$this->email->from(EMAIL_FROM, "Configuración Android");
		$this->email->subject($subject);
		$this->email->message($mesg);

		//send email
		$mail = $this->email->send();
	}


	public function save_file($saveConfig){
		
		$fileSave = false;

		$file_name = $saveConfig['hash_encode'];

		//no file name, can't save
		if(empty($file_name))
			return $fileSave;
		
		$file = $this->load->view('xccdf_file',$saveConfig,true);
     	
     	$strSave = "./public/files/".$file_name.".xccdf";
	    
	    if ( ! write_file($strSave, $file)){
	            $fileSave = true;
	    }
	    
	    return $fileSave;
	}


	public function process(){

		$entro = false;

		//is POST method
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			
    	 	//silly unique hascode
    	 	$id = 1000000+$this->device_config_model->last_id()+1;
			$hash_encode = base_convert($id, 10, 36);

		    //get hash_encode
		    //echo intval($str,36);
			//$array = false;

			//get variables coming from request/app
		    $created_date = date('Y-m-d H:i:s'); //get system date
		    $updated_date = date('Y-m-d H:i:s'); // get system date
		    $email_user = 0; //declare false
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
		            
		            $arrayConfig = $post_data; //$arrayPost['config'][0];
	             	
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
	             	$text_show_password = $arrayConfig['text_show_password'];
	             	$screen_off_timeout = $arrayConfig['screen_off_timeout']/60000;
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
	             	$this->save_file($saveConfig);

	             	$saveInfo = array('config' => json_encode($saveConfig),'hash_encode'=>$hash_encode);

				    //save teh info in DataBase
	             	$this->device_config_model->insert( $saveInfo );


		        }


		    }

    	 	$data = array(
		        'entro'=>$entro,
		        'hash_encode' => $hash_encode
		        //'created_date' => $created_date,
		        //'updated_date' => $updated_date
			);
			
		//data send to the app
		echo json_encode($data);

		} else  {
			//nothing
		}
		
	}

	/*
	public function file(){
		$file_name = 'name';

		$saveConfig = array('data'=>'data');

		$file = $this->load->view('xccdf_file',$saveConfig,true);
     	$fileSave= false;
     	$strSave = "./public/files/".$file_name.".xccdf";
	    
	    if ( ! write_file($strSave, $file)){
	            $fileSave = true;
	    }
	}*/

	//view 
	public function view($code=null){
		
		if(isset($code) && !empty($code)){
			//fetch info by code
			$record  = $this->device_config_model->get_record($code);
			
			if($record == null ){
				echo "Consulta incompleta";
				exit();
		}
	
			$config = json_decode( $record->config );// json_decode($record->config);

			if(isset($config) ){

				$this->load->view('send_email',$config );
				//echo $config;
				//print_r($record->config);
			}

		}else{
			echo "Consulta incompleta";
			exit();
		}
		
	}

	//method donwload the file
	public function download($id=null){
		if(!is_null($id) && !empty($id) ){

			$file = "./public/files/".$id.".xccdf";
			force_download($file, NULL);
		}else{
			echo "Consulta incompleta";
			exit();
		}
	}

}