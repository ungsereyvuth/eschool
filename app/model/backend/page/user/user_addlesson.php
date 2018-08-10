<?php
class user_addlesson{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey,$layout_label;$breadcrumb=array();$pageExist=false;

		$chapter_info='';

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
		if($parent_id){
			$chapter_info = $qry->qry_assoc("select * from es_lesson where id=$parent_id and active=1 limit 1");
			if(!count($chapter_info)){goto returnStatus;}
			$chapter_info=(object) $chapter_info[0];
		}
		//get ordering number
		$ordering=1;
		$lesson_info = $qry->qry_assoc("select ordering from es_lesson where subject_id=$subject_id and ".($addmain?"parent_id is NULL":"parent_id = $parent_id")." order by ordering desc limit 1");
		if(count($lesson_info)){$ordering+=$lesson_info[0]['ordering'];}
		

		$breadcrumb = array('user_coursemgmt',
							array('title'=>$subject_info->course_title,'url'=>$layout_label->label->user_course->url.'/'.encodeString($subject_info->course_id,$encryptKey)),
							array('title'=>$subject_info->subject_title,'url'=>$layout_label->label->user_subject->url.'/'.encodeString($subject_info->subject_id,$encryptKey)),
							'user_addlesson');



		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'subject_info'=>$subject_info,'codes'=>$input[0],'addmain'=>$addmain,'chapter_info'=>$chapter_info,'ordering'=>$ordering);
	}	
}
?>