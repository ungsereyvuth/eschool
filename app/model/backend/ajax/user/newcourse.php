<?php
class newcourse{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		$refresh_listname='user_coursemgmt';
		$result = false;$msg=$layout_label->message->insert_failed->icon.' '.$layout_label->message->insert_failed->title;
		$uploaded_files=array();
		//get post data
		$reg_fields = array('text'=>array(	'recordid'=>addslashes($_POST['recordid']),
											'title'=>addslashes($_POST['title']),	
											'grade_id'=>addslashes($_POST['grade_id']),	
											'school_id'=>addslashes($_POST['school_id']),						
											'max_student'=>addslashes($_POST['max_student']),		
											'description'=>addslashes($_POST['description']),	
											'year'=>addslashes($_POST['year']),	
											'private'=>isset($_POST['private'])?1:0,	
											'active'=>isset($_POST['active'])?1:0),
							'email'=>array(),
							'file'=>array());

		$opt_fields = array('recordid','school_id','private','active','max_student','description');
		$err_fields=validateForm($reg_fields,$opt_fields);				
		//add service
		if(!count($err_fields)){
			$datetime = date("Y-m-d H:i:s");		
			$sql = "title='".$reg_fields['text']['title']."',
					grade_id=".$reg_fields['text']['grade_id'].",
					teacher_id=".$usersession->info()->id.",
					school_id='".$reg_fields['text']['school_id']."',
					max_student='".$reg_fields['text']['max_student']."',	
					description='".$reg_fields['text']['description']."',	
					year='".$reg_fields['text']['year']."',	
					private=".$reg_fields['text']['private'].",			
					active=".$reg_fields['text']['active'].",";
			$recordid=$qry->insert("insert into es_course set $sql created_by=".$usersession->info()->id.",created_date='$datetime'");		
			//add to user log			
			adduserlog($_POST['cmd'],$recordid);
			$result = true;$msg=$layout_label->message->insert_success->icon.' '.$layout_label->message->insert_success->title;;
		}	
		return json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields,'refresh_listname'=>$refresh_listname));	
	}	
}	



?>