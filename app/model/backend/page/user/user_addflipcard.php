<?php
class user_addflipcard{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey,$layout_label;$breadcrumb=array();$pageExist=false;

		$search_inputs=$ordering='';$lesson_id=$cardid=0;$editmode=false;$lesson_info=$card_data=$inputcode=array();

		if(!isset($input[0])){
			goto returnStatus;
		}
		$inputcode=decodeString($input[0],$encryptKey);
		$codes=explode('_',$inputcode);//lesson_id,cardid
		if(count($codes)==1 and $codes[0]){
			$lesson_id=$codes[0];
		}elseif(count($codes)==2 and $codes[0] and $codes[1]){
			$lesson_id=$codes[0];$cardid=$codes[1];$editmode=true;
		}else{goto returnStatus;}

		//check subject availability
		$lesson_info = $qry->qry_assoc("select l.id lesson_id,l.title lesson_title,s.id subject_id,s.title subject_title,c.title course_title,c.id course_id from es_lesson l 
										left join es_course_subject s on s.id=l.subject_id
										left join es_course c on c.id=s.course_id
										where l.id=$lesson_id and l.active=1 and s.active=1 and c.teacher_id=".$usersession->info()->id." and c.active=1");
		if(!count($lesson_info)){goto returnStatus;}
		$lesson_info=(object) $lesson_info[0];
		//get ordering number
		$ordering=1;$fcolor=$bcolor='rgba(215,255,214,1)';
		$q_info = $qry->qry_assoc("select fcolor,bcolor,ordering from es_flipcard where lesson_id=$lesson_id order by ordering desc limit 1");
		if(count($q_info)){$ordering+=$q_info[0]['ordering'];$fcolor=$q_info[0]['fcolor'];$bcolor=$q_info[0]['bcolor'];}

		//get edit data
		if($editmode){
			$card_data = $qry->qry_assoc("select * from es_flipcard where lesson_id=$lesson_id and id=$cardid limit 1");
			if(count($card_data)){$card_data=(object) $card_data[0];}
		}

		$txt_search = '<div class="col-sm-6"><div class="input-group input-group-sm"><input type="text" class="form-control searchinputs" id="txt_search" placeholder="Search keyword"><span class="input-group-btn btn_search"><button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button></span></div></div>';
		$lessonid_input = '<input type="hidden" id="lesson_id" class="searchinputs" value="'.$lesson_id.'" />';
		$search_inputs = '<div class="row v_pad5">'.$txt_search.$lessonid_input.'</div>';
		

		$breadcrumb = array('user_coursemgmt',
							array('title'=>$lesson_info->course_title,'url'=>$layout_label->label->user_course->url.'/'.encodeString($lesson_info->course_id,$encryptKey)),
							array('title'=>$lesson_info->subject_title,'url'=>$layout_label->label->user_subject->url.'/'.encodeString($lesson_info->subject_id,$encryptKey)),
							'user_addflipcard');



		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'lesson_info'=>$lesson_info,'card_data'=>$card_data,'ordering'=>$ordering,'fcolor'=>$fcolor,'bcolor'=>$bcolor,'code'=>$inputcode,'search_inputs'=>$search_inputs,'editmode'=>$editmode);
	}	
}
?>