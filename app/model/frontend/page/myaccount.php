<?php
class myaccount{
	public function data($input){
		global $encryptKey,$usersession,$layout_label,$lang;$qry = new connectDb;
		$pageExist=false;
		$userinfo=array();
		$user_id=$usersession->info()->id;	
		$userinfo = $qry->qry_assoc("select u.*,if('$lang->selected'='kh',l.title_kh,l.title_en) provincecity_name
									from users u
									left join address_provincecity l on l.id=u.provincecity
									where u.id=$user_id limit 1");
		if(!count($userinfo)){goto returnStatus;}
		$userinfo = $userinfo[0];
		
		//natioanlity option
		$nationality='<option value="">'.$layout_label->label->select_option->title.'</option>';
		$nationality_row = $qry->qry_assoc("SELECT id,if('$lang->selected'='kh',title_kh,title_en) title FROM nationality where active=1 order by title_en asc");
		foreach($nationality_row as $key=>$value){
			$nationality.='<option value="'.$value['id'].'" '.($value['id']==$userinfo['nationality']?'selected':'').'>'.$value['title'].'</option>';
		}
		$userinfo['nationality_select']=$nationality;
		//provincecity list
		$provincecity_select='';
		$provincecity_row = $qry->qry_assoc("select *,if('$lang->selected'='kh',title_kh,title_en) provincecity_name from address_provincecity where active=1");
		foreach($provincecity_row as $value){
			$provincecity_select.='<option value="'.$value['id'].'" '.($value['id']==$userinfo['provincecity']?'selected':'').'>'.$value['provincecity_name'].'</option>';
		}
		$userinfo['provincecity_select']=$provincecity_select;

		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'input'=>$input,'userinfo'=>(object) $userinfo);
	}
}
?>