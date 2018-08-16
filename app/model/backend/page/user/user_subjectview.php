<?php
class user_subjectview{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey;$breadcrumb=array();$pageExist=false;

		//assign var
		$subject_info=array();

		if(!isset($input[0]) or !is_numeric(decodeString($input[0],$encryptKey))){
			goto returnStatus;
		}else{$grade_id=decodeString($input[0],$encryptKey);}

		$grade_info = $qry->qry_assoc("select * from es_grade where id=$grade_id limit 1");
		if(!count($grade_info)){goto returnStatus;}
		$grade_info=$grade_info[0];
		$subject_info = $qry->qry_assoc("select s.* from es_grade_subject s 
										where s.id IN (".$grade_info['subject_ids'].") and s.active=1");
		if(!count($subject_info)){goto returnStatus;}
		
		$breadcrumb = array('user_programview',array('title'=>$grade_info['title'],'url'=>'#'));
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'grade_id'=>$grade_id,'subject_info'=>(object) $subject_info);
	}	
}
?>