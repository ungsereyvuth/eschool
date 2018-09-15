<?php
class user_testresultlist{
	public function data($input){
		$qry = new connectDb;global $usersession;
		$pageExist=false;

		$isStudent=false;
		if(isThisUserRole($usersession->info()->id,'student')){$isStudent=true;}

		//get basic statistic
		$statistic=array();
		if($isStudent){
			$statistic = $qry->qry_assoc("select AVG((correctq/totalq)*100) avg,min((correctq/totalq)*100) min,max((correctq/totalq)*100) max, max(start_datetime) max_date from es_exam_result where student_id=".$usersession->info()->id." and active=1");
			if(count($statistic)){$statistic=$statistic[0];}
		}

		$date_from = '<div class="col-sm-6 col-md-3">
							<div class="input-group">
								<input type="text" placeholder="From Date" class="form-control input-sm datepicker searchinputs" data-dateformat="yy-mm-dd" id="date_from">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>';
		$date_to = '<div class="col-sm-6 col-md-3">
						<div class="input-group">
								<input type="text" placeholder="To Date" class="form-control input-sm datepicker searchinputs" data-dateformat="yy-mm-dd" id="date_to">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
					</div>';

		$txt_search = '<div class="col-sm-6 col-md-3"><div class="input-group input-group-sm"><input type="text" class="form-control searchinputs" id="txt_search" placeholder="Search keyword"><span class="input-group-btn btn_search"><button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button></span></div></div>';
		
		$search_inputs = '<div class="row">'.$date_from.$date_to.$txt_search.'</div>';
		
		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'input'=>$input,'search_inputs'=>$search_inputs,'statistic'=> (object) $statistic);
	}	
}
?>