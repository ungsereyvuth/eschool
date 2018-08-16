<?php
class user_programview{
	public function data($input){
		$qry = new connectDb;global $usersession,$encryptKey;$breadcrumb=array();$pageExist=false;

		//assign var
		$grade_info=array();

		$grade_row = $qry->qry_assoc("select gg.*,g.id gradeid,g.title gradename from es_grade_group gg 
										left join es_grade g on g.grade_group_id=gg.id and g.active=1
										where gg.active=1");
		if(!count($grade_row)){goto returnStatus;}

		foreach ($grade_row as $key => $value) {
			$grade_info[$value['id']][]=$value;
		}
		
		//$breadcrumb = array('user_coursemgmt',array('title'=>$course_info->title,'url'=>'#'));
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'grade_info'=>(object) $grade_info);
	}	
}
?>