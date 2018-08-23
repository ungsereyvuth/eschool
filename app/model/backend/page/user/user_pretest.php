<?php
class user_pretest{
	public function data($input){
		$qry = new connectDb;global $usersession,$layout_label,$encryptKey;$breadcrumb=array();$pageExist=false;

		//assign var
		$lessons=$subject_info=array();$search_inputs='';$lesson_id=$unfinished_exam=0;

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decodeString($input[0],$encryptKey)); //subject_id,lesson_id
			if(count($codes)==2 and $codes[0]){
				$subject_id=$codes[0];$lesson_id=$codes[1]?$codes[1]:0; 
			}elseif(count($codes)==1 and $codes[0]){
				$subject_id=$codes[0];
			}else{goto returnStatus;}			
		}

		$subject_info = $qry->qry_assoc("select s.*,s.title subjectname,gs.id grade_subject_id,c.title coursename,g.id grade_id,g.title gradename from es_course_subject s 
										left join es_course c on c.id=s.course_id
										left join es_grade g on g.id=c.grade_id
										left join es_grade_subject gs on gs.id=s.grade_subject_id
										where s.id=$subject_id and s.active=1 and c.active=1 limit 1");
		if(!count($subject_info)){goto returnStatus;}
		$subject_info=$subject_info[0];
		
		//get all lessons
		$lessons_row = $qry->qry_assoc("select l.* from es_lesson l 
										where l.subject_id=$subject_id and l.active=1 
										order by l.ordering");
		//organize lesson
		foreach($lessons_row as $key=>$value){
			if($value['parent_id']){
				$lessons[$value['parent_id']]['sub'][$value['id']]=$value;
			}else{
				$lessons[$value['id']]['info']=$value;
			}
		}

		//check if have unfinished automatic quiz
		$bylesson_sql = ($lesson_id?"and e.lesson_id=$lesson_id":"and e.lesson_id is NULL");
		$unfinished_exam = $qry->qry_assoc("select r.id from es_exam_result r 
								left join es_exam e on e.id=r.exam_id 
								where r.student_id=".$usersession->info()->id." and r.finished=0 
								and e.course_subject_id=".$subject_info['id']." $bylesson_sql and e.auto_generated=1 
								order by r.id desc limit 1");
		
		$breadcrumb = array('user_programview',
							array('title'=>$subject_info['gradename'],'url'=>$layout_label->label->user_subjectview->url.'/'.(encodeString($subject_info['grade_id'],$encryptKey))),
							array('title'=>$subject_info['subjectname'],'url'=>$layout_label->label->user_lessoncontent->url.'/'.(encodeString($subject_info['grade_id'].'_'.$subject_info['grade_subject_id'],$encryptKey))),
							'user_pretest');
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'lessons'=>$lessons,'search_inputs'=>$search_inputs,'subject_info'=>(object) $subject_info,'lesson_id'=>$lesson_id,'unfinished_exam'=>$unfinished_exam);
	}	
}
?>