<?php
class documents{
	public function data($input){
		$qry = new connectDb;global $usersession,$lang;
		$pageExist=false;
		
		$date_from = '<div class="col-sm-3"><label>From Date</label><div class="input-append input-group input-group-sm dtpicker_notstrick">
											<input data-format="yyyy-MM-dd" id="date_from" type="text" placeholder="YY-MM-DD" class="form-control searchinputs">
											<span class="input-group-addon add-on"><i data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar" class="fa fa-calendar"></i></span>
										</div></div>';
		$date_to = '<div class="col-sm-3"><label>To Date</label><div class="input-append input-group input-group-sm dtpicker_notstrick">
											<input data-format="yyyy-MM-dd" id="date_to" type="text" placeholder="YY-MM-DD" class="form-control searchinputs">
											<span class="input-group-addon add-on"><i data-time-icon="fa fa-clock-o" data-date-icon="fa fa-calendar" class="fa fa-calendar"></i></span>
										</div></div>';			
		$txt_search = '<div class="col-sm-3 v_pad5"><label>Keyword</label><div class="input-group input-group-sm"><input type="text" class="form-control searchinputs" id="txt_search" placeholder="Search keyword"><span class="input-group-btn btn_search"><button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button></span></div></div>';
		
		$search_inputs = '<div class="row">'.$date_from.$date_to.$txt_search.'</div>';
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'input'=>$input,'search_inputs'=>$search_inputs);
	}		
}
?>