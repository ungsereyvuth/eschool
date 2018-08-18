<?php
class generate_test{
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

			$codes = explode('_',decodeString($reg_fields['text']['recordid'],$encryptKey));
			if(count($codes)==3){ // subject_id,lesson_id,time
				$subject_id = $codes[0];$lesson_id = $codes[1];
				if($subject_id){
					//get all questions
					$minq = 5;
					$bylesson_sql = "and ".($lesson_id?"l.id=$lesson_id":"");
					$qrow = $qry->qry_assoc("select q.id from es_question q 
											left join es_lesson l on l.id=q.lesson_id 
											where l.subject_id=$subject_id and l.active=1 and q.active=1 $bylesson_sql");
					if(count($qrow) and count($qrow)>=$minq){
						$rnd_qrow = randomArray($qrow,$minq); // random row
						$rndq = array_map('current', $rnd_qrow); //convert to single dimension
						var_dump($rndq);exit;
					}else{$msg='មិនអាចធ្វើតេស្តបានទេ! ចំនួនសំណួរមិនគ្រប់គ្រាន់សម្រាប់ធ្វើតេស្ត។';$err_fields[]= array('name'=>'error','msg'=>$msg);}

				}else{$msg='Invalid data request';$err_fields[]= array('name'=>'error','msg'=>$msg);}
			}else{$msg='Invalid data request';$err_fields[]= array('name'=>'error','msg'=>$msg);}
		}
		if(!count($err_fields)){
			$datetime = date("Y-m-d H:i:s");		
			$sql = "title='".$reg_fields['text']['title']."',					
					subject_id=$subject_id,
					description='".$reg_fields['text']['description']."',
					ordering=".$reg_fields['text']['ordering'].",
					filenames='".$reg_fields['text']['filename']."',
					active=".$reg_fields['text']['active'].",";
			if($addmode == 'lesson'){$sql .= "parent_id=$parent_id,";}
			$recordid=$qry->insert("insert into es_lesson set $sql created_by=".$usersession->info()->id.",created_date='$datetime'");		
			//add to user log			
			adduserlog($_POST['cmd'],$recordid);
			$result = true;$msg=$layout_label->message->insert_success->icon.' '.$layout_label->message->insert_success->title;;
		}	
		return json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields,'url'=>''));	
	}	
}	



?>