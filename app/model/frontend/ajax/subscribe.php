<?php
class subscribe{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		$result = false;$msg=$layout_label->message->insert_failed->icon.' '.$layout_label->message->insert_failed->title;
		$uploaded_files=array();
		//get post data
		$reg_fields = array('text'=>array('subscribe_fullname'=>addslashes($_POST['subscribe_fullname'])),
							'email'=>array('subscribe_email'=>addslashes($_POST['subscribe_email'])),
							'file'=>array());
		
		$opt_fields = array();
		$err_fields=validateForm($reg_fields,$opt_fields);		
		if(!count($err_fields)){		
			//check valid email
			foreach($reg_fields['email'] as $key=>$value){if(!in_array($key,$opt_fields)){if(!filter_var($value, FILTER_VALIDATE_EMAIL)){$err_fields[]= array('name'=>$key,'msg'=>$layout_label->message->invalid_email->title);}}}
			//check if account email alr exists
			$email_exist = $qry->qry_assoc("SELECT id,active FROM subscription where email='".$reg_fields['email']['subscribe_email']."' limit 1");
			if(count($email_exist)){
				if($email_exist[0]['active']){$err_fields[]=array('name'=>'subscribe_email','msg'=>$layout_label->message->email_exist->title);}
				else{$subscribe_id=$email_exist[0]['id'];}
			}
			
		}
		
		//add service
		if(!count($err_fields)){	
			$datetime = date("Y-m-d H:i:s");	
			//insert price
			if(isset($subscribe_id) and $subscribe_id){
				$qry->insert("update subscription set
										name='".$reg_fields['text']['subscribe_fullname']."',
										created_date='$datetime',
										active=1
										where id=$subscribe_id limit 1");
			}else{
				$subscribe_id = $qry->insert("insert into subscription set
										name='".$reg_fields['text']['subscribe_fullname']."',
										email='".$reg_fields['email']['subscribe_email']."',
										created_date='$datetime'");
			}
			
				
			if($subscribe_id){						
				//add to user log			
				adduserlog($_POST['cmd'],$subscribe_id);
				$result = true;$msg=$layout_label->message->subscribe_success->icon.' '.$layout_label->message->subscribe_success->title;			
			}
		}	
		echo json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields));	
	}		
}	



?>