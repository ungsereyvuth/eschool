<?php
class user_lessonview{
	public function data($input){
		$qry = new connectDb;global $usersession,$layout_label,$encryptKey;$breadcrumb=array();$pageExist=false;

		//assign var
		$lessonData=array();

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decodeString($input[0],$encryptKey)); //lesson_id,time
			if(count($codes)==2 and $codes[0]){
				$lesson_id=$codes[0];
			}else{goto returnStatus;}
		}

		$lessonData = $qry->qry_assoc("select l.*,p.title maintitle,s.title subjectname,gs.id grade_subject_id,c.title coursename,g.id grade_id,g.title gradename 
									from es_lesson l 
									left join es_lesson p on p.id=l.parent_id
									left join es_course_subject s on s.id=l.subject_id
									left join es_course c on c.id=s.course_id
									left join es_grade g on g.id=c.grade_id
									left join es_grade_subject gs on gs.id=s.grade_subject_id
									where l.id=$lesson_id limit 1");
		if(!count($lessonData)){goto returnStatus;}
		$lessonData=$lessonData[0];
		
		
		$breadcrumb = array('user_programview',
							array('title'=>$lessonData['gradename'],'url'=>$layout_label->label->user_subjectview->url.'/'.(encodeString($lessonData['grade_id'],$encryptKey))),
							array('title'=>$lessonData['subjectname'],'url'=>$layout_label->label->user_lessoncontent->url.'/'.(encodeString($lessonData['grade_id'].'_'.$lessonData['grade_subject_id'],$encryptKey))),
							array('title'=>$lessonData['title'],'url'=>'#'));
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'lessonData'=>(object) $lessonData);
	}	
}
?>