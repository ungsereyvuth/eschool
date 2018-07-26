<?php
class register{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;	$goto_url = '';
		
		$result = false;$msg=$layout_label->message->reg_failed->icon.' '.$layout_label->message->reg_failed->title;
		$err_fields=array();$uploaded_files=array();	
		
		$enable_registration = web_config('enable_registration');
		
		if(!$enable_registration){
			$msg=$layout_label->message->reg_disable->icon.' '.$layout_label->message->reg_disable->title;
			echo json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields,'url'=>$goto_url));exit;
		}
		//get post data
		$_POST['agreed_terms']=isset($_POST['agreed_terms'])?1:0;
		$reg_fields = array('text'=>array('fullname_kh'=>addslashes($_POST['fullname_kh']),'fullname_en'=>addslashes($_POST['fullname_en']),'gender'=>addslashes($_POST['gender']),'dob'=>addslashes($_POST['dob']),'nationality'=>addslashes($_POST['nationality']),'id_card'=>addslashes($_POST['id_card']),'passport'=>addslashes($_POST['passport']),'address'=>addslashes($_POST['address']),'homeno'=>addslashes($_POST['homeno']),'street'=>addslashes($_POST['street']),'group'=>addslashes($_POST['group']),'mobile'=>addslashes($_POST['mobile']),'username'=>addslashes($_POST['username']),'password'=>addslashes($_POST['password']),'confirm_password'=>addslashes($_POST['confirm_password']),'agreed_terms'=>addslashes($_POST['agreed_terms']),'captcha'=>addslashes($_POST['captcha'])),
							'email'=>array('email'=>addslashes($_POST['email'])),
							'file'=>array());
		
		//passport/id card optional
		$passport_idcard = $reg_fields['text']['id_card']<>''?'passport':($reg_fields['text']['passport']<>''?'id_card':'');
		
		$opt_fields = array('homeno','street','group');
		if($passport_idcard<>''){$opt_fields[]=$passport_idcard;}
		$err_fields=validateForm($reg_fields,$opt_fields);	
			
		if(!count($err_fields)){
			//check if check agree term
			if(!$reg_fields['text']['agreed_terms']){
				$err_fields[]=array('name'=>'agreed_terms','msg'=>$layout_label->message->must_agree_term->title);
			}
			
			//check valid email
			foreach($reg_fields['email'] as $key=>$value){if(!in_array($key,$opt_fields)){if(!filter_var($value, FILTER_VALIDATE_EMAIL)){$err_fields[]= array('name'=>$key,'msg'=>$layout_label->message->invalid_email->title);}}}
			//check if account email alr exists
			$email_exist = $qry->qry_assoc("SELECT * FROM users where email='".$reg_fields['email']['email']."' limit 1");
			if(count($email_exist)){$err_fields[]=array('name'=>'email','msg'=>$layout_label->message->email_exist->title);}
			//check if username in latin
			$username=$reg_fields['text']['username'];
			if (strlen($username) != strlen(utf8_decode($username))){
				$err_fields[]=array('name'=>'username','msg'=>$layout_label->message->latin_char->title);
			}else{
				//check if username exists
				if(!filter_var($username, FILTER_VALIDATE_EMAIL)){
					$exist = $qry->qry_assoc("SELECT * FROM users where username='".$username."' limit 1");
					if(count($exist)){$err_fields[]=array('name'=>'username','msg'=>$layout_label->message->username_exist->title);}
				}else{$err_fields[]=array('name'=>'username','msg'=>$layout_label->message->invalid_username->title);}
			}
			//check password match
			if(strlen($reg_fields['text']['password'])>=6){
				if($reg_fields['text']['password'] <> $reg_fields['text']['confirm_password']){
					$err_fields[]=array('name'=>'confirm_password','msg'=>$layout_label->message->confirm_pwd_failed->title);
				}
			}else{$err_fields[]=array('name'=>'password','msg'=>$layout_label->message->pwd_length_failed->title);}
			
			//check if captcha matched
			if (!is_session_started()) session_start(); //echo $_SESSION['captcha'];
			if(isset($_SESSION['captcha'])){
				if($_SESSION['captcha']<>$reg_fields['text']['captcha']){$err_fields[]= array('name'=>'captcha','msg'=>$layout_label->message->wrong_code->title);}
			}else{$err_fields[]= array('name'=>'captcha','msg'=>$layout_label->message->wrong_code->title);}			
		
			/*foreach($reg_fields['file'] as $key=>$value){
				//check allowed file type		
				if($value["type"]<>''){
					$allowed_file = allowed_file($value);
					if(!$allowed_file['result']){$err_fields[]=array('name'=>$key,'msg'=>$allowed_file['msg']);}
				}else{$err_fields[]=array('name'=>$key,'msg'=>$layout_label->message->no_file->title);}			
			}
			if(!count($err_fields)){	
				$docPath = web_config('post_doc_path');	$profilePath = web_config('profile_pic_path');
				foreach($reg_fields['file'] as $key=>$value){
					if($key=='photo'){$filePath =$profilePath;}else{$filePath =$docPath;}
					$file_prefix = $key;
					$upload_result = upload($filePath,$value,$file_prefix);
					if($upload_result){$uploaded_files[$key]=$upload_result;}else{$err_fields[]=array('name'=>$key,'msg'=>$layout_label->message->upload_failed->title);}
				}
			}*/
		}	
		
		//create account
		if(!count($err_fields)){
			$datetime = date("Y-m-d H:i:s");$more_data='';
			$encryptedPWD = encodeString($reg_fields['text']['password'],$encryptKey);
			$need_confirm = web_config('reg_mail_confirm');	
			if($need_confirm){$pending = "pending=1,";}else{$pending = "pending=0,";}
			//create user
			$account_id = $qry->insert("insert into users set
										role_id=3,
										fullname_kh='".$reg_fields['text']['fullname_kh']."',
										fullname_en='".$reg_fields['text']['fullname_en']."',
										gender='".$reg_fields['text']['gender']."',
										dob='".$reg_fields['text']['dob']."',
										nationality='".$reg_fields['text']['nationality']."',	
										id_card='".$reg_fields['text']['id_card']."',	
										passport='".$reg_fields['text']['passport']."',	
										address='".$reg_fields['text']['address']."',	
										homeno='".$reg_fields['text']['homeno']."',	
										street='".$reg_fields['text']['street']."',	
										groupno='".$reg_fields['text']['group']."',	
										mobile='".$reg_fields['text']['mobile']."',	
										email='".$reg_fields['email']['email']."',	
										username='".$reg_fields['text']['username']."',								
										password='".$encryptedPWD."',
										$pending								
										created_date='$datetime'");
			
			//if need email confirm, make acc pending awaiting for verification	
			$goto_url = '/'.$lang->selected.$layout_label->label->register_confirm->url;	
			if($need_confirm){
				$activate_link = 'http://'.$_SERVER['HTTP_HOST'].'/'.$lang->selected.$layout_label->label->register_activation->url.'/'.encodeString($account_id.'_'.time(),$encryptKey);
				$fullname = $reg_fields['text']['fullname_en'];
				$data = array('name'=>$fullname,'url'=>'<a href="'.$activate_link.'">'.$activate_link.'</a>');
				$template_data = mailContent('register',$data);
				sendMail($reg_fields['email']['email'],$template_data['subject'],$template_data['content']);
	
			}else{$goto_url .= '/done';}
			
			if($account_id>0){
				//add to user log			
				adduserlog($_POST['cmd'],$account_id);
				$result = true;$msg=$layout_label->message->reg_success->icon.' '.$layout_label->message->reg_success->title;;
			}
		}	
		echo json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields,'url'=>$goto_url));
	}	
}	



?>