<?php
class user_addquestion{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey,$layout_label;$breadcrumb=array();$pageExist=false;

		$lesson_info=$search_inputs='';$qtype_opt='';

		if(!isset($input[0])){
			goto returnStatus;
		}
		$lesson_id=decodeString($input[0],$encryptKey);

		//check subject availability
		$lesson_info = $qry->qry_assoc("select l.id lesson_id,l.title lesson_title,s.id subject_id,s.title subject_title,c.title course_title,c.id course_id from es_lesson l 
										left join es_course_subject s on s.id=l.subject_id
										left join es_course c on c.id=s.course_id
										where l.id=$lesson_id and l.active=1 and s.active=1 and c.teacher_id=".$usersession->info()->id." and c.active=1");
		if(!count($lesson_info)){goto returnStatus;}
		$lesson_info=(object) $lesson_info[0];
		//get ordering number
		$ordering=1;
		$q_info = $qry->qry_assoc("select ordering from es_question where lesson_id=$lesson_id order by ordering desc limit 1");
		if(count($q_info)){$ordering+=$q_info[0]['ordering'];}

		//question type
		$qtype_opt_input='';
		$q_type = $qry->qry_assoc("select * from es_question_type where active=1 order by id asc");
		foreach ($q_type as $key => $value) {
			$qtype_opt.='<option value="'.$value['id'].'">'.$value['title'].'</option>';
		}
		$qtype_opt_input='<div class="col-sm-6 col-md-3"><select class="input-sm searchinputs" id="type_id">
								<option value="">'.$layout_label->label->select_option->title.'</option>
								'.$qtype_opt.'
							</select></div>';

		$search_inputs = '<div class="row">'.$qtype_opt_input.'</div>';
		

		$breadcrumb = array('user_coursemgmt',
							array('title'=>$lesson_info->course_title,'url'=>$layout_label->label->user_course->url.'/'.encodeString($lesson_info->course_id,$encryptKey)),
							array('title'=>$lesson_info->subject_title,'url'=>$layout_label->label->user_subject->url.'/'.encodeString($lesson_info->subject_id,$encryptKey)),
							'user_addquestion');



		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'lesson_info'=>$lesson_info,'ordering'=>$ordering,'search_inputs'=>$search_inputs,'qtype_opt'=>$qtype_opt);
	}	
}
?>