<?php
class flipcardlist{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;$userid=$usersession->info()->id;
		
		$qryData = (object) $_POST["qryData"];	
		$sql_condition = '';
		if(isset($qryData->lesson_id) and is_numeric($qryData->lesson_id)){$sql_condition.=" and f.lesson_id=$qryData->lesson_id";}
		//if(is_numeric($qryData->status)){$sql_condition.=" and c.active=$qryData->status";}
		if($qryData->txt_search<>''){$sql_condition.=" and (f.front like '%$qryData->txt_search%' or f.back like '%$qryData->txt_search%')";}
			
		$sql_statement = "SELECT f.*,l.title lessontitle,l.id lesson_id,s.id subject_id from es_flipcard f 
							left join es_lesson l on l.id=f.lesson_id 
							left join es_course_subject s on s.id=l.subject_id
							where f.active=1 and l.active=1 $sql_condition 
							order by f.ordering";						
		extract(generateList($language,intval(post("currentPage")),post("rowsPerPage"),post("navAction"),$sql_statement));
		$dataListString = '';$i=$startIndex+1;
		foreach($rowData as $key=>$value){	
			$edit_url = $layout_label->label->user_addflipcard->url.'/'.encode($value['lesson_id'].'_'.$value['id']);
			$viewcard_url = $layout_label->label->user_flipcard->url.'/'.encode($value['subject_id']).'&cardid='.$value['id'];
			$dataListString .= '<tr>
									<td class="txtCenter" style="width:30px;">'.enNum_khNum($i).'</td>
									<td>
										<a target="new" href="'.$viewcard_url.'"><span class=" mgn0 fs14">'.$value['front'].'</span></a>
										<div class="sub-info v_pad0">
											<span class="tooltips fs11" title="មេរៀន"><i class="fa fa-tag"></i> '.$value['lessontitle'].'</span> | 
											<span class="tooltips fs11" title="កែប្រែ"><a href="'.$edit_url.'"><i class="fa fa-pencil"></i> កែប្រែ</a></span> 
										</div>
									</td></tr>';
			
			$i++;
		}
		$no_data = $layout_label->label->no_data->icon.' '.$layout_label->label->no_data->title;
		if($dataListString == ''){$dataListString = '<tr><td colspan="'.$qryData->col.'" style="text-align:center; color:#c0434d;">'.$no_data.'</td></tr>';}
		$data = array('list'=>$dataListString,'listNavInfo'=>($totalPages>0?$list_nav_info:$no_data),'targetPage'=>$targetPage,'totalPages'=>$totalPages,'gotoSelectNum'=>$gotoSelectNum,'nav_btn_disable'=>$nav_btn_disable,'totalRow'=>$totalRow);	
		echo json_encode($data);	
	}
}	



?>