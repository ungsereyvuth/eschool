<?php
class user_testresult{
	public function data($input){
		$qry = new connectDb;global $usersession,$layout_label,$encryptKey;$breadcrumb=array();$pageExist=false;

		//assign var
		$exam_result_id=0;$examdata=$subject_info=$questionnaire=array();

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decodeString($input[0],$encryptKey)); //exam_result_id
			if(count($codes)==1 and $codes[0]){
				$exam_result_id=$codes[0];
			}else{goto returnStatus;}
		}

		$examdata = $qry->qry_assoc("select r.*,e.course_subject_id,e.lesson_id,e.question_ids,e.course_subject_id,e.fullscore,l.title lesson_title,r.id exam_result_id,r.answer,r.correctq,r.totalscore,r.start_datetime,r.end_datetime,r.elapsed_time
										from es_exam_result r 
										left join es_exam e on r.exam_id=e.id
										left join es_lesson l on l.id=e.lesson_id
										where r.id=$exam_result_id and r.student_id=".$usersession->info()->id." and e.active=1 and r.active=1 and r.finished=1 limit 1");
		if(!count($examdata)){goto returnStatus;}
		$examdata=$examdata[0];
		
		$questionnaire = renderq(array_keys(json_decode($examdata['question_ids'],true)),NULL,json_decode($examdata['answer'],true));

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
							'user_testresult');
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'examdata'=>(object) $examdata,'subject_info'=>(object) $subject_info,'questionnaire'=>$questionnaire);
	}	
}
?>