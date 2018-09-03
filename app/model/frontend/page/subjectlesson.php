<?php
class subjectlesson{
	public function data($input){
		$qry = new connectDb;$pageExist=false;	

		$lessons=$lessonData=$breadcrumb=array();$lessonid=0;

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decode($input[0])); //gradeid,subjectid
			if(count($codes)==2 and $codes[0] and $codes[1]){
				$gradeid=$codes[0];$subjectid=$codes[1];
			}else{goto returnStatus;}
		}

		//get subjectid for lastest course
		$latest_subject = $qry->qry_assoc("select s.*,u.fullname_kh teachername,u.photo teacherphoto 
									from es_course_subject s 
									left join es_course c on c.id=s.course_id
									left join users u on u.id=c.teacher_id 
									left join user_role role on role.id=u.role_id
									where s.grade_subject_id=$subjectid and c.grade_id=$gradeid and role.code in ('superuser','admin') 
									order by coalesce(s.last_updated_date,s.created_date) desc
									limit 1");
		if(!count($latest_subject)){goto returnStatus;}
		$latest_subject=$latest_subject[0];
		$latest_subjectid=$latest_subject['id'];
		//get all lessons
		$lessons_row = $qry->qry_assoc("select l.*,count(COALESCE(q.id,NULL)) totalq from es_lesson l 
										left join es_question q on q.lesson_id=l.id
										where l.subject_id=$latest_subjectid and l.active=1 
										group by l.id
										order by l.ordering");
		//organize lesson
		$startup_lessonid=0;
		foreach($lessons_row as $key=>$value){
			if($value['parent_id']){$startup_lessonid=$startup_lessonid?$startup_lessonid:$value['id'];
				$lessons[$value['parent_id']]['sub'][$value['id']]=$value;
			}else{
				$lessons[$value['id']]['info']=$value;
			}
		}
		//show lesson content
		$lessonid=(isset($_GET['lid']) and decode($_GET['lid']))?decode($_GET['lid']):$startup_lessonid;
		if($lessonid){
			$lessonData = $qry->qry_assoc("select l.*,p.title maintitle,s.title subjectname,gs.id grade_subject_id,c.title coursename,g.id grade_id,g.title gradename 
									from es_lesson l 
									left join es_lesson p on p.id=l.parent_id
									left join es_course_subject s on s.id=l.subject_id
									left join es_course c on c.id=s.course_id
									left join es_grade g on g.id=c.grade_id
									left join es_grade_subject gs on gs.id=s.grade_subject_id
									where l.id=$lessonid limit 1");
			if(!count($lessonData)){goto returnStatus;}
			$lessonData=$lessonData[0];
		}

		//teacher info


		$pageExist=true; 
		
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'code'=>$input[0],'lessonid'=>$lessonid,'lessons'=>$lessons,'lessonData'=>(object) $lessonData);
	}	
}
?>