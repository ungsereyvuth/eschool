<?php
class user_lessonview{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey;$breadcrumb=array();$pageExist=false;

		//assign var
		$lesson_info=array();

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decodeString($input[0],$encryptKey)); //grade_id,subject_id
			if(count($codes)==2 and $codes[0] and $codes[1]){
				$grade_id=$codes[0];$subject_id=$codes[1];
			}else{goto returnStatus;}			
		}

		$course_info = $qry->qry_assoc("selects c.* from es_course c 
										left join es_course_subject s on s.course_id=c.id and s.grade_subject_id=$subject_id
										left join users u on u.id=c.teacher_id
										left join user_role r on r.id=u.role_id
										where c.grade_id=$grade_id and c.active=1 and r.code='admin' 
										order by created_date desc limit 1"); var_dump($course_info);exit;
		if(!count($lesson_info)){goto returnStatus;}
		$lesson_info=$lesson_info[0];
		
		$breadcrumb = array('user_programview',array('title'=>$grade_info['title'],'url'=>'#'));
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'lesson_info'=>(object) $lesson_info);
	}	
}
?>