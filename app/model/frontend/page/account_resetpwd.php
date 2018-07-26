<?php
class account_resetpwd{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey,$layout_label;
		$pageExist=false;
		$init=true;$reset_code=$msg='';$valid_code=false;
		
		if(count($input)){
			$init=false;
			$reset_code=$input[0];
			$codes=decodeString($reset_code,$encryptKey);
			
			//check if valid reset_code
			$valid_time = 60*web_config('email_link_valid_time');//30min
			$code_parts = json_decode($codes, true);  //format: userid,email,time
			if(count($code_parts)==3){
				$reset_id = $code_parts[0];$reset_email = $code_parts[1];$reset_time = $code_parts[2];$cur_time = time();
				if(is_numeric($reset_id) and filter_var($reset_email, FILTER_VALIDATE_EMAIL) and ($cur_time-$reset_time<=$valid_time)){
					$checkuser = $qry->qry_count("SELECT * FROM users where id=$reset_id and email='$reset_email' and pending=0 and active=1 limit 1");
					if(!$checkuser){$msg=$layout_label->message->invalid_data->icon.' '.$layout_label->message->invalid_data->title;}
					else{$valid_code=true;}
				}else{$msg=$layout_label->message->invalid_expired->icon.' '.$layout_label->message->invalid_expired->title;}
			}else{$msg=$layout_label->message->invalid_data->icon.' '.$layout_label->message->invalid_data->title;}
		}
		
		//get note
		$content = content(array('reset_pwd_note'));
		
		$pageExist=true;
		
		
		returnStatus:
		return array('pageExist'=>$pageExist,'init'=>$init,'reset_code'=>$reset_code,'valid_code'=>$valid_code,'msg'=>$msg,'note'=>(object) $content['reset_pwd_note']);
	}	
}
?>