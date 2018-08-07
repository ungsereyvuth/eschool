<?php
class user_course{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey;$breadcrumb=array();$pageExist=false;


		//assign var
		$course_info=$subject_data='';

		if(!isset($input[0]) or !is_numeric(decodeString($input[0],$encryptKey))){
			goto returnStatus;
		}else{$course_id=decodeString($input[0],$encryptKey);}
		
		$course_info = $qry->qry_assoc("select c.*,if(c.max_student>0,c.max_student,'∞') max_student,u.fullname_kh,u.photo,count(COALESCE(m.id,NULL)) total_student from es_course c 
										left join es_course_member m on m.course_id=c.id and m.active=1
										left join users u on u.id=c.teacher_id
										where c.id=$course_id and c.active=1 and u.active=1 limit 1");
		if(!count($course_info)){goto returnStatus;}
		$course_info= (object) $course_info[0];
		$subject_data = (object) $qry->qry_assoc("select s.*,count(COALESCE(l.id,NULL)) total_lesson from es_course_subject s 
													left join es_lesson l on l.subject_id=s.id and l.active=1
													where s.course_id=$course_id and s.active=1 
													group by s.id
													order by s.created_date");

		//photo		
		$picPath = web_config('profile_pic_path');$no_pic = web_config('no_pic');
		$photo=$picPath.$course_info->photo;
		if($photo<>$picPath){$photo = !file_exists($_SERVER['DOCUMENT_ROOT'].$photo)?$no_pic:$photo;}else{$photo =$no_pic;}
		$course_info->photo = $photo;
		
				
		

		$breadcrumb = array('user_coursemgmt',array('title'=>$course_info->title,'url'=>'#'));
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'subject_data'=>$subject_data,'course_info'=>$course_info);
	}	
}
?>