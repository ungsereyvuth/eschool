<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-5">
        	<div class="jarviswidget" id="lessoncontent_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong>មាតិការមេរៀន</strong></h2>    
                    <!-- <div class="widget-toolbar">
                        <div class="btn-group">
                            <button class="btn btn-xs btn-default switch_list_filters" data-list="listname">
                               <i class="fa fa-search"></i> Filter
                            </button>                            
                        </div>
                    </div>-->
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                    	<?php
						if(!count((array) $pageData->data->content->lessons)){
							echo '<div class="alert alert-info txtCenter">មិនទាន់មានមេរៀន</div>';
						}
						
						?>
                    	<div class="tree smart-form">
                            <ul>
                            	<?php 
                            	$lesson_items='';$main_no=1;
                            	foreach($pageData->data->content->lessons as $key=>$value){
                            		$subrow=isset($value['sub'])?$value['sub']:array();$mainrow=$value['info'];
                            		//url new lesson
                            		$lesson_view_url = '#';
                            		$sub=$main='';$sub_no=1;$totalq=0;
                            		foreach($subrow as $skey=>$svalue){
                                        //url new question
                                        $totalq+=$svalue['totalq'];
                                        $add_q_url = $pageData->label->label->user_addquestion->url.'/'.encodeString($svalue['id'],$encryptKey);
	                            		$sub.='<li>
		                                            <a href="'.$lesson_view_url.'"><span><i class="fa fa-file-text-o"></i> មេរៀនទី'.enNum_khNum($sub_no).'៖ <u>'.$svalue['title'].'</u></span></a>
		                                            <i class="fa fa-crosshairs"></i> '.enNum_khNum($svalue['totalq']).' សំណួរ 
                                                    <i class="fa fa-file-o"></i> ៥ ឯកសារ
													<a href="#" class="btn btn-xs btn-success fs11 pull-right"><i class="fa fa-hand-o-right"></i> Quiz</a>
		                                        </li>';
                                        $sub_no++;
	                            	}
	                            	$main.='<span><i class="fa fa-lg fa-folder-open"></i> ជំពូកទី'.enNum_khNum($main_no).'៖ '.$mainrow['title'].' <label class="pull-right"><i class="fa fa-crosshairs"></i> '.enNum_khNum($totalq).' សំណួរ</label></span>';
	                            	$main.="<ul>$sub</ul>";
	                            	$lesson_items.="<li>$main</li>";
                                    $main_no++;
                            	}

                            	echo $lesson_items;

                            	?>
                            </ul>
                            
                            <!--<iframe src="https://docs.google.com/viewer?url=http://www.khmerdocs.com/files/docs/docs561818030060.pdf&amp;embedded=true" width="100%" height="780" style="border: none;"></iframe>-->
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="jarviswidget" id="lessonteacher_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong>សាស្ត្រាចារ្យរៀបចំ</strong></h2> 
                </header>
                <div>
                    <div class="widget-body"> 
                    	<div class="row">
                        	<div class="col-xs-4 col-xs-3">
                            	<img class="img-responsive bg_pic_cover fullwidth profile-pic" src="/assets/frontend/img/blank_img_square.png" style="background-image:url(<?=$pageData->data->content->course_info->teacherphoto?>);margin-bottom:15px;">
                            </div>
                            <div class="col-xs-8 col-xs-9">
                            	<p class="alert alert-info khmertitle v_mgn3">សាស្ត្រាចារ្យ៖ <?=$pageData->data->content->course_info->teachername?></p>
                                <div class="sub-info">សាលស្ត្រាចារ្យវិទ្យាល័យបាក់ទូក</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       	</article>
        <article class="col-md-7">
        	<article class="col-sm-4">
            	<div class="jarviswidget" id="lessonaction_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                
                        <div class="widget-body"> 
                            <a href="#" class="btn btn-info btn-lg btn-block"><i class="fa fa-newspaper-o"></i> Flip Card</a>
                            <a href="#" class="btn btn-success btn-lg btn-block"><i class="fa fa-server"></i> Take Quiz</a>
                            <a href="#" class="btn btn-primary btn-lg btn-block"><i class="fa fa-th-list"></i> Quiz History</a>
                        </div>
                    
                </div>
                <div class="jarviswidget" id="lessonquizlist_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                    <header>
                        <h2><strong>បញ្ជី Quiz</strong></h2> 
                    </header>
                    <div>
                    <div class="widget-body"> 
                        <a href="#"><div class="quiz_item alert alert-info khmertitle v_mgn3 fs12">
							<div><span class="tooltips" title="មេរៀនទី១">លំយោស៊ីនូយសូអ៊ីត</span> <span class="label label-warning pull-right tooltips" title="មិនទាន់បានបញ្ចប់"><i class="fa fa-exclamation-triangle"></i></span></div>
                            <hr class="v_mgn3" />
                            <div><?=date("d/m/Y H:i")?><code class="pull-right">4/10</code></div>
                        </div></a>
                        <a href="#"><div class="quiz_item alert alert-info khmertitle v_mgn3 fs12">
							<div><span class="tooltips" title="មេរៀនទី៦">លំយោលត្រង់</span> <span class="label label-success pull-right tooltips" title="បានបញ្ចប់">Done</span></div>
                            <hr class="v_mgn3" />
                            <div><?=date("d/m/Y H:i")?><code class="pull-right">9/10</code></div>
                        </div></a>
                    </div>
                    </div>
                </div>
            </article>
            <article class="col-sm-8">
            	<div class="jarviswidget" id="quizbysubject_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                    <header>
                        <h2><strong>សាស្ត្រាចារ្យផ្សេងទៀត</strong></h2> 
                    </header>
                    <div class="widget-body"> 
                        <div class="input-group input-group-sm"><input type="text" class="form-control searchinputs" id="txt_search" placeholder="ឈ្មោះសាស្ត្រាចារ្យ"><span class="input-group-btn btn_search"><button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button></span></div>
                    </div>
                </div>
            </article>
       	</article>
    </div>
</section>

<style>
	.quiz_item:hover{ background-color:#c7d0de;border-color:green;}
</style>

<?php
$late_script = "pageSetUp();
            
            // PAGE RELATED SCRIPTS
        
            $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
            $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').on('click', function(e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(':visible')) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
                }
                e.stopPropagation();
            });     ";

?>