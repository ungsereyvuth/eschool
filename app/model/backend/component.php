<?php

class slider{
	public function data(){	
		
		return array('info'=>'slider');
	}	
}
class frontend_menu{
	public function data(){		
		global $usersession;	
		$qry = new connectDb;
		
		return (object) array();
	}	
}
class topinfo{
	public function data(){	
		global $usersession;	
		$qry = new connectDb;
		
		//get footer content
		$contents = content(array('footer_contact','powered_by'));
		
		return (object) array('total_unread'=>isset($total_unread)?$total_unread:0,'contents'=>(object) $contents);
	}	
}

class breadcrumb{
	public function data(){	
		
		return array('info'=>'topinfo');
	}	
}

class sidebar{
	public function data(){	
		
		return array('info'=>'topinfo');
	}	
}

class user_menu{
	public function data($input){	
		global $usersession;		
		return pageControlItems($usersession->info()->privileges,1,1,1);
	}	
}

class language_switch{
	public function data(){
		global $usersession,$layout_label,$lang;
		$qry = new connectDb;
		
		$language_btn= '';
		foreach($lang->getlist as $key=>$value){			
			if($value['selected']){
				$language_btn.= '<div class="flag_icon flag_active"><img src="/assets/frontend/img/flags/'.$value['code'].'.png" height="15" class="tooltips" title="'.$value['title'].'" /></div>';
			}else{
				$language_btn.= '<div class="flag_icon"><a href="/'.$value['code'].(orginUrl()==''?'':'/'.orginUrl()).'"><img src="/assets/frontend/img/flags/'.$value['code'].'.png" height="15" class="tooltips" title="'.$value['title'].'" /></a></div>';	
			}
		}
		
		return $language_btn;
	}	
}


?>