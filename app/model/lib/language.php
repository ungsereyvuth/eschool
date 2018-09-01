<?php

//include_once("app/model/db.php");



// partern : 

class layout_label{

	public function translated($language){

		//$default_label = array();

		$translated_item = array();

		//$translated_cate = array();		

		$qry = new connectDb;	

		$translated_data = $qry->qry_assoc("select cate.id cate_id,cate.title cate_title,item.id item_id,item.code item_code,CONCAT(UCASE(MID(item.title,1,1)),MID(item.title,2)) item_title,item.content_code item_content_code,item.url item_url,item.icon item_icon,item.data item_data,item.active item_active,

item_s.id item_s_id,item_s.code item_s_code,CONCAT(UCASE(MID(item_s.title,1,1)),MID(item_s.title,2)) item_s_title,item_s.content_code item_s_content_code,item_s.url item_s_url,item_s.icon item_s_icon,item_s.data item_s_data,item_s.active item_s_active,

item_t.title item_t_title,item_s_t.title item_s_t_title

											from layout_text_cate cate 

											left join layout_text_item item on item.cate_id=cate.id

											left join layout_text_item_sub item_s on item_s.item_id=item.id

											left join layout_text_item_t item_t on item_t.item_id=item.id and item_t.language_id=$language

											left join layout_text_item_sub_t item_s_t on item_s_t.item_id=item_s.id and item_s_t.language_id=$language

											where cate.active=1

											order by cate.id,item.priority asc");



		foreach($translated_data as $item_key=>$item_value){

			if($item_value['item_t_title']=='' or $item_value['item_t_title']==NULL){$title = $item_value['item_title'];}else{$title = $item_value['item_t_title'];}

			if($item_value['item_s_t_title']=='' or $item_value['item_s_t_title']==NULL){$title_s = $item_value['item_s_title'];}else{$title_s = $item_value['item_s_t_title'];}

			if(!isset($translated_item[strtolower($item_value['cate_title'])][strtolower($item_value['item_code'])])){

				$translated_item[strtolower($item_value['cate_title'])][strtolower($item_value['item_code'])]  = array('id'=>$item_value['item_id'],

																									'code'=>$item_value['item_code'],

																									'title'=>$title,

																									'content_code'=>$item_value['item_content_code'],

																									'url'=>$item_value['item_url'],

																									'icon'=>$item_value['item_icon'],

																									'data'=>$item_value['item_data'],

																									'active'=>$item_value['item_active']

																								);

			}

			//check sub item

			if($item_value['item_s_id']>0){

				$translated_item[strtolower($item_value['cate_title'])][strtolower($item_value['item_code'])]['sub'][strtolower($item_value['item_s_code'])]  = array('id'=>$item_value['item_s_id'],

																											'code'=>$item_value['item_s_code'],

																											'title'=>$title_s,

																											'content_code'=>$item_value['item_s_content_code'],

																											'url'=>$item_value['item_s_url'],

																											'icon'=>$item_value['item_s_icon'],

																											'data'=>$item_value['item_s_data'],

																											'active'=>$item_value['item_s_active']

																											);

			}else{$translated_item[$item_value['cate_title']][strtolower($item_value['item_code'])]['sub']=array();}

		}

		return json_decode(json_encode($translated_item), FALSE);;

	}	

	

	//get selected langauge code and its list

	public function languagecode($language){

		$qry = new connectDb;

		$lang_data = $qry->qry_assoc("select * from language where active=1");

		$lang_arr = array();

		$lang_code_selected = '';

		foreach($lang_data as $key=>$value){

			$lang_id = $value['id'];

			$lang_code = $value['code'];

			$lang_title = $value['title'];

			$selected = false;

			if($lang_id == $language){$selected = true;$lang_code_selected = $lang_code;}

			$lang_arr[] = array('id'=>$lang_id,'code'=>$lang_code,'title'=>$lang_title,'selected'=>$selected,'default'=>$value['set_default']);

		}	

		//selected default language

		$default_data = $qry->qry_assoc("select id,code,title from language where set_default=1 limit 1");			

		$defaultid = $default_data[0]['id']; $defaultcode = $default_data[0]['code']; $defaultName = $default_data[0]['title'];

			

		return array('selected'=>$lang_code_selected,'id'=>$language,'getlist'=>$lang_arr,'defaultid'=>$defaultid,'defaultcode'=>$defaultcode,'defaultName'=>$defaultName); 

	}

	//layout category

	public function layout_cate(){

		$qry = new connectDb;

		$cate = $qry->qry_assoc("select id,title from layout_text_cate order by id asc");

		return $cate; 

	}

	

	public function activeLanguage($return_id=true){

			//default language from db as language id

			$qry = new connectDb;

			$lang_data = $qry->qry_assoc("select id,code from language where set_default=1 limit 1");			

			$language = $lang_data[0]['id']; $language_code = $lang_data[0]['code'];

			

			if(isset($_GET['url'])){

				$url_text = $_GET['url'];

				$url_parameters = explode("/",$url_text);

				//check if the language code is set in the url. if yes, store it and remove from the array.

				if(strlen($url_parameters[0])==2){

					$language_code = $url_parameters[0];

					unset($url_parameters[0]);

					$url_parameters = array_values($url_parameters);

				}

				//check if language code in the url is valid. if not, set to default.

				$language_check = $qry->qry_assoc("select id from language where code='$language_code' and active=1 limit 1");

				if(count($language_check)==1){$language = $language_check[0]['id']; }

			}

			if($return_id){return $language;}else{return $language_code;}

	}

}



?>