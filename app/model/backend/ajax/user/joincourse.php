<?php
class joincourse{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		$refresh_listname='user_coursemgmt';
		$result = false;$msg=$layout_label->message->insert_failed->icon.' '.$layout_label->message->insert_failed->title;
		$uploaded_files=array();
		//get post data
		$reg_fields = array('text'=>array(	'recordid'=>($_POST['recordid']),
											'class_id'=>($_POST['class_id']?$_POST['class_id']:'NULL')),
							'email'=>array(),
							'file'=>array());

		$opt_fields = array();
		$err_fields=validateForm($reg_fields,$opt_fields);		
		if(!count($err_fields)){
			$course_id = decodeString($reg_fields['text']['recordid'],$encryptKey);
			if(!is_numeric($course_id) or !$course_id){
				$msg='Invalid data request';
				$err_fields[]= array('name'=>'error','msg'=>$msg);
			}else{
				//check if already join any class of the course
				$isMember = $qry->qry_count("select id from es_course_member where course_id=$course_id and student_id=".$usersession->info()->id." and active=1");
				if($isMember){
					$msg='បានចុះឈ្មោះរួចហើយ';
					$err_fields[]= array('name'=>'error','msg'=>$msg);
				}
			}

		}
		if(!count($err_fields)){
			$datetime = date("Y-m-d H:i:s");		
			$sql = "course_id=$course_id,
					class_id=".$reg_fields['text']['class_id'].",
					student_id=".$usersession->info()->id.",";
			$recordid=$qry->insert("insert into es_course_member set $sql created_by=".$usersession->info()->id.",created_date='$datetime'");		
			//add to user log			
			adduserlog($_POST['cmd'],$recordid);
			$result = true;$msg=$layout_label->message->insert_success->icon.' '.$layout_label->message->insert_success->title;;
		}	
		return json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields,'refresh_listname'=>$refresh_listname,'url'=>''));	
	}	
}	



?>