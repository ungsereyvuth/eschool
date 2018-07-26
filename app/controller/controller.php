<?php
include_once("app/model/db.php");
include_once("app/model/language.php");
//layout text category
$layout = new layout_label;
$language = $layout->activeLanguage();
$language_code = $layout->activeLanguage(false);
$layout_cate = (object) ($layout->layout_cate());
$layout_label = (object) ($layout->translated($language));
$lang = (object) $layout->languagecode($language);
include_once("app/model/functions.php");
include_once("app/model/checklogin.php");
include_once("app/model/checksession.php");
//app variables
$usersession = new usersession($language); //isLoign(),info()
include_once("app/model/phpExcel/standardReport.php");
//include_once("app/model/upload.php");

class application{
	public function run(){	
		global $usersession,$layout_cate,$encryptKey,$language,$language_code;

		$url_text = isset($_GET['url'])?$_GET['url']:'';
		$url_parameters = explode("/",$url_text);
		//check if the language code is set in the url. if yes, store it and remove from the array.
		if(strlen($url_parameters[0])==2){
			$url_text = str_replace(array($url_parameters[0].'/',$url_parameters[0]),'',$url_text);
			unset($url_parameters[0]);$url_parameters = array_values($url_parameters);
		}
		if($url_text==''){$url_parameters[0]='home';}//if no query string, set class home as default

		

		$qry = new pageController;
		$pageData = $qry->data($url_parameters); 
		$dir = $pageData->dir; $more_dir = $pageData->more_dir; 
		$fileview = 'app/view/'.$dir.'content/'.$more_dir.$pageData->fileview.'.php';		
		
		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$fileview)) { 
			if($pageData->layoutRequired){include 'app/view/'.$dir.'stdPage.php';
			}else{include $fileview;}
		}
	}
}

class pageController{
	public function data($param){ 
		global $usersession,$layout_label,$lang,$encryptKey;
		$qry = new connectDb; $content=$page_com=array();$dir = 'frontend/';$more_dir='';
		$request_data = array();$inherited = '';
		//-------- start preparing request page code ---------------
		if(count($param)==1){$getClassName = addslashes($param[0]);}else{
			$getClassName = $param[0].'_'.$param[1];
			foreach($param as $key=>$value){if($key>1){$request_data[] = $value;}}
		}		
		//-------- start checking page validity --------------- -> also check if there is inherited class for the page instead of it std name
		$checkpage = $qry->qry_assoc("select id,dir,is_ajax,is_webpage,is_backend,inherited from layout_page_controller where model='$getClassName' and active=1");
		$pagevalid = count($checkpage)?true:false;
		if(!$pagevalid){$getClassName='pagenotfound';$request_data='';}else{
			$inherited = $checkpage[0]['inherited'];$more_dir=$checkpage[0]['dir'];
			$dir=$checkpage[0]['is_backend']?'backend/':$dir;
		}
		$adjust_classname = $inherited<>''?$inherited:$getClassName;
		if ($pagevalid and $checkpage[0]['is_webpage'] and file_exists($_SERVER['DOCUMENT_ROOT']."/app/model/".$dir."page/".$more_dir.$adjust_classname.".php")) { 
			include_once("app/model/".$dir."page/".$more_dir.$adjust_classname.".php");
		}
		if ($pagevalid and $checkpage[0]['is_ajax'] and file_exists($_SERVER['DOCUMENT_ROOT']."/app/model/".$dir."ajax/ajax_controller.php")) { 
			include_once("app/model/".$dir."ajax/ajax_controller.php");$request_data['dir'] = $dir;
		}		
		if(!class_exists($adjust_classname)){$getClassName=$adjust_classname='pagenotfound';$request_data='';}
		//-------- start checking page property --------------- -> although inherited class is defined but still keep original page properties/components
		$page_config = $qry->qry_assoc("select * from layout_page_controller where model='$getClassName' and active=1");
		$page_config = $page_config[0]; 
		//check page authentication
		if($page_config['required_login'] and $getClassName<>'ajax_request' and $getClassName<>'admin_ajax_request'){//if ajax, no need check authentication here. ajax can check it own
			if($usersession->isLogin()){ 
				$privileges = explode(',',$usersession->info()->privileges);
				if(!in_array($page_config['id'],$privileges)){$getClassName=$adjust_classname='pagenotfound';$request_data='';}
			}else{goto setObj;}
		}
		//-------- start rechecking page validty and exclude ajax request --------------- -> get output from inherited class if defined, otherwise get from its std class
		$classData = new $adjust_classname;   
		$content = (object) $classData->data($request_data);
		if($getClassName<>'ajax_request' and $getClassName<>'admin_ajax_request' and $getClassName<>'admin_ajax_realtimeupload' and isset($content->pageExist) and !$content->pageExist){ 
			$getClassName='pagenotfound';
			$classData = new $getClassName;
			$content = (object) $classData->data();
			$page_config = $qry->qry_assoc("select * from layout_page_controller where model='$getClassName' and active=1");
			$page_config = $page_config[0];
		}
		//-------- start getting page components --------------- -> components from std page (not inherited page)
		$page_com = array();
		if($page_config['components']<>''){
			$components = $page_config['components'];
			$page_com_data = $qry->qry_assoc("select * from layout_page_component where id IN ($components) and active=1");
			include_once("app/model/".$dir."component.php");
			foreach($page_com_data as $key=>$value){
				$com_data = new $value['component_name'];
				$page_com[$value['component_name']]=$com_data->data($request_data);
			}
		}
		//-------- start define page properties ---------------
		setObj:
		$obj = new stdClass();
		$obj->loginRequired = $page_config['required_login'];
		$obj->logoutRequired = $page_config['required_logout'];
		$obj->layoutRequired = $page_config['required_layout'];
		$obj->lang = $lang;
		$obj->label = (object) $layout_label;
		$obj->page = isset($content->breadcrumb)?$content->breadcrumb:array($getClassName);
		$obj->fileview =$getClassName;
		$obj->more_dir =$more_dir;
		$obj->dir =$dir;
		$obj->data = (object) array('content'=> $content,'component'=>(object) $page_com);	
		return $obj;
	}	
}

class pagenotfound{
	public function data($msg=''){
		global $usersession,$layout_label,$lang;		
		if($msg==''){$msg='Sorry! page your requested not exists!';}				
		return (object) array('title'=>'Page Not Found','des'=>$msg);
	}	
}
?>