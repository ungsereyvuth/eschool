<?php
class admin_languagemanagement{
	public function data($input){
		$qry = new connectDb;global $usersession;
		$pageExist=false;
		
		$cate_options='';
		$item_row = $qry->qry_assoc("select * from layout_text_cate where active=1 order by title");
		foreach($item_row as $value){
			$cate_options.='<option value="'.$value['id'].'">'.$value['title'].'</option>';
		}
		
		$language_options='';
		$item_row = $qry->qry_assoc("select * from language where active=1 and code<>'en' order by priority");
		foreach($item_row as $value){
			$language_options.='<option value="'.$value['id'].'">'.$value['title'].'</option>';
		}	
		
		$language_input = '<div class="col-sm-6 col-md-3"><label>Langauge</label><select class="form-control input-sm searchinputs" id="lang_id">
							<option value="">--- All ---</option>'.$language_options.'</select></div>';		
		
		$type_input = '<div class="col-sm-6 col-md-3"><label>Page Type</label><select class="form-control input-sm searchinputs" id="type_id">
							<option value="">--- All ---</option>'.$cate_options.'</select></div>';						
							
		$forPage = '<div class="col-sm-6 col-md-3"><label>For Page</label><select class="form-control input-sm searchinputs" id="for_page">
							<option value="">--- All ---</option>
							<option value="1">For Page</option>
							<option value="0">Not For Page</option>
						</select></div>';		
		$status = '<div class="col-sm-6 col-md-3"><label>Status</label><select class="form-control input-sm searchinputs" id="status">
							<option value="">--- All ---</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select></div>';		
		$txt_search = '<div class="col-sm-6 col-md-3"><label>Keyword</label><div class="input-group input-group-sm"><input type="text" class="form-control searchinputs" id="txt_search" placeholder="Search keyword"><span class="input-group-btn btn_search"><button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button></span></div></div>';
		
		$search_inputs = '<div class="row">'.$type_input.$language_input.$forPage.$status.$txt_search.'</div>';
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'input'=>$input,'search_inputs'=>$search_inputs,'cate_options'=>$cate_options,'language_options'=>$language_options);
	}	
}
?>