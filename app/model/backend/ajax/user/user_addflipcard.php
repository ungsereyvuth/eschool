<?php
class user_addflipcard{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		//$refresh_listname='user_questionlist';
		$result = false;$msg=$layout_label->message->insert_failed->icon.' '.$layout_label->message->insert_failed->title;
		$uploaded_files=array();
		//get post data
		$reg_fields = array('text'=>array(	'recordid'=>addslashes($_POST['recordid']),
											'front_card'=>addslashes($_POST['front_card']),
											'back_card'=>addslashes($_POST['back_card']),		
											'front_card_color'=>addslashes($_POST['front_card_color']),	
											'back_card_color'=>addslashes($_POST['back_card_color']),	
											'ordering'=>addslashes($_POST['ordering']),	
											'active'=>isset($_POST['active'])?1:0),
							'email'=>array(),
							'file'=>array());

		$opt_fields = array('active');
		$err_fields=validateForm($reg_fields,$opt_fields);		
		if(!count($err_fields)){
			//check code
			$editmode=false;
			$codes = explode('_',decodeString($reg_fields['text']['recordid'],$encryptKey)); //lesson_id,cardid,time
			if(count($codes)==3 and $codes[0] and $codes[1] and $codes[2]){
				$lesson_id = $codes[0];$cardid = $codes[1];$editmode=true;
				//check if lesson exist
				$lessonexist = $qry->exist("select id from es_lesson where id=$lesson_id limit 1");
				if(!$lessonexist){$msg='Invalid lesson data request';$err_fields[]= array('name'=>'error','msg'=>$msg);}
				//check if card exist
				$cardexist = $qry->exist("select id from es_flipcard where id=$cardid limit 1");
				if(!$cardexist){$msg='Invalid card data request';$err_fields[]= array('name'=>'error','msg'=>$msg);}
			}elseif(count($codes)==2 and $codes[0] and $codes[1]){
				$lesson_id = $codes[0];
				//check if lesson exist
				$lessonexist = $qry->exist("select id from es_lesson where id=$lesson_id limit 1");
				if(!$lessonexist){$msg='Invalid lesson data request';$err_fields[]= array('name'=>'error','msg'=>$msg);}
			}else{$msg='Invalid data request';$err_fields[]= array('name'=>'error','msg'=>$msg);}
		}

		//insert into db
		if(!count($err_fields)){
			$datetime = date("Y-m-d H:i:s");		
			$sql = "lesson_id=$lesson_id,
					front='".$reg_fields['text']['front_card']."',
					back='".$reg_fields['text']['back_card']."',
					fcolor='".$reg_fields['text']['front_card_color']."',
					bcolor='".$reg_fields['text']['back_card_color']."',
					ordering=".$reg_fields['text']['ordering'].",
					active=".$reg_fields['text']['active'].",";
			if($editmode){
				$recordid=$cardid;
				$qry->update("update es_flipcard set $sql last_updated_by=".$usersession->info()->id.",last_updated_date='$datetime' where id=$cardid limit 1");
			}else{
				$recordid=$qry->insert("insert into es_flipcard set $sql created_by=".$usersession->info()->id.",created_date='$datetime'");
			}
				
			adduserlog($_POST['cmd'],json_encode(array('id'=>$recordid,'action'=>$editmode?'update':'insert')));
			$result = true;$msg=$layout_label->message->insert_success->icon.' '.$layout_label->message->insert_success->title;			
		}	
		return json_encode(array('result'=>$result,'msg'=>$msg,'err_fields'=>$err_fields,'url'=>''));	
	}	
}	



?>