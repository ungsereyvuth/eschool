<?php
class admin_user{
	public function data($input){
		global $encryptKey,$usersession;$qry = new connectDb;
		$pageExist=false;
		$userinfo=array();
		if(!isset($input[0])){
			$user_id=$usersession->info()->id;
		}elseif(!is_numeric(decodeString($input[0],$encryptKey)) or (!isAdmin($usersession->info()->id) and !isThisUserRole($usersession->info()->id,'officer'))){goto returnStatus;}
		else{$user_id=decodeString($input[0],$encryptKey);}
		
		
		$userinfo = $qry->qry_assoc("select u.*,role.title role_name,l.title_kh provincecity_name,off_l.title approval_level_title,dep.title_kh dep_title,off.selected_license_categories, if(off.id>0,1,0) isApprovalUser 
									from users u
									left join user_role role on role.id=u.role_id
									left join address_provincecity l on l.id=u.provincecity
									left join license_approval_user off on off.user_id=u.id and off.active=1
									left join license_approval_level off_l on off_l.id=off.level_id
									left join license_approval_department dep on dep.id=off_l.approval_department_id
									where u.id=$user_id limit 1");
				
		if(!count($userinfo)){goto returnStatus;}
		$userinfo = $userinfo[0];		
		//get license category by account
		$userinfo['responsible_license']=array();
		$cate_cond = $userinfo['selected_license_categories']<>''?(" and id IN (".$userinfo['selected_license_categories'].")"):"";
		$cate = $qry->qry_assoc("select id,title_kh catename from license_category where active=1".$cate_cond);
		if(count($cate)){$userinfo['responsible_license']=$cate;}
		//var_dump($userinfo);
		
		//provincecity list
		$provincecity_select='<option value="">--- Select ---</option>';
		$provincecity_row = $qry->qry_assoc("select *,title_kh title from address_provincecity where active=1");
		foreach($provincecity_row as $value){
			$provincecity_select.='<option value="'.$value['id'].'" '.($value['id']==$userinfo['provincecity']?'selected':'').'>'.$value['title'].'</option>';
		}
		$userinfo['provincecity_select']=$provincecity_select;

		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'input'=>$input,'userinfo'=>(object) $userinfo);
	}	
}
?>