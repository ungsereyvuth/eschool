<?php
class user_coursemgmt{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;$userid=$usersession->info()->id;
		
		$qryData = (object) $_POST["qryData"];	
		$sql_condition = '';
		if($qryData->year_select<>''){$sql_condition.=" and c.year=$qryData->year_select";}
		if(is_numeric($qryData->status)){$sql_condition.=" and c.active=$qryData->status";}
		if($qryData->txt_search<>''){$sql_condition.=" and (c.title like '%$qryData->txt_search%')";}
			
		$sql_statement = "SELECT c.*,count(COALESCE(s.id,NULL)) total_subject from es_course c 
							left join es_course_subject s on s.course_id=c.id and s.active=1
							where c.teacher_id=$userid  $sql_condition 
							group by c.id
							order by c.created_date";						
		extract(generateList($language,intval(post("currentPage")),post("rowsPerPage"),post("navAction"),$sql_statement));
		$dataListString = '';$i=$startIndex+1;
		foreach($rowData as $key=>$value){	
			$url = $layout_label->label->user_course->url.'/'.encodeString($value['id'],$encryptKey);
			$dataListString .= '<tr>
									<td class="txtCenter" style="width:30px;">'.enNum_khNum($i).'</td>
									<td>
										<a href="'.$url.'"><span class="tooltips mgn0 fs14" title="'.$value['title'].'">'.$value['title'].'</span></a>
										<div class="sub-info">
											<span class="tooltips fs11" title="Total subject"><i class="fa fa-clock-o"></i> មុខជ្ជា '.$value['total_subject'].' មុខវិជ្ជា</span>
											<span class="tooltips fs11" title="'.$value['created_date'].'"><i class="fa fa-clock-o"></i> '.khmerDate($value['created_date']).'</span>
										</div>
									</td>

									<td class="txtCenter"></td></tr>';
			
			$i++;
		}
		$no_data = $layout_label->label->no_data->icon.' '.$layout_label->label->no_data->title;
		if($dataListString == ''){$dataListString = '<tr><td colspan="'.$qryData->col.'" style="text-align:center; color:#c0434d;">'.$no_data.'</td></tr>';}
		$data = array('list'=>$dataListString,'listNavInfo'=>($totalPages>0?$list_nav_info:$no_data),'targetPage'=>$targetPage,'totalPages'=>$totalPages,'gotoSelectNum'=>$gotoSelectNum,'nav_btn_disable'=>$nav_btn_disable);	
		echo json_encode($data);	
	}
}	



?>