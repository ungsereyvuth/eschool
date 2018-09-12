<?php
class user_testresultlist{
	public function data($input){
		$qry = new connectDb;global $usersession;
		$pageExist=false;
	
		$txt_search = '<div class="col-sm-6 col-md-3"><div class="input-group input-group-sm"><input type="text" class="form-control searchinputs" id="txt_search" placeholder="Search keyword"><span class="input-group-btn btn_search"><button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button></span></div></div>';
		
		$search_inputs = '<div class="row">'.$txt_search.'</div>';
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'input'=>$input,'search_inputs'=>$search_inputs);
	}	
}
?>