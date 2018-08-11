<?php
class documents{
	public function data($data){
		global $encryptKey,$language,$usersession,$layout,$layout_label,$lang;
		$qry = new connectDb; $_POST=$data;
		
		$qryData = (object) $_POST["qryData"];	
		$sql_condition = '';$translate_lang_con=$lang_code='';
		if($qryData->date_from<>''){$sql_condition.=" and c.created_date>='$qryData->date_from 00:00:00'";}
		if($qryData->date_to<>''){$sql_condition.=" and c.created_date<='$qryData->date_to 23:59:59'";}
		if($qryData->txt_search<>''){$sql_condition.=" and (c.title like '%$qryData->txt_search%' or c.description like '%$qryData->txt_search%')";}
					
		$sql_statement = "SELECT c.* from documents c
							where active=1 $sql_condition 
							order by c.created_date desc";	
		
		extract(generateList($language,intval(post("currentPage")),post("rowsPerPage"),post("navAction"),$sql_statement));
		$dataListString = '';$i=$startIndex+1;
		foreach($rowData as $key=>$value){	
			//url
			$view_url = '/'.$lang->selected.$layout_label->label->document_view->url.'/'.encodeString($value['id'].'_'.time(),$encryptKey);
					
			$dataListString .= '<tr>
									<td class="txtCenter">
										'.$i.'										
									</td>
									<td class="txtLeft">
										<div>
											<a href="'.$view_url.'">'.$value['title'].'</a>											
										</div>
										<div class="sub-info fs12">
											<span class="tooltips" title="Total View"><i class="greencolor"><i class="fa fa-eye"></i> '.$value['view'].'</i></span> | 
											<span class="tooltips" title="Posted Date"><i class="greencolor"><i class="fa fa-clock"></i> '.khmerDate($value['created_date']).'</i></span>
										</div>
									</td>									
								</tr>';
			
			$i++;
		}
		$no_data = $layout_label->label->no_data->icon.' '.$layout_label->label->no_data->title;
		if($dataListString == ''){$dataListString = '<tr><td colspan="'.$qryData->col.'" style="text-align:center; color:#c0434d;">'.$no_data.'</td></tr>';}
		$data = array('list'=>$dataListString,'listNavInfo'=>($totalPages>0?$list_nav_info:$no_data),'targetPage'=>$targetPage,'totalPages'=>$totalPages,'gotoSelectNum'=>$gotoSelectNum,'nav_btn_disable'=>$nav_btn_disable,'totalRow'=>$totalRow);	
		echo json_encode($data);	
	}	
}	



?>