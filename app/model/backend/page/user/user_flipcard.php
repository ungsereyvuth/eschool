<?php
class user_flipcard{
	public function data($input){
		$qry = new connectDb;global $usersession,$layout_label,$encryptKey;$breadcrumb=array();$pageExist=false;

		//assign var
		$subject_info=$card_data=array();$inputcode='';$lesson_id=$prev_cardid=$next_cardid=0;

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$inputcode = $input[0];
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

		//get card data		
		$cardid_cond = isset($_GET['cardid'])?(" and id=".$_GET['cardid']):'';
		$lessonid_cond = $lesson_id?" and lesson_id=$lesson_id":" and lesson_id IN (select id from es_lesson where subject_id=$subject_id)";
		$cards = $qry->qry_assoc("select * from es_flipcard where active=1 $lessonid_cond $cardid_cond order by lesson_id,ordering limit 2");
		if(count($cards)==2){
			$card_data = $cards[0];
			$cur_card=$card_data['lesson_id'].$card_data['ordering'];
			$next_cardid=$cards[1]['id'];
		}elseif(count($cards)==1){
			$card_data = $cards[0];
			$cur_card=$card_data['lesson_id'].$card_data['ordering'];
			//get prev card
			$prevcard = $qry->qry_assoc("select id from es_flipcard where active=1 and CAST(concat(lesson_id,ordering) AS UNSIGNED)<$cur_card order by CAST(concat(lesson_id,ordering) AS UNSIGNED) desc limit 1");
			if(count($prevcard)){$prev_cardid=$prevcard[0]['id'];}
			//get next card
			$nextcard = $qry->qry_assoc("select id from es_flipcard where active=1 and CAST(concat(lesson_id,ordering) AS UNSIGNED)>$cur_card order by CAST(concat(lesson_id,ordering) AS UNSIGNED) asc limit 1");
			if(count($nextcard)){$next_cardid=$nextcard[0]['id'];}
		}else{goto returnStatus;}

		$card_data['prev_cardid']=$prev_cardid;
		$card_data['next_cardid']=$next_cardid;
		
		
		if(isThisUserRole($usersession->info()->id,'student')){
			$breadcrumb = array('user_programview',
							array('title'=>$subject_info['gradename'],'url'=>$layout_label->label->user_subjectview->url.'/'.(encode($subject_info['grade_id']))),
							array('title'=>$subject_info['subjectname'],'url'=>$layout_label->label->user_lessoncontent->url.'/'.(encode($subject_info['grade_id'].'_'.$subject_info['grade_subject_id']))),
							'user_flipcard');
		}else{
			$breadcrumb = array('user_flipcard');
		}
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'code'=>$inputcode,'subject_info'=>(object) $subject_info,'card_data'=>(object) $card_data);
	}	
}
?>