<?php
class user_coursemgmt{
	public function data($input){
		$qry = new connectDb;global $usersession;
		$pageExist=false;
		
		$course_year = $qry->qry_assoc("select year from es_course where active=1 group by year order by year");
		$existing_year=$add_year='';$minyear=$lastyear=date("Y");
		foreach($course_year as $key=>$value){
			$minyear=!$key?$value['year']:$minyear;
			$lastyear=$key==(count($course_year)-1)?$value['year']:$lastyear;
			$existing_year.='<option value="'.$value['year'].'">'.$value['year'].'</option>';
		}
		$extend_year=3;
		for($i=($minyear-$extend_year);$i<=($lastyear+$extend_year);$i++){
			$add_year.='<option value="'.$i.'">'.$i.'</option>';
		}
		$year_select = '<div class="col-sm-6 col-md-3"><select class="form-control input-sm searchinputs" id="year_select">
							<option value="">--- All Years---</option>
							'.$existing_year.'
						</select></div>';					
						
		$status = '<div class="col-sm-6 col-md-3"><select class="form-control input-sm searchinputs" id="status">
							<option value="">--- All Status ---</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select></div>';		
		$txt_search = '<div class="col-sm-6 col-md-3"><div class="input-group input-group-sm"><input type="text" class="form-control searchinputs" id="txt_search" placeholder="Search keyword"><span class="input-group-btn btn_search"><button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button></span></div></div>';

		//get grade
		$gid=0;$gradetitle='';
		if(isset($_GET['gid'])){ $gid=decode($_GET['gid']);}
		$grade_options = '';$group='';
		$grades = $qry->qry_assoc("select g.*,gp.title group_title,gp.id group_id from es_grade g 
									left join es_grade_group gp on gp.id=g.grade_group_id 
									where gp.active=1 and g.active=1");
		foreach($grades as $value){
			if($group==''){$grade_options .= '<optgroup label="'.$value['group_title'].'">';}elseif($group<>$value['group_id']){$grade_options .= '</optgroup><optgroup label="'.$value['group_title'].'">';}
			if($gid==$value['id']){$selected=true;$gradetitle=$value['title'];}else{$selected=false;}
			$grade_options .= '<option value="'.$value['id'].'" '.($selected?'selected':'').'>- '.$value['title'].'</option>';

			$group=$value['group_id'];
		}
		$grade_options .= '</optgroup>';

		//search by grade
		$search_grade = '<div class="col-sm-6 col-md-3"><select class="form-control input-sm searchinputs" id="search_grade">
							<option value="">--- All Grades ---</option>
							'.$grade_options.'
						</select></div>';
		
		$search_inputs = '<div class="row">'.$year_select.$search_grade.$status.$txt_search.'</div>';
		

		$breadcrumb = array('user_coursemgmt');
		if($gradetitle<>''){$breadcrumb[]=array('title'=>$gradetitle,'url'=>'#');}

		$pageExist=true;
		returnStatus:
		return array('pageExist'=>$pageExist,'breadcrumb'=>$breadcrumb,'input'=>$input,'search_inputs'=>$search_inputs,'grade_options'=>$grade_options,'add_year'=>$add_year);
	}	
}
?>