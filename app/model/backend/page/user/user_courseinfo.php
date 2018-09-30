<?php
class user_courseinfo{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey;$breadcrumb=array();$pageExist=false;

		$course_id=0;$course_info=$classmember=$isMember=$membership=array();

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decode($input[0])); //course_id,time
			if(count($codes)==2 and $codes[0] and $codes[1]){
				$course_id=$codes[0];
			}else{goto returnStatus;}			
		}

		$course_info = $qry->qry_assoc("select c.*,s.id subject_id,s.title coursesubject,g.title gradename,gs.title subjectname,u.fullname_kh teachername from es_course c 
										left join es_grade g on g.id=c.grade_id
										left join es_course_subject s on s.course_id=c.id 
										left join es_grade_subject gs on gs.id=s.grade_subject_id
										left join users u on u.id=c.teacher_id
										where c.id=$course_id and c.active=1 and s.active=1 and g.active=1 
										order by gs.ordering");
		if(!count($course_info)){goto returnStatus;}
		
		//check if have course class
		$classmember = $qry->qry_assoc("select count(1) totalmember,m.class_id,c.title classname from es_course_member m
										left join es_course_class c on c.id=m.class_id
										where m.course_id=$course_id and m.active=1 
										group by m.class_id");

		$membership = $qry->qry_assoc("select class_id,coalesce(last_updated_date,created_date) jointdate from es_course_member where course_id=$course_id and student_id=".$usersession->info()->id." and active=1");
		$isMember=count($membership)?true:false;
		$membership=count($membership)?$membership[0]:$membership;

		$breadcrumb = array('user_courseinfo');
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'course_id'=>$course_id,'course_info'=>$course_info,'classmember'=>$classmember,'isMember'=>$isMember,'membership'=>(object) $membership);
	}	
}
?>