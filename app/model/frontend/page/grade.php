<?php
class grade{
	public function data($input){
		global $layout_label;
		$qry = new connectDb;$pageExist=false;	

		$items = $breadcrumb=array();

		if(!isset($input[0])){
			goto returnStatus;
		}else{
			$codes = explode('_',decode($input[0])); //gradeid
			if(count($codes)==1 and $codes[0]){
				$gradeid=$codes[0];
			}else{goto returnStatus;}
		}

		$gradeinfo = $qry->qry_assoc("select g.*,gg.id grade_groupid,gg.title grade_groupname from es_grade g 
										left join es_grade_group gg on g.grade_group_id=gg.id										
										where g.id=$gradeid and g.active=1 and gg.active=1");
		if(!count($gradeinfo)){goto returnStatus;}
		$gradeinfo=$gradeinfo[0];

		$items = $qry->qry_assoc("select * from es_grade_subject where id in (".$gradeinfo['subject_ids'].")");

		$breadcrumb = array(array('title'=>$gradeinfo['grade_groupname'],'url'=>$layout_label->label->edu->url.'/'.encode($gradeinfo['grade_groupid'])),
							array('title'=>$gradeinfo['title'],'url'=>'#'));

		$pageExist=true; 
		
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'items'=>$items,'gradeinfo'=>(object) $gradeinfo);
	}	
}
?>