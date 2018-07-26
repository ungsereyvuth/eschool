<?php
class register_activation{
	public function data($input){
		global $layout_label,$lang,$encryptKey;
		$qry = new connectDb;$pageExist=false;
		if(!isset($input[0])){goto returnStatus;}
		$msg='<div class="alert alert-danger"><div><i class="icon-custom icon-lg icon-bg-red fa fa-exclamation-triangle"></i></div>
					Invalid Data! if you copied and pasted the link, please make sure you copied correclty.</div>';	
		$code_parts = explode("_",decodeString($input[0],$encryptKey));  //format: id_time	
		
		if(count($code_parts)==2){
			$getid = $code_parts[0];
			if(is_numeric($getid)){
				$checkuser = $qry->qry_assoc("SELECT * FROM users where id=$getid and active=1 limit 1");
				if(count($checkuser)){
					if($checkuser[0]['pending']){
						$qry->update("update users set pending=0 where id=$getid limit 1");
						adduserlog('register_activation',$getid);
						$msg ='<div class="alert alert-success txtCenter push-down-10">Your account has been successfully activated. Please <a href="/'.$lang->selected.$layout_label->label->login->url.'">click here</a> to login.</div>';
					}else{
						$msg ='<div class="alert alert-success txtCenter push-down-10">Your account was already activated. Please <a href="/'.$lang->selected.$layout_label->label->login->url.'">click here</a> to login.</div>';
					}
				}
			}
		}
		
		$breadcrumb = array('register_activation');
		$pageExist=true;
		
		$returnData=array('breadcrumb'=>$breadcrumb,'msg'=>$msg);
		returnStatus:
		$returnData=isset($returnData)?$returnData:array();
		$returnData['pageExist']=$pageExist;
		return $returnData;
	}	
}
?>