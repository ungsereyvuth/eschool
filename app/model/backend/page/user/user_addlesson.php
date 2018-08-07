<?php
class user_addlesson{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey,$layout_label;$breadcrumb=array();$pageExist=false;

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decodeString($input[0],$encryptKey));
			$addmain = count($codes)==2?false:true;
			if(!$addmain and (!$codes[0] or !$codes[1])){
				goto returnStatus;
			}elseif($addmain and !$codes[0]){
				goto returnStatus;
			}
			$subject_id=$codes[0];
			$parent_id = !$addmain?$codes[1]:0;
		}

		//check subject availability
		$subject_info = $qry->qry_assoc("select s.id subject_id,s.title subject_title,c.title course_title,c.id course_id from es_course_subject s 
										left join es_course c on c.id=s.course_id
										where s.id=$subject_id and s.active=1 and c.teacher_id=".$usersession->info()->id." and c.active=1");
		if(!count($subject_info)){goto returnStatus;}
		$subject_info=(object) $subject_info[0];
		//lesson
		//$lesson_info = $qry->qry_assoc("select * from es_course");

		$breadcrumb = array('user_coursemgmt',
							array('title'=>$subject_info->course_title,'url'=>$layout_label->label->user_course->url.'/'.encodeString($subject_info->course_id,$encryptKey)),
							array('title'=>$subject_info->subject_title,'url'=>$layout_label->label->user_subject->url.'/'.encodeString($subject_info->subject_id,$encryptKey)),
							'user_addlesson');



		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb);
	}	
}
?>