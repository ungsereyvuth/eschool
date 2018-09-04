<?php
class edu{
	public function data($input){
		$qry = new connectDb;$pageExist=false;	

		$items = $breadcrumb=array();

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decode($input[0])); //edu id
			if(count($codes)==1 and $codes[0]){
				$eduid=$codes[0];
			}else{goto returnStatus;}
		}

		$grades = $qry->qry_assoc("select g.*,gg.id grade_groupid,gg.title grade_groupname from es_grade g 
										left join es_grade_group gg on g.grade_group_id=gg.id										
										where gg.id=$eduid and g.active=1 and gg.active=1");
		if(!count($grades)){goto returnStatus;}

		$breadcrumb = array(array('title'=>$grades[0]['grade_groupname'],'url'=>'#'));

		$pageExist=true; 
		
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'grades'=>(object) $grades);
	}	
}
?>