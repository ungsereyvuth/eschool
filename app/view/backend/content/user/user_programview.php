<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-12">
        	<div class="jarviswidget" id="id1_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
							<div class="row">
								<?php
								foreach ($pageData->data->content->grade_info as $key => $value) {
									$grade_groupname=$group_banner=$gradeitem='';
									foreach ($value as $skey => $svalue) {
										//subject view url
										$subjectview_url = $pageData->label->label->user_subjectview->url.'/'.encodeString($svalue['gradeid'],$encryptKey);

										if($grade_groupname==''){$grade_groupname=$svalue['title'];$group_banner=$svalue['banner'];}
										$gradeitem.='<a href="'.$subjectview_url.'"><div class="sub-info v_mgn5 roundpic"><i class="fa fa-folder"></i> '.$svalue['gradename'].'</div></a>';
									}


									echo '<div class="col-xs-12 col-sm-6 col-md-3">
								            <div class="panel panel-success pricing-big">
								            	
								                <div class="panel-heading pad0">
								                	<img class="img-responsive bg_pic_cover fullwidth" src="/assets/frontend/img/blank_img_wider.png" style="background-image:url('.$group_banner.');" />
								                </div>
								                <div class="panel-body no-padding text-align-center">
								                    <div class="the-price">
								                        <h1>
								                            <strong>'.$grade_groupname.'</strong></h1>
								                    </div>
													<div class="price-features bg_darkblue">
														'.$gradeitem.'
													</div>
								                </div>
								            </div>
								        </div>';
								}

								?>
								
						        	    	
				    		</div>
				
							


                    </div>
                </div>
            </div>

       	</article>
    </div>
</section>