<?php
class user_lessoncontent{
	public function data($input){
		$qry = new connectDb;global $usersession,$layout_label,$encryptKey;$breadcrumb=array();$pageExist=false;

		//assign var
		$lessons=$course_info=array();

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decodeString($input[0],$encryptKey)); //grade_id,subject_id
			if(count($codes)==2 and $codes[0] and $codes[1]){
				$grade_id=$codes[0];$grade_subject_id=$codes[1];
			}else{goto returnStatus;}			
		}

		$course_info = $qry->qry_assoc("select c.*,s.id subject_id,u.fullname_kh teachername,u.photo teacherphoto,gs.title subjectname from es_course c 
										left join es_course_subject s on s.course_id=c.id and s.grade_subject_id=$grade_subject_id
										left join es_grade_subject gs on gs.id=$grade_subject_id
										left join users u on u.id=c.teacher_id
										left join user_role r on r.id=u.role_id
										where c.grade_id=$grade_id and c.active=1 and r.code in ('admin','superuser') 
										order by created_date desc limit 1");
		if(!count($course_info)){goto returnStatus;}
		$course_info=$course_info[0];
		$course_sunject_id = $course_info['subject_id'];
		
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
		
		$breadcrumb = array('user_programview',
							array('title'=>$course_info['title'],'url'=>$layout_label->label->user_subjectview->url.'/'.(encodeString($grade_id,$encryptKey))),
							array('title'=>$course_info['subjectname'],'url'=>'#'));
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'lessons'=>$lessons,'course_info'=>(object) $course_info);
	}	
}
?>