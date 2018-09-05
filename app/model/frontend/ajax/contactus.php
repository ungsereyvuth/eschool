<?php
class contactus{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		$result=false;$msg=$layout_label->message->insert_failed->icon.' '.$layout_label->message->insert_failed->title;		$err_fields=array();$datetime = date("Y-m-d H:i:s");
		
		
		
		$reg_fields = array('text'=>array('contact_fullname'=>addslashes($_POST['contact_fullname']),'contact_subject'=>addslashes($_POST['contact_subject']),'message'=>addslashes($_POST['message']),'captcha'=>addslashes($_POST['captcha'])),
						'email'=>array('contact_email'=>addslashes($_POST['contact_email'])),
						'file'=>array());
	
		$opt_fields = array('item_id');
		$temp_fields=array();
		foreach($reg_fields as $value){foreach($value as $sub_key=>$sub_value){$temp_fields[]=$sub_key;}}		
		$required_fields = array_diff($temp_fields,$opt_fields);
		$required_val = array();
		foreach($required_fields as $value){$required_val[$value]=array_key_exists($value,$reg_fields['file'])?$_FILES[$value]:$_POST[$value];}		
		if(in_array('',$required_val)){	
			foreach($required_val as $key=>$value){
				if($value==''){$err_fields[]= array('name'=>$key,'msg'=>$layout_label->message->blank_data->title);}
				if(array_key_exists($key,$reg_fields['file'])){if($reg_fields['file'][$key]['type']==''){$err_fields[]= array('name'=>$key,'msg'=>$layout_label->message->no_file->title);}}
			}	
		}else{
			//check valid email
			foreach($reg_fields['email'] as $key=>$value){if(!in_array($key,$opt_fields)){if(!filter_var($value, FILTER_VALIDATE_EMAIL)){$err_fields[]= array('name'=>$key,'msg'=>$layout_label->message->invalid_email->title);}}}
			
			//check if captcha matched
			if (!is_session_started()) session_start(); //echo $_SESSION['captcha'];
			if(isset($_SESSION['captcha'])){
				if($_SESSION['captcha']<>$reg_fields['text']['captcha']){$err_fields[]= array('name'=>'captcha','msg'=>$layout_label->message->wrong_code->title);}
			}else{$err_fields[]= array('name'=>'captcha','msg'=>$layout_label->message->wrong_code->title);}		
		}
		
		//add service
		if(!count($err_fields)){	
			$message_id = $qry->insert("insert into feedback set
										name='".$reg_fields['text']['contact_fullname']."',
										email='".$reg_fields['email']['contact_email']."',
										subject='".$reg_fields['text']['contact_subject']."',
										description='".$reg_fields['text']['message']."',
										created_date='$datetime'");
				
			if($message_id>0){						
				//add to user log			
				adduserlog($_POST['cmd'],$message_id);
				$result = true;$msg=$layout_label->message->insert_success->icon.' '.$layout_label->message->insert_success->title;		
			}
		}	
		
		
		echo json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields));
	}	
}	



?>