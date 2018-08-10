<?php
class user_addlesson{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		$result = false;$msg=$layout_label->message->insert_failed->icon.' '.$layout_label->message->insert_failed->title;
		$uploaded_files=array();
		//get post data
		$reg_fields = array('text'=>array(	'recordid'=>addslashes($_POST['recordid']),
											'title'=>addslashes($_POST['title']),		
											'description'=>addslashes($_POST['description']),	
											'ordering'=>addslashes($_POST['ordering']),	
											'filename'=>addslashes(isset($_POST['filename'])?$_POST['filename']:''),	
											'active'=>isset($_POST['active'])?1:0),
							'email'=>array(),
							'file'=>array());

		$opt_fields = array('active','description','filename');
		$err_fields=validateForm($reg_fields,$opt_fields);		
		if(!count($err_fields)){

			$codes = explode('_',decodeString($reg_fields['text']['recordid'],$encryptKey));
			if(count($codes)==1){
				$subject_id = $codes[0]; $addmode = 'chapter';
				if(!is_numeric($subject_id) or !$subject_id){
					$msg='Invalid data request';
					$err_fields[]= array('name'=>'error','msg'=>$msg);
				}
			}elseif(count($codes)==2){
				$subject_id = $codes[0];$parent_id = $codes[1]; $addmode = 'lesson';
				if(!is_numeric($subject_id) or !$subject_id or !is_numeric($parent_id) or !$parent_id){
					$msg='Invalid data request';
					$err_fields[]= array('name'=>'error','msg'=>$msg);
				}
			}
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