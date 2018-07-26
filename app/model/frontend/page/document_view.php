<?php
class document_view{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey,$layout_label;
		$pageExist=false;
		$viewdata=array();
		if(isset($input[0])){
			$code=decodeString($input[0],$encryptKey);// id_time
			$code_parts = explode('_',$code);
			if(count($code_parts)==2 and is_numeric($code_parts[0]) and $code_parts[0]){
				$row_id = $code_parts[0];
				$datarow = $qry->qry_assoc("select d.*
											from documents d
											where d.id=$row_id limit 1");
				if(!count($datarow)){goto returnStatus;}
				$viewdata=$datarow[0];
				$pageExist=true;
				$breadcrumb = array(
										'documents',
										array('title'=>$viewdata['title'],'url'=>'#')
										
									);
			}
		}
		
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'viewdata'=>$viewdata);
	}	
}
?>