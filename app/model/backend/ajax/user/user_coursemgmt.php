<?php
class user_coursemgmt{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		
		$qryData = (object) $_POST["qryData"];	
		$sql_condition = '';
		if($qryData->date_from<>''){$sql_condition.=" and c.created_date>='$qryData->date_from 00:00:00'";}
		if($qryData->date_to<>''){$sql_condition.=" and c.created_date<='$qryData->date_to 23:59:59'";}
		if(is_numeric($qryData->status)){$sql_condition.=" and c.active=$qryData->status";}
		if($qryData->txt_search<>''){$sql_condition.=" and (c.title like '%$qryData->txt_search%')";}
			
		$sql_statement = "SELECT * from es_course c where 1=1 $sql_condition order by c.created_date";						
		extract(generateList($language,intval(post("currentPage")),post("rowsPerPage"),post("navAction"),$sql_statement));
		$dataListString = '';$i=$startIndex+1;
		foreach($rowData as $key=>$value){	
			$dataListString .= '<tr>
									<td class="txtCenter">'.enNum_khNum($i).'</td>
									<td>
										<a href="#"><h3 class="tooltips" title="'.$value['title'].'">'.$value['title'].'</h3></a>
										<div class="sub-info">
											<span>fsdfd</span>
										</div>
									</td>

									<td class="txtCenter"><span class="tooltips fs12" title="'.$value['created_date'].'">'.khmerDate($value['created_date']).'</span></td></tr>';
			
			$i++;
		}
		$no_data = $layout_label->label->no_data->icon.' '.$layout_label->label->no_data->title;
		if($dataListString == ''){$dataListString = '<tr><td colspan="'.$qryData->col.'" style="text-align:center; color:#c0434d;">'.$no_data.'</td></tr>';}
		$data = array('list'=>$dataListString,'listNavInfo'=>($totalPages>0?$list_nav_info:$no_data),'targetPage'=>$targetPage,'totalPages'=>$totalPages,'gotoSelectNum'=>$gotoSelectNum,'nav_btn_disable'=>$nav_btn_disable);	
		echo json_encode($data);	
	}
}	



?>