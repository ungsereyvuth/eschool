<?php
include_once("app/model/admin/model.php");
include_once("app/model/language.php");
include_once("app/model/checklogin.php");
include_once("app/model/checksession.php");
include_once("app/model/admin/ajax.php");

//app variables
$usersession = new usersession(getLanguage()); //isLoign(),info()
//layout text category
$layout = new layout_label;
$layout_cate = (object) ($layout->layout_cate());

class application{
	public function run(){	
		global $usersession,$layout_cate,$encryptKey;
		if(isset($_GET['url'])){
			$url_text = $_GET['url'];
			$url_parameters = explode("/",$url_text);$pagenotfound='page_not_found';
			//check if the language code is set in the url. if yes, store it and remove from the array.
			if($url_parameters[0]=='admin'){
				$url_text = str_replace($url_parameters[0].'/','',$url_text);
				unset($url_parameters[0]);
				$url_parameters = array_values($url_parameters);				
				
			}
			$language = getLanguage();
			
			if(count($url_parameters)==0 or $url_text == ''){
				header("location: /");
			}elseif($url_parameters[0]=='layout_label' and count($url_parameters)==1){				
				$qry = new layout_labelpage;
				$pageData = $qry->data();				
				if(in_array($pagenotfound,$pageData->page)){include 'app/view/admin/pages/pagenotfound.php';  }
				 else{include 'app/view/admin/pages/layout_label.php'; }
			}elseif($url_parameters[0]=='layout_label' and count($url_parameters)==2){				
				$qry = new layout_labelpage_sub;
				$pageData = $qry->data($url_parameters[1]); 			
				if(in_array($pagenotfound,$pageData->page)){include 'app/view/admin/pages/pagenotfound.php';  }
				 else{include 'app/view/admin/pages/layout_label_sub.php'; }
			}elseif($url_text=='ajax/request'){		
				$qry = new ajaxRequest;
				return $qry->data(); 
			}else{
				$this->pagenotfound();
			}
		}else{
			header("location: /kh");
		}
	}
	
	public function pagenotfound(){
		global $usersession,$layout_cate,$encryptKey;
		$qry = new pagenotfound;
		$pageData = $qry->data();
		include 'app/view/admin/pages/pagenotfound.php';  
	}	
	
}
?>