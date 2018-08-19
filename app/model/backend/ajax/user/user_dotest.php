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
				$question_ids=json_decode($examdata['question_ids']);
				$post = $_POST;$formdata=array();			
				unset($post['recordid']);unset($post['cmd']);//remove some data
				foreach ($post as $key => $value) {
					$formdata[str_replace('q_','',$key)]=$value;
				}
				//verify complete answer
				if(count($formdata) == $examdata['totalq']){
					//prepre saving data

				}else{
					//check for missing answer, then show error
					foreach ($question_ids as $key => $value) {
						if(!array_key_exists($key,$formdata) or $formdata[$key]==''){$err_fields[]= array('name'=>'q_'.$key,'msg'=>'អ្នកមិនទាន់បានឆ្លើយ');}
					}
				}
				//var_dump($formdata);exit;
			}else{$msg='Exam data unavailable';$err_fields[]= array('name'=>'error','msg'=>$msg);}
			
		}
		if(!count($err_fields)){
			$datetime = date("Y-m-d H:i:s");		
			$sql = "";
			$qry->update("update es_exam_result set $sql end_datetime='$datetime' where id=$exam_result_id limit 1");		
			//add to user log			
			adduserlog($_POST['cmd'],$exam_result_id);
			$result = true;$msg=$layout_label->message->insert_success->icon.' '.$layout_label->message->insert_success->title;;
		}	
		return json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields,'url'=>''));	
	}		
}	



?>