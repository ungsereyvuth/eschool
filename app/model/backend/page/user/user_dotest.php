<?php
class user_dotest{
	public function data($input){
		$qry = new connectDb;global $usersession,$layout_label,$encryptKey;$breadcrumb=array();$pageExist=false;

		//assign var
		$exam_id=0;$examdata=$subject_info=array();

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decodeString($input[0],$encryptKey)); //exam_id
			if(count($codes)==1 and $codes[0]){
				$exam_id=$codes[0];
			}else{goto returnStatus;}
		}

		$examdata = $qry->qry_assoc("select e.*,l.title lesson_title,r.answer,r.correctq,r.totalscore,r.start_datetime,r.end_datetime,r.elapsed_time,r.finished from es_exam e 
										left join es_exam_result r on r.exam_id=e.id
										left join es_lesson l on l.id=e.lesson_id
										where r.id=$exam_id and r.student_id=".$usersession->info()->id." and e.active=1 and r.active=1 limit 1");
		if(!count($examdata)){goto returnStatus;}
		$examdata=$examdata[0];
		//get all questions for this exam
		//$q = $qry->qry_assoc("select q.* from es_question q id IN (".$examdata['question_ids'].")");
		
		$questionnaire = renderq(json_decode($examdata['question_ids']));

		$subject_info = $qry->qry_assoc("select s.*,s.title subjectname,gs.id grade_subject_id,c.title coursename,g.id grade_id,g.title gradename from es_course_subject s 
										left join es_course c on c.id=s.course_id
										left join es_grade g on g.id=c.grade_id
										left join es_grade_subject gs on gs.id=s.grade_subject_id
										where s.id=".$examdata['course_subject_id']." and s.active=1 and c.active=1 limit 1");
		if(!count($subject_info)){goto returnStatus;}
		$subject_info=$subject_info[0];
		
		
		$breadcrumb = array('user_programview',
							array('title'=>$subject_info['gradename'],'url'=>$layout_label->label->user_subjectview->url.'/'.(encodeString($subject_info['grade_id'],$encryptKey))),
							array('title'=>$subject_info['subjectname'],'url'=>$layout_label->label->user_lessoncontent->url.'/'.(encodeString($subject_info['grade_id'].'_'.$subject_info['grade_subject_id'],$encryptKey))),
							'user_dotest');
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'examdata'=>(object) $examdata,'subject_info'=>(object) $subject_info,'questionnaire'=>$questionnaire);
	}	
}
?>