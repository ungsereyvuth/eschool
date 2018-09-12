<?php
class register{
	public function data($input){
		global $lang,$layout_label;
		$qry = new connectDb;$pageExist=false;
		
		$reg_note_data = content('reg_note');
		$reg_note = $reg_note_data['reg_note'];

		//get province list
		$province = $qry->qry_assoc("select id,if('$lang->selected'='kh',title_kh,title_en) name from address_provincecity where active=1");

		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'reg_note'=>$reg_note,'province'=>$province);
	}	
}
?>