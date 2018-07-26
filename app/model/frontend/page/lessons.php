<?php
class lessons{
	public function data(){
		$qry = new connectDb;$pageExist=false;	

		$items = $breadcrumb=array();

		$level = isset($_GET['level'])?$_GET['level']:'';

		$subjects = array('math'=>array('title'=>'គណិតវិទ្យា'),'biography'=>array('title'=>'ជីវវិទ្យា'),'physics'=>array('title'=>'រូបវិទ្យា'),'chemistry'=>array('title'=>'គីមីវិទ្យា'),'khmer'=>array('title'=>'ភាសាខ្មែរ'),'english'=>array('title'=>'ភាសាអង់គ្លេស'));
		$levels=array('kindergarten'=>array('title'=>'ថ្នាក់មតេយ្យ','grade'=>'0'),'primary'=>array('title'=>'ថ្នាក់បឋមសិក្សា','grade'=>'1,2,3,4,5,6'),'junior'=>array('title'=>'ថ្នាក់អនុវិទ្យាល័យ','grade'=>'7,8,9'),'high'=>array('title'=>'ថ្នាក់វិទ្យាល័យ','grade'=>'10,11,12'));

		if($level<>''){
			if(isset($_GET['grade'])){
				foreach ($subjects as $key => $value) {
					$items[$key] = array('title' => $value['title'],'param'=>"/lesson/view/math");
				}
				$breadcrumb = array('lessons',array('title' => $levels[$level]['title'],'url'=>"/lessons?level=$level" ),array('title' => 'ថ្នាក់ទី '.enNum_khNum($_GET['grade']),'url'=>'#' ));
			}else{
				if(isset($levels[$level])){
					$breadcrumb = array('lessons',array('title' => $levels[$level]['title'],'url'=>'#' ) );
					$grade =  explode(',', $levels[$level]['grade']);
					if(count($grade)>1){
						foreach ($grade as $key => $value) {
							$items[$value] = array('title' => 'ថ្នាក់ទី '.enNum_khNum($value),'param'=>"/lessons?level=$level&grade=$value");
						}
					}else{
						$items = $subjects;
					}
					
				}
			}
			$pageExist=true; 
		}else{
			$breadcrumb = array('lessons');
			$items = $levels;
			$pageExist=true; 
		}


		
		
		
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'items'=>$items);
	}	
}
?>