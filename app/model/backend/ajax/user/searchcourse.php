<?php
class searchcourse{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;$userid=$usersession->info()->id;

		$web_config = web_config(array('profile_pic_path','no_pic'));
		$picPath = $web_config['profile_pic_path'];$no_pic = $web_config['no_pic'];
		
		$qryData = (object) $_POST["qryData"];	
		$sql_condition = '';
		if(isset($qryData->grade_subject_id) and is_numeric($qryData->grade_subject_id)){$sql_condition.=" and s.grade_subject_id=$qryData->grade_subject_id";}
		//if(is_numeric($qryData->status)){$sql_condition.=" and c.active=$qryData->status";}

		$no_data='';
		if($qryData->txt_search<>''){$sql_condition.=" and (c.title like '%$qryData->txt_search%' or u.fullname_kh like '%$qryData->txt_search%' or c.course_code = '".khNum_enNum($qryData->txt_search,true)."')";}
		else{$no_data='សូមបញ្ចូលលេខកូដវគ្គសិក្សា';$sql_condition.=" and 1=0";}
			
		$sql_statement = "select s.*,c.id course_id,c.title coursename,c.course_code,u.fullname_kh teachername,u.photo teacherphoto from es_course_subject s 
						left join es_course c on c.id=s.course_id 
						left join users u on u.id=c.teacher_id
						left join user_role r on r.id=u.role_id
						where s.active=1 and c.active=1 and u.active=1 and r.code='teacher' $sql_condition
						order by s.created_date desc";						
		extract(generateList($language,intval(post("currentPage")),post("rowsPerPage"),post("navAction"),$sql_statement));
		$dataListString = '';$i=$startIndex+1;
		foreach($rowData as $key=>$value){	
			$photo=$picPath.$value['teacherphoto'];
            if($photo<>$picPath){$photo = !file_exists($_SERVER['DOCUMENT_ROOT'].$photo)?$no_pic:$photo;}else{$photo =$no_pic;}	

            //course info url
            $course_url = $layout_label->label->user_courseinfo->url.'/'.encode($value['course_id'].'_'.time()).'&s='.encode($value['id']);

			$dataListString .= '<div class="clearfix v_mgn5 bg-gradient-2">
	                                <div class="col-xs-4 col-xs-3 h_pad0">
	                                    <img class="img-responsive bg_pic_cover fullwidth profile-pic" src="/assets/frontend/img/blank_img_square.png" style="background-image:url('.$photo.');">
	                                </div>
	                                <div class="col-xs-8 col-xs-9 h_pad0">
	                                    <a href="'.$course_url.'">
	                                        <div class="pad5 fs12">
	                                            <span class="darkgoldenrodcolor">'.$value['teachername'].'</span>
	                                            <hr class="v_mgn0" />
	                                            <div class="v_pad3 fs10 darkblue">'.$value['coursename'].'</div>
	                                            <div class="fs10 darkblue">Code: '.$value['course_code'].'</div>
	                                        </div>
	                                    </a>
	                                </div>
	                            </div>';
			
			$i++;
		}
		$no_data = $no_data==''?($layout_label->label->no_data->icon.' '.$layout_label->label->no_data->title):$no_data;
		if($dataListString == ''){$dataListString = '<tr><td colspan="'.$qryData->col.'" style="text-align:center; color:#c0434d;">'.$no_data.'</td></tr>';}
		$data = array('list'=>$dataListString,'listNavInfo'=>($totalPages>0?$list_nav_info:$no_data),'targetPage'=>$targetPage,'totalPages'=>$totalPages,'gotoSelectNum'=>$gotoSelectNum,'nav_btn_disable'=>$nav_btn_disable,'totalRow'=>$totalRow);	
		echo json_encode($data);	
	}
}	



?>