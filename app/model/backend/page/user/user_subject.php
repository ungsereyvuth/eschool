<?php
class user_subject{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey,$layout_label;$breadcrumb=array();$pageExist=false;


		//assign var


		if(!isset($input[0]) or !is_numeric(decodeString($input[0],$encryptKey))){
			goto returnStatus;
		}else{$subject_id=decodeString($input[0],$encryptKey);}

		$subject_info = $qry->qry_assoc("select s.*,c.id course_id, c.title course_title,u.fullname_kh,u.photo from es_course_subject s 
										left join es_course c on c.id=s.course_id
										left join users u on u.id=c.teacher_id
										where s.id=$subject_id and s.active=1 and c.active=1 and u.active=1");
		if(!count($subject_info)){goto returnStatus;}
		$subject_info= (object) $subject_info[0];

		//get all lessons
		$lessons = $qry->qry_assoc("select * from es_lesson l where l.subject_id=$subject_info->id and l.active=1");

		
		$breadcrumb = array('user_coursemgmt',
							array('title'=>$subject_info->course_title,'url'=>$layout_label->label->user_course->url.'/'.encodeString($subject_info->course_id,$encryptKey)),
							array('title'=>$subject_info->title,'url'=>'#'));

		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'lessons'=>$lessons,'subject_info'=>$subject_info);
	}	
}
?>