<?php

class slider{
	public function data(){	
		
		return array('info'=>'slider');
	}	
}
class frontend_menu{
	public function data($input){	
		global $usersession,$layout_label;
		$qry = new connectDb;	

		$grades=array();
		$grade_row = $qry->qry_assoc("select gg.*,g.id gradeid,g.title gradename,g.subject_ids from es_grade_group gg 
										left join es_grade g on g.grade_group_id=gg.id and g.active=1
										where gg.active=1");
		foreach ($grade_row as $key => $value) {
			$value['subjects']= $qry->qry_assoc("select * from es_grade_subject where id in (".$value['subject_ids'].") and active=1");			
			$grades[$value['id']][]=$value;
		}
		
		//return $layout_label->menu;
		return $grades;
	}	
}
class topinfo{
	public function data(){	
		global $usersession;	
		$qry = new connectDb;
		
		if($usersession->isLogin()){
			//unread message
			$recipient_id=$usersession->info()->code=='admin'?'NULL':$usersession->info()->id;
			$total_unread = $qry->qry_count("SELECT id from message where recipient_id=$recipient_id and seen=0 and active=1");
		}
		
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
		global $usersession,$lang;
		$qry = new connectDb;
		$doc = $qry->qry_assoc("SELECT * from documents where active=1 order by created_date desc limit 15 ");
		
		$user_menu='';
		if($usersession->isLogin()){
			$user_menu =pageControlItems($usersession->info()->privileges,'',1,1);
		}
		
		//get license category list
		$license_cate = $qry->qry_assoc("SELECT id,if('$lang->selected'='kh',title_kh,title_en) title from license_category where active=1 order by id");
		
		//note		 
		$content = content(array('security_maintenance'));
		$security_maintenance = $content['security_maintenance'];
		
		return (object) array('doc'=>$doc,'license_cate'=>$license_cate,'user_menu'=>$user_menu,'note'=>(object) $security_maintenance);
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