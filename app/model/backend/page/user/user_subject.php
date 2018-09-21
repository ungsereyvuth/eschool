<?php
class user_subject{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey,$layout_label;$breadcrumb=array();$pageExist=false;


		//assign var
		$lessons=$subject_info='';

		if(!isset($input[0]) or !is_numeric(decode($input[0]))){
			goto returnStatus;
		}else{$subject_id=decode($input[0]);}

		$subject_info = $qry->qry_assoc("select s.*,c.id course_id, c.title course_title,u.fullname_kh,u.photo from es_course_subject s 
										left join es_course c on c.id=s.course_id
										left join users u on u.id=c.teacher_id
										where s.id=$subject_id and s.active=1 and c.active=1 and u.active=1");
		if(!count($subject_info)){goto returnStatus;}
		$subject_info= (object) $subject_info[0];

		//get all lessons
		$lessons_row = $qry->qry_assoc("select l.*,count(COALESCE(q.id,NULL)) totalq from es_lesson l 
										left join es_question q on q.lesson_id=l.id
										where l.subject_id=$subject_info->id and l.active=1 
										group by l.id
										order by l.ordering");
		//count flip card
		$totalcard = $qry->qry_count("select id from es_flipcard where lesson_id in (select id from es_lesson where subject_id=$subject_info->id and active=1) and active=1");

		//organize lesson
		$lessons=array();
		foreach($lessons_row as $key=>$value){
			if($value['parent_id']){
				$lessons[$value['parent_id']]['sub'][$value['id']]=$value;
			}else{
				$lessons[$value['id']]['info']=$value;
			}

			
		}
		
		$lidinput= '<input type="hidden" id="subject_id" class="searchinputs" value="'.$subject_info->id.'" />';
		
		$txt_search = '<div class="col-sm-6"><div class="input-group input-group-sm"><input type="text" class="form-control searchinputs" id="txt_search" placeholder="Search keyword"><span class="input-group-btn btn_search"><button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button></span></div></div>';
		$search_inputs = '<div class="row v_pad5">'.$txt_search.$lidinput.'</div>';
		
		$breadcrumb = array('user_coursemgmt',
							array('title'=>$subject_info->course_title,'url'=>$layout_label->label->user_course->url.'/'.encodeString($subject_info->course_id,$encryptKey)),
							array('title'=>$subject_info->title,'url'=>'#'));

		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'lessons'=>$lessons,'totalcard'=>$totalcard,'subject_info'=>$subject_info,'search_inputs'=>$search_inputs);
	}	
}
?>