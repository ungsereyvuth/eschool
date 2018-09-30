<?php
class user_lessoncontent{
	public function data($input){
		$qry = new connectDb;global $usersession,$layout_label,$encryptKey;$breadcrumb=array();$pageExist=false;

		//assign var
		$lessons=$course_info=$testResult=$teacher=array();

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decodeString($input[0],$encryptKey)); //grade_id,subject_id
			if(count($codes)==2 and $codes[0] and $codes[1]){
				$grade_id=$codes[0];$grade_subject_id=$codes[1];
			}else{goto returnStatus;}			
		}

		$course_info = $qry->qry_assoc("select c.*,s.id subject_id,u.fullname_kh teachername,u.photo teacherphoto,gs.title subjectname from es_course c 
										left join es_course_subject s on s.course_id=c.id 
										left join es_grade_subject gs on gs.id=$grade_subject_id
										left join users u on u.id=c.teacher_id
										left join user_role r on r.id=u.role_id
										where c.grade_id=$grade_id and s.grade_subject_id=$grade_subject_id and c.active=1 and r.code in ('admin','superuser') 
										order by created_date desc limit 1");
		if(!count($course_info)){goto returnStatus;}
		$course_info=$course_info[0];
		$course_sunject_id = $course_info['subject_id']?$course_info['subject_id']:0;
		
		$web_config = web_config(array('profile_pic_path','no_pic'));
		$picPath = $web_config['profile_pic_path'];$no_pic = $web_config['no_pic'];
		//profile photo
		$photo=$picPath.$course_info['teacherphoto'];
		if($photo<>$picPath){$photo = !file_exists($_SERVER['DOCUMENT_ROOT'].$photo)?$no_pic:$photo;}else{$photo =$no_pic;}
		$course_info['teacherphoto']=$photo;
		
		//get all lessons
		if($course_sunject_id){
			$lessons_row = $qry->qry_assoc("select l.*,count(COALESCE(q.id,NULL)) totalq from es_lesson l 
											left join es_question q on q.lesson_id=l.id
											where l.subject_id=$course_sunject_id and l.active=1 
											group by l.id
											order by l.ordering");
			//organize lesson
			foreach($lessons_row as $key=>$value){
				if($value['parent_id']){
					$lessons[$value['parent_id']]['sub'][$value['id']]=$value;
				}else{
					$lessons[$value['id']]['info']=$value;
				}
			}
		}

		//last test record
		$testResult = $qry->qry_assoc("select r.*,e.lesson_id,l.title lessonname,s.title subjectname from es_exam_result r 
											left join es_exam e on r.exam_id=e.id
											left join es_exam_type t on e.exam_type_id=t.id
											left join es_lesson l on e.lesson_id=l.id
											left join es_course_subject s on e.course_subject_id=s.id
											where r.student_id=".$usersession->info()->id." and e.course_subject_id=$course_sunject_id and t.code='qz' and r.active=1 and e.active=1  and s.active=1 
											order by COALESCE(r.end_datetime,r.start_datetime) desc limit 5");
		

		//other teacher of this subject
		/*$teacher = $qry->qry_assoc("select s.*,c.title coursename,u.fullname_kh teachername,u.photo teacherphoto from es_course_subject s 
											left join es_course c on c.id=s.course_id 
											left join users u on u.id=c.teacher_id
											left join user_role r on r.id=u.role_id
											where s.grade_subject_id=$grade_subject_id and s.active=1 and c.active=1 and u.active=1 and r.code='teacher'
											order by s.created_date desc");*/

		$breadcrumb = array('user_programview',
							array('title'=>$course_info['title'],'url'=>$layout_label->label->user_subjectview->url.'/'.(encodeString($grade_id,$encryptKey))),
							array('title'=>$course_info['subjectname'],'url'=>'#'));
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'lessons'=>$lessons,'course_info'=>(object) $course_info,'testResult'=>$testResult,'grade_subject_id'=>$grade_subject_id);
	}	
}
?>