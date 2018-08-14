<?php
class user_addquestion{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		//$refresh_listname='user_questionlist';
		$result = false;$msg=$layout_label->message->insert_failed->icon.' '.$layout_label->message->insert_failed->title;
		$uploaded_files=array();
		//get post data
		$reg_fields = array('text'=>array(	'recordid'=>addslashes($_POST['recordid']),
											'qtype'=>addslashes($_POST['qtype']),
											'title'=>addslashes($_POST['title']),		
											'description'=>addslashes($_POST['description']),	
											'ordering'=>addslashes($_POST['ordering']),	
											'active'=>isset($_POST['active'])?1:0),
							'email'=>array(),
							'file'=>array());

		$opt_fields = array('active','description');
		$err_fields=validateForm($reg_fields,$opt_fields);		
		if(!count($err_fields)){
			//check code (lesson_id)
			$codes = explode('_',decodeString($reg_fields['text']['recordid'],$encryptKey)); //lesson_id,time
			if(count($codes)==2 and $codes[0] and $codes[1]){
				$lesson_id = $codes[0];
				//check if lesson exist
				$lessonexist = $qry->exist("select id from es_lesson where id=$lesson_id limit 1");
				if(!$lessonexist){$msg='Invalid lesson data request';$err_fields[]= array('name'=>'error','msg'=>$msg);}
			}else{$msg='Invalid data request';$err_fields[]= array('name'=>'error','msg'=>$msg);}
		}

		//check answer options
		if(!count($err_fields)){
			$qtype=$reg_fields['text']['qtype'];$opt_sql = array();
			$qtype_row = $qry->qry_assoc("select id from es_question_type where code='$qtype' and active=1 limit 1");
			if(count($qtype_row)){
				$type_id=$qtype_row[0]['id'];
				if($qtype == 'qcm') {				
					$choices = isset($_POST['choices'])?$_POST['choices']:array();
					$correct_choices = isset($_POST['correct_choices'])?$_POST['correct_choices']:NULL;
					if(count($choices) and array_key_exists($correct_choices, $choices)){
						foreach ($choices as $key => $value) {
							$is_answer=$key==$correct_choices?1:0;
							if(trim($value) <>''){$opt_sql[] = ",choice='$value',is_answer=$is_answer";}
							else{$err_fields[]= array('name'=>"choices[$key]",'msg'=>'សូមសរសេរជម្រើស');}
						}
					}else{$msg='សូមជ្រើសរើសចម្លើយត្រឹមត្រូវ';$err_fields[]= array('name'=>'error','msg'=>$msg);}
				}elseif($qtype == 'tf'){
					if(isset($_POST['correct_choices'])){
						$tf_format = trim($_POST['tf_format']);
						$correct_choices = $_POST['correct_choices'];
						$opt_sql[] = ",choice='$tf_format',is_answer=$correct_choices";
					}else{$err_fields[]= array('name'=>"correct_choices",'msg'=>'ជ្រើសរើសចម្លើយត្រឹមត្រូវ');}				
				}elseif($qtype == 'mc'){
					$choices = isset($_POST['choices'])?$_POST['choices']:array();
					$correct_choices = isset($_POST['correct_choices'])?$_POST['correct_choices']:array();
					if(count($choices)>2 and count($correct_choices)>1){
						foreach ($choices as $key => $value) {
							$is_answer=in_array($key, $correct_choices)?1:0;
							if(trim($value) <>''){$opt_sql[] = ",choice='$value',is_answer=$is_answer";}
							else{$err_fields[]= array('name'=>"choices[$key]",'msg'=>'សូមសរសេរជម្រើស');}
						}
					}else{$msg='សូមកំណត់ជម្រើសច្រើនជាង២ និងចម្លើយត្រឹមត្រូវច្រើនជាង១';$err_fields[]= array('name'=>'error','msg'=>$msg);}
				}elseif($qtype == 'fg'){
					$answer = trim($_POST['answer']);
					if($answer<>''){$opt_sql[] = ",choice='$answer',is_answer=1";}
					else{$err_fields[]= array('name'=>"answer",'msg'=>'សូមសរសេរចម្លើយ');}
				}elseif($qtype == 'pw'){
					$answer = trim($_POST['answer']);
					if($answer<>''){$opt_sql[] = ",choice='$answer',is_answer=1";}
					else{$err_fields[]= array('name'=>"answer",'msg'=>'សូមសរសេរចម្លើយ');}
				}elseif($qtype == 'sq'){
					$choices = isset($_POST['choices'])?$_POST['choices']:array();
					$correct_order = array();
					$sq_order = json_decode($_POST['sq_order'],true);
					foreach ($sq_order as $key => $value) {
						$correct_order[] = $value['id'];
					}
					if(count($choices)>2 and count($correct_order)==count($choices)){
						foreach ($choices as $key => $value) {
							$is_answer=array_search($key, $correct_order);
							if(is_numeric($is_answer)){
								if(trim($value) <>''){$opt_sql[] = ",choice='$value',is_answer=".($is_answer+1);}
								else{$err_fields[]= array('name'=>"choices[$key]",'msg'=>'សូមសរសេរចម្លើយ');}
							}else{$err_fields[]= array('name'=>"sq_order",'msg'=>'លំដាប់ចម្លើយមិនត្រឹមត្រូវ');}
						}
					}else{$err_fields[]= array('name'=>'sq_order','msg'=>'សូមកំណត់ចម្លើយ និងរៀបតាមលំដាប់ឲ្យបានត្រឹមត្រូវ ច្រើនជាង២');}
				}
			}else{$msg='ប្រភេទសំណួរមិនត្រឹមត្រូវ!';$err_fields[]= array('name'=>'error','msg'=>$msg);}
		}
		//insert into db
		if(!count($err_fields)){
			$datetime = date("Y-m-d H:i:s");		
			$sql = "title='".$reg_fields['text']['title']."',					
					type_id=$type_id,
					lesson_id=$lesson_id,
					description='".$reg_fields['text']['description']."',
					ordering=".$reg_fields['text']['ordering'].",
					active=".$reg_fields['text']['active'].",";
			$recordid=$qry->insert("insert into es_question set $sql created_by=".$usersession->info()->id.",created_date='$datetime'");	
			if($recordid){
				$opt_std_sql = "insert into es_question_options set question_id=$recordid";
				foreach ($opt_sql as $key => $value) {
					$qry->insert($opt_std_sql.$value);
				}
				//add to user log			
				adduserlog($_POST['cmd'],$recordid);
				$result = true;$msg=$layout_label->message->insert_success->icon.' '.$layout_label->message->insert_success->title;
			}				
		}	
		return json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields,'url'=>''));	
	}	
}	



?>