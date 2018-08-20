<?php
class user_dotest{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		$result = false;$msg=$layout_label->message->insert_failed->icon.' '.$layout_label->message->insert_failed->title;
		$uploaded_files=array();
		//get post data
		$reg_fields = array('text'=>array('recordid'=>addslashes($_POST['recordid'])),
							'email'=>array(),
							'file'=>array());
		$opt_fields = array();
		$err_fields=validateForm($reg_fields,$opt_fields);		
		if(!count($err_fields)){

			$codes = explode('_',decodeString($reg_fields['text']['recordid'],$encryptKey)); //exam_result_id,time
			if(count($codes)==2){
				$exam_result_id = $codes[0];
				if(!is_numeric($exam_result_id) or !$exam_result_id){
					$msg='Invalid data request';$err_fields[]= array('name'=>'error','msg'=>$msg);
				}
			}else{$msg='Invalid data request';$err_fields[]= array('name'=>'error','msg'=>$msg);}
			
			//get data from exam
			$examdata = $qry->qry_assoc("select e.* from es_exam e 
										left join es_exam_result r on r.exam_id=e.id
										where r.id=$exam_result_id and r.student_id=".$usersession->info()->id." and e.active=1 and r.active=1 limit 1");
			if(count($examdata)){
				$examdata=$examdata[0];
				$exam_qid=json_decode($examdata['question_ids'],true);
				$post = $_POST;$formdata=array();$qids=array();	
				unset($post['recordid']);unset($post['cmd']);//remove some data
				foreach ($post as $key => $value) {
					$newkey = str_replace('q_','',$key);
					if(is_array($value)){
						$formdata[$newkey]=$value;
					}elseif(isJson($value) and trim($value)<>''){
						$jsonval = array_map('current', json_decode($value,true));
						$formdata[$newkey]=$jsonval;
					}else{
						$formdata[$newkey]=trim($value);
					}
					$qids[]=$newkey;
				}
				//verify complete answer
				if((count($formdata) == $examdata['totalq']) and !in_array('', $formdata)){
					//get q correct answer
					$answer_arr = array();$answer_output=array();
					$answer_row = $qry->qry_assoc("select o.*,t.code from es_question_options o 
												left join es_question q on q.id=o.question_id
												left join es_question_type t on t.id=q.type_id
												where o.question_id IN (".implode(",", $qids).") and (o.is_answer>0 or t.code='tf') 
												order by o.question_id,o.is_answer");
					foreach ($answer_row as $key => $value) {
						if(in_array($value['code'], array('qcm','mc','sq'))){
							$answer_arr[$value['question_id']][] = $value['id'];//id is answer
						}elseif(in_array($value['code'], array('fg','pw'))){
							$answer_arr[$value['question_id']][] = $value['choice']; // choice text is answer
						}elseif(in_array($value['code'], array('tf'))){
							$answer_arr[$value['question_id']][] = $value['is_answer']; // is_answer is answer
						}
					}

					//calculate score
					$correctq=$totalscore=0;
					foreach ($answer_arr as $qkey => $qvalue) {
						//q full score
						$qfullscore = isset($exam_qid[$key]['score'])?$exam_qid[$key]['score']:1;
						$qscore=0;
						if(is_array($formdata[$qkey])){
							$totalo = count($qvalue);$totalcorrect=0;
							foreach ($qvalue as $akey => $avalue) {
								if(in_array($avalue,$formdata[$qkey])){$totalcorrect++;}
							}
							if($totalo==$totalcorrect){$qscore=$qfullscore;$correctq++;}//if correct all, get full score
							elseif($totalcorrect){$qscore=number_format(($qfullscore/$totalo)*$totalcorrect,2);$correctq++;}//if partically correct, get partial score
						}else{
							if(trim($formdata[$qkey])==trim($qvalue[0])){$qscore=$qfullscore;$correctq++;}
						}
						$answer_output[$qkey]=array('answer'=>$formdata[$qkey],'score'=>$qscore);	
						$totalscore+=$qscore;
					}

				}else{
					//check for missing answer, then show error
					foreach ($exam_qid as $key => $value) {
						if(!array_key_exists($key,$formdata) or $formdata[$key]==''){
							$err_fields[]= array('name'=>'q_'.$key,'msg'=>'អ្នកមិនទាន់បានឆ្លើយ');}
					}
				}
				//var_dump($formdata);exit;
			}else{$msg='Exam data unavailable';$err_fields[]= array('name'=>'error','msg'=>$msg);}
			
		}
		if(!count($err_fields)){
			$datetime = date("Y-m-d H:i:s");
			$answer =  addslashes(json_encode($answer_output));
			//echo $answer;exit;
			$qry->update("update es_exam_result set answer='$answer',correctq=$correctq,totalscore=$totalscore,end_datetime='$datetime',elapsed_time=0,finished=1 where id=$exam_result_id limit 1");
			//add to user log			
			adduserlog($_POST['cmd'],$exam_result_id);
			$result = true;$msg=$layout_label->message->insert_success->icon.' '.$layout_label->message->insert_success->title;
		}	
		return json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields,'url'=>''));
	}		
}	



?>