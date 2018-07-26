<div class="page_content profile">    
     <div class="row">
         <div class="col-sm-12">
             <div class="panel panel-profile no-bg">
                 <div class="panel-heading overflow-h">
                    <h2 class="panel-title heading-sm pull-left"><?=$pageData->label->label->new_license->icon?> <?=$pageData->label->label->new_license->title?></h2>
                 </div>
                 <div class="">
                     <form class="log-reg-block" role="form" method="post">
                        <div class="login-input reg-input">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 v_pad10">
                                    <section>
                                        <select id="license_category" class="form-control">
                                            <option value="" selected><?=$pageData->label->label->select_option->title?></option>
                                            <?=$pageData->data->content->license_category?>
                                        </select>
                                    </section>
                                </div>
                                <div class="col-sm-6 col-md-4 v_pad10">
                                    <button class="btn-u btn-u-sea-shop margin-bottom-20" type="button" onClick="javascript: var e = document.getElementById('license_category');var val = e.options[e.selectedIndex].value;if(val!=''){window.location.href= '/<?=$pageData->lang->selected?>/license/apply/'+val;}">
                                        <?=$pageData->label->label->new_license->icon?> <?=$pageData->label->label->new_license->title?>
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row margin-bottom-20">
        <!--Profile Post-->
        <div class="col-sm-6">
            <div class="panel panel-profile">
                <div class="panel-heading overflow-h">
                    <h2 class="panel-title heading-sm pull-left"><?=$pageData->label->label->license_status_summary->icon.$pageData->label->label->license_status_summary->title?></h2>
                </div>
                <div class="panel-body no-padding" data-mcs-theme="minimal-dark">
                	<?php
					$appStatusCate='';
					foreach($pageData->data->content->appStatusCate as $key=>$value){
						$appStatusCate.='<div class="alert-blocks '.$value['css'].'">
											<div class="date-formats bg-blue" style="border-radius:10px 0; margin-top:0;"><span>'.enNum_khNUm(sprintf("%0".$pageData->data->content->numLength."d",$value['count'])).'</span></div>
											<div class="overflow-h">
												<a href="/'.$pageData->lang->selected.$value['url'].'"><strong class="color-blue">'.$value['title'].'</strong></a>
												<p class="fs12">'.$value['data'].'</p>
											</div>
										</div>';
					}	
					echo $appStatusCate;				
					?>
                </div>
            </div>
        </div>
        <!--End Profile Post-->

        <!--Profile Event-->
        <div class="col-sm-6 md-margin-bottom-20">
            <div class="panel panel-profile no-bg">
                <div class="panel-heading overflow-h">
                    <h2 class="panel-title heading-sm pull-left"><?=$pageData->label->label->admin_notifications->icon.$pageData->label->label->admin_notifications->title?></h2>
                    <a href="/<?=$pageData->lang->selected.$pageData->label->label->notifications->url?>"><i class="fa fa-list pull-right"></i></a>
                </div>
                <div id="scrollbar2" class="panel-body no-padding mCustomScrollbar" style="height: 392px;" data-mcs-theme="minimal-dark">
                    <?php
					$notif='';
					foreach($pageData->data->content->notif as $key=>$value){
						//url
						$license_id_code = encodeString($value['license_id'].'_'.time(),$encryptKey);
						$form_id_code = encodeString($value['form_id'].'_'.time(),$encryptKey);
						$view_url = '/'.$pageData->lang->selected.$pageData->label->label->license_view->url.'/'.$license_id_code.'&formid='.$form_id_code;
						$notif.='<div class="profile-event">
											<div class="date-formats tooltips" title="'.enNum_khNUm(date('h:i A',strtotime($value['created_date']))).'">
												<span class="fs18">'.enNum_khNUm(date('d',strtotime($value['created_date']))).'</span>
												<small>'.enNum_khNUm(date('m, Y',strtotime($value['created_date']))).'</small>
											</div>
											<div class="overflow-h">
												<h3 class="heading-xs"><a href="'.$view_url.'">'.$value['biz_name'].'</a></h3>
												<p>'.strip_tags($value['msg']).'</p>
											</div>
										</div>';
					}	
					if(count($pageData->data->content->notif)){
						$notif.='<div class="profile-event txtCenter">
									<div class="overflow-h">
										<p><a href="/'.$pageData->lang->selected.$pageData->label->label->notifications->url.'">View All</a></p>
									</div>
								</div>';
						echo $notif;				
					}else{
						echo '<div class="profile-event txtCenter">
									<div class="overflow-h">
										<p>No data</p>
									</div>
								</div>';	
					}
					?>
                </div>
            </div>
        </div>
        <!--End Profile Event-->
    </div><!--/end row-->

</div>