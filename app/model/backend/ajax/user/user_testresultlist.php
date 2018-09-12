<?php
class user_testresultlist{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;$userid=$usersession->info()->id;
		
		$qryData = (object) $_POST["qryData"];	
		$sql_condition = '';
		//if(is_numeric($qryData->status)){$sql_condition.=" and c.active=$qryData->status";}
		if($qryData->txt_search<>''){$sql_condition.=" and (l.title like '%$qryData->txt_search%')";}
			
		$sql_statement = "select r.*,e.lesson_id,l.title lessonname,s.title subjectname from es_exam_result r 
						left join es_exam e on r.exam_id=e.id
						left join es_exam_type t on e.exam_type_id=t.id
						left join es_lesson l on e.lesson_id=l.id
						left join es_course_subject s on e.course_subject_id=s.id
						where r.student_id=".$usersession->info()->id." and r.active=1 and e.active=1 and s.active=1 $sql_condition
						order by COALESCE(r.end_datetime,r.start_datetime) desc";						
		extract(generateList($language,intval(post("currentPage")),post("rowsPerPage"),post("navAction"),$sql_statement));
		$dataListString = '';$i=$startIndex+1;
		foreach($rowData as $key=>$value){	

			if($value['finished']){
                $result_url = $layout_label->label->user_testresult->url.'/'.encodeString($value['id'],$encryptKey);
            }else{
                $result_url = $layout_label->label->user_dotest->url.'/'.encodeString($value['id'],$encryptKey);
            }
            
            $lessonname = $value['lesson_id']?$value['lessonname']:'គ្រប់មេរៀន';
            $resultq = enNum_khNum(($value['correctq']?$value['correctq']:0).'/'.$value['totalq']);
            $status_btn = $value['finished']?'<span class="label label-success pull-right tooltips" title="បានបញ្ចប់"><i class="fa fa-check"></i></span>':'<span class="label label-warning pull-right tooltips" title="មិនទាន់បានបញ្ចប់"><i class="fa fa-clock-o"></i></span>';
            $dataListString .= '<a href="'.$result_url.'"><div class="quiz_item alert alert-info khmertitle v_mgn3 fs12">
                    <div><span class="tooltips" title="មេរៀនទី១">'.$lessonname.'</span> '.$status_btn.'</div>
                    <hr class="v_mgn3" />
                    <div class="fs11">'.khmerDate($value['start_datetime'],'full_dt').'<code class="pull-right">'. $resultq.'</code></div>
                </div></a>';
            $i++;
		}
		$no_data = $layout_label->label->no_data->icon.' '.$layout_label->label->no_data->title;
		if($dataListString == ''){$dataListString = '<tr><td colspan="'.$qryData->col.'" style="text-align:center; color:#c0434d;">'.$no_data.'</td></tr>';}
		$data = array('list'=>$dataListString,'listNavInfo'=>($totalPages>0?$list_nav_info:$no_data),'targetPage'=>$targetPage,'totalPages'=>$totalPages,'gotoSelectNum'=>$gotoSelectNum,'nav_btn_disable'=>$nav_btn_disable,'totalRow'=>$totalRow);	
		echo json_encode($data);	
	}
}	



?>