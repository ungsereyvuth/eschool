<?php
class dashboard{
	public function data($input){
		$qry = new connectDb;global $usersession,$lang,$encryptKey;
		$pageExist=false;$user_id = $usersession->info()->id;
		
		
		//license main category
		$license_category = '';
		$license_cate = $qry->qry_assoc("select *,if('$lang->selected'='kh',title_kh,title_en) title from license_category where active=1");
		foreach($license_cate as $key=>$value){
			$license_category .= '<option value="'.encodeString($value['id'].'_'.time(),$encryptKey).'">'.$value['title'].'</option>';
		}
		
		//license count sumarry
		$datarow = $qry->qry_assoc("select p.id model_id,p.model,txt.id txt_id,if(t.title='' or t.title IS NULL,txt.title,t.title) title,txt.data,txt.url from layout_page_controller p
									left join layout_text_item txt on txt.id=p.page_id 
									left join layout_text_item_t t on t.item_id=txt.id and t.language_id=$lang->id
									where p.parent_id=(select id from layout_page_controller where model='license_history' limit 1) and p.active=1 order by p.ordering asc");		
		$appStatusCate = $datarow;$numLength=2;
		foreach($datarow as $key => $value){
			$listname = $value['model'];$css='';
			if($listname=='license_p'){
				$css='alert-blocks-pending';
				$listcond = "and l.approving_level>0 and l.approval_completed=0 and l.rejected=0";
			}elseif($listname=='license_a'){
				$css='alert-blocks-success';
				$listcond = "and l.approving_level>=0 and l.approval_completed=1";
			}elseif($listname=='license_e'){
				$css='alert-blocks-error';
				$listcond = "and l.approving_level>0 and l.approval_completed=1 and l.license_end_date<'".date("Y-m-d")."'";
			}elseif($listname=='license_d'){
				$css='';
				$listcond = "and l.approving_level=0 and l.approval_completed=0 and l.rejected=0";
			}elseif($listname=='license_r'){
				$css='alert-blocks-error';
				$listcond = "and l.rejected=1 and l.approval_completed=0";
			}elseif($listname=='license_list'){
				$css='alert-blocks-info';
				$listcond = "and (l.approving_level>0 or (l.approving_level=0 and l.approval_completed=1))";
			}
			$appStatusCate[$key]['css'] = $css;
			$appStatusCate[$key]['count'] = $qry->qry_count("SELECT l.* from license l where l.user_id=".$usersession->info()->id." $listcond order by l.license_start_date desc");	
			$numLength=(strlen($appStatusCate[$key]['count'])>$numLength)?strlen($appStatusCate[$key]['count']):$numLength;
		}
		
		//license notification =>if cateid=2, show user fullname (guide), else biz name
		$notif = $qry->qry_assoc("	select n.id notif_id,n.license_id,n.form_id,n.msg,n.created_date,if('$lang->selected'='kh',if(l.license_cate_id=2,u.fullname_kh,l.biz_name_kh),if(l.license_cate_id=2,u.fullname_en,l.biz_name_en)) biz_name from license_notification n 
										left join license l on l.id=n.license_id
										left join users u on u.id=l.user_id
										where l.user_id=$user_id and n.active=1 
										order by n.created_date desc
										limit 8");
		
		//var_dump($notif);
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'license_category'=>$license_category,'appStatusCate'=>$appStatusCate,'notif'=>$notif,'numLength'=>$numLength);
	}	
}
?>