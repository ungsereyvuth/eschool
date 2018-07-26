<?php
class lesson_view{
	public function data($input){
		$qry = new connectDb;$pageExist=false;	

		$breadcrumb=array();

		$subjects = array('math'=>array('title'=>'គណិតវិទ្យា'),'biography'=>array('title'=>'ជីវវិទ្យា'),'physics'=>array('title'=>'រូបវិទ្យា'),'chemistry'=>array('title'=>'គីមីវិទ្យា'),'khmer'=>array('title'=>'ភាសាខ្មែរ'),'english'=>array('title'=>'ភាសាអង់គ្លេស'));
		$levels=array('kindergarten'=>array('title'=>'ថ្នាក់មតេយ្យ','grade'=>'0'),'primary'=>array('title'=>'ថ្នាក់បឋមសិក្សា','grade'=>'1,2,3,4,5,6'),'junior'=>array('title'=>'ថ្នាក់អនុវិទ្យាល័យ','grade'=>'7,8,9'),'high'=>array('title'=>'ថ្នាក់វិទ្យាល័យ','grade'=>'10,11,12'));

		

		if(isset($input[0]) and isset($subjects[$input[0]])){
			$breadcrumb = array('lessons',array('title' => $levels['primary']['title'],'url'=>"/lessons?level=primary" ),array('title' => 'ថ្នាក់ទី '.enNum_khNum(5),'url'=>'/lessons?level=primary&grade=5' ),array('title' => $subjects[$input[0]]['title'],'url'=>'#' ));
			$pageExist=true; 
		}
		
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb);
	}	
}
?>