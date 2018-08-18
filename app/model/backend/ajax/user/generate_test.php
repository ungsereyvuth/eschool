<?php
class generate_test{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		$result = false;$msg=$layout_label->message->insert_failed->icon.' '.$layout_label->message->insert_failed->title;
		$uploaded_files=array();$datetime = date("Y-m-d H:i:s");$userid=$usersession->info()->id;$url='';
		//get post data
		$reg_fields = array('text'=>array('recordid'=>addslashes($_POST['recordid'])),
							'email'=>array(),
							'file'=>array());

		$opt_fields = array();
		$err_fields=validateForm($reg_fields,$opt_fields);		
		if(!count($err_fields)){

			$codes = explode('_',decodeString($reg_fields['text']['recordid'],$encryptKey));
			if(count($codes)==3){ // subject_id,lesson_id,time
				$subject_id = $codes[0];$lesson_id = $codes[1];
				if($subject_id){
					//check if have unfinished quiz
					$bylesson_sql = ($lesson_id?"and e.lesson_id=$lesson_id":"and e.lesson_id is NULL");
					$unfinished_exam = $qry->qry_count("select r.id from es_exam_result r 
											left join es_exam e on e.id=r.exam_id 
											where r.student_id=$userid and r.finished=0 and e.course_subject_id=$subject_id $bylesson_sql and e.auto_generated=1");
					if(!$unfinished_exam){
						//get all questions
						$minq = 5;
						$bylesson_sql = ($lesson_id?"and l.id=$lesson_id":"");
						$qrow = $qry->qry_assoc("select q.id from es_question q 
												left join es_lesson l on l.id=q.lesson_id 
												where l.subject_id=$subject_id and l.active=1 and q.active=1 $bylesson_sql");
						if(count($qrow) and count($qrow)>=$minq){
							$rnd_qrow = randomArray($qrow,$minq); // random row
							$rndq =  array_values(array_map('current', $rnd_qrow)); //convert to 1D arr with array_map, reset keys with array_values
						}else{$msg='មិនអាចធ្វើតេស្តបានទេ! ចំនួនសំណួរមិនគ្រប់គ្រាន់សម្រាប់ធ្វើតេស្ត។';$err_fields[]= array('name'=>'error','msg'=>$msg);}
					}else{$msg='សូមបញ្ចប់តេស្តមុនៗសិន ដើម្បីធ្វើតេស្តថ្មីទៀត។';$err_fields[]= array('name'=>'error','msg'=>$msg);}					
				}else{$msg='Invalid data request';$err_fields[]= array('name'=>'error','msg'=>$msg);}
			}else{$msg='Invalid data request';$err_fields[]= array('name'=>'error','msg'=>$msg);}
		}
		if(!count($err_fields)){
			//create exam row
			//convert array to json string
			$question_ids=json_encode($rndq);
			$totalq=$fullscore=count($rndq);
			$bylesson_sql = ($lesson_id?",lesson_id=$lesson_id":"");
			$exam_id=$qry->insert("insert into es_exam set course_subject_id=$subject_id $bylesson_sql,exam_type_id=1,question_ids='$question_ids',totalq=$totalq,fullscore=$fullscore,auto_generated=1,created_by=$userid,created_date='$datetime'");
			//create questionnaire row
			if($exam_id){
				//created exam result row
				$exam_result_id=$qry->insert("insert into es_exam_result set student_id=$userid,exam_id=$exam_id,totalq=$totalq,start_datetime='$datetime',created_by=$userid,created_date='$datetime'");
				if($exam_result_id){
					//redirect to test page
					$url = $layout_label->label->user_dotest->url.'/'.encodeString($exam_result_id,$encryptKey);
					//add to user log			
					adduserlog($_POST['cmd'],$exam_result_id);
					$result = true;$msg=$layout_label->message->insert_success->icon.' '.$layout_label->message->insert_success->title;;
				}
			}
		}	
		return json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields,'url'=>$url));	
	}	
}	



?>