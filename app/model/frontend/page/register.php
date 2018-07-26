<?php
class register{
	public function data($input){
		global $lang,$layout_label;
		$qry = new connectDb;$pageExist=false;
		
		$reg_note_data = content('reg_note');
		$reg_note = $reg_note_data['reg_note'];
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'reg_note'=>$reg_note);
	}	
}
?>