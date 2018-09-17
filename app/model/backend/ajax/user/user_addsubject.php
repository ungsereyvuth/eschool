<?php
class user_addsubject{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		$refresh_listname='user_coursemgmt';
		$result = false;$msg=$layout_label->message->insert_failed->icon.' '.$layout_label->message->insert_failed->title;
		$uploaded_files=array();
		//get post data
		$reg_fields = array('text'=>array(	'recordid'=>addslashes($_POST['recordid']),
											'title'=>addslashes($_POST['title']),	
											'grade_subject_id'=>addslashes($_POST['grade_subject_id']),	
											'description'=>addslashes($_POST['description']),	
											'private'=>isset($_POST['private'])?1:0,
											'require_membership'=>isset($_POST['require_membership'])?1:0,
											'active'=>isset($_POST['active'])?1:0),
							'email'=>array(),
							'file'=>array());

		$opt_fields = array('private','require_membership','active','description');
		$err_fields=validateForm($reg_fields,$opt_fields);		
		if(!count($err_fields)){
			$course_id = decodeString($reg_fields['text']['recordid'],$encryptKey);
			if(!is_numeric($course_id) or !$course_id){
				$msg='Invalid data request';
				$err_fields[]= array('name'=>'error','msg'=>$msg);
			}

		}
		if(!count($err_fields)){
			$datetime = date("Y-m-d H:i:s");		
			$sql = "title='".$reg_fields['text']['title']."',
					course_id=$course_id,
					grade_subject_id=".$reg_fields['text']['grade_subject_id'].",
					description='".$reg_fields['text']['description']."',
					private=".$reg_fields['text']['private'].",
					require_membership=".$reg_fields['text']['require_membership'].",
					active=".$reg_fields['text']['active'].",";
			$recordid=$qry->insert("insert into es_course_subject set $sql created_by=".$usersession->info()->id.",created_date='$datetime'");		
			//add to user log			
			adduserlog($_POST['cmd'],$recordid);
			$result = true;$msg=$layout_label->message->insert_success->icon.' '.$layout_label->message->insert_success->title;;
		}	
		return json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields,'refresh_listname'=>$refresh_listname,'url'=>''));	
	}	
}	



?>