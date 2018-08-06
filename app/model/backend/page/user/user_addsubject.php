<?php
class user_addsubject{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey,$layout_label;
		$pageExist=false;
		
		if(!isset($input[0]) or !is_numeric(decodeString($input[0],$encryptKey))){
			goto returnStatus;
		}else{$course_id=decodeString($input[0],$encryptKey);}
		
		$course_info = $qry->qry_assoc("select c.*,if(c.max_student>0,c.max_student,'∞') max_student,u.fullname_kh,u.photo,count(COALESCE(m.id,NULL)) total_student from es_course c 
										left join es_course_member m on m.course_id=c.id and m.active=1
										left join users u on u.id=c.teacher_id
										where c.id=$course_id and c.active=1 limit 1");
		if(!count($course_info)){goto returnStatus;}
		$course_info= (object) $course_info[0];

		//get standard subject (grade subject)
		$std_subject_opt='';
		$std_subject = $qry->qry_assoc("select * from es_grade_subject where active=1 order by ordering");
		foreach ($std_subject as $key => $value) {
			$std_subject_opt.='<option value="'.$value['id'].'">'.$value['title'].'</option>';
		}

		//get existing subject
		$existing_subjects = $qry->qry_assoc("select s.*,count(COALESCE(l.id,NULL)) total_lesson from es_course_subject s 
													left join es_lesson l on l.subject_id=s.id and l.active=1
													where s.course_id=$course_id and s.active=1 
													group by s.id
													order by s.created_date");

		
		$pageExist=true;


		$breadcrumb = array('user_coursemgmt',
							array('title'=>$course_info->title,'url'=>$layout_label->label->user_course->url.'/'.$input[0]),
							'user_addsubject');

		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'course_info'=>$course_info,'std_subject_opt'=>$std_subject_opt,'existing_subjects'=>$existing_subjects);
	}	
}
?>