<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-8">
        	<div class="jarviswidget" id="course_subjects_wid" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->subject->icon.' '.$pageData->label->label->subject->title?> <i class="fa fa-angle-double-right"></i> <?=$pageData->label->label->courses->title.' "'.$pageData->data->content->course_info->title.'"'?></strong></h2>    
                     <div class="widget-toolbar">
                        <div class="btn-group v_mgn5">
                            <a class="btn btn-xs btn-info" href="<?=$pageData->label->label->user_addsubject->url.'/'.encodeString($pageData->data->content->course_info->id,$encryptKey)?>">
                               <?=$pageData->label->label->user_addsubject->icon.' '.$pageData->label->label->user_addsubject->title?>
                            </a>                            
                        </div>
                    </div>
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                    	<div class="row">
                            <?php
                                foreach($pageData->data->content->subject_data as $value){
                                    $subject_url = $pageData->label->label->user_subject->url.'/'.encodeString($value['id'],$encryptKey);
                                    echo '<div class="col-md-4">
                                                <a href="'.$subject_url.'">
                                                    <div class="alert alert-info price_box box_shadow_in margin-bottom-10">
                                                        <div class="fs16"><i class="fa fa-book"></i> '.$value['title'].'</div><hr class="v_mgn5" />
                                                        <div class="fs12">
                                                            <span class="inline-block"><i class="fa fa-folder-open"></i> '.enNum_khNum($value['total_lesson']).' មេរៀន</span>
                                                            <span class="inline-block"><i class="fa fa-files-o"></i> ២៣៤ សំណួរ</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>';
                                }
                                if(!count((array) $pageData->data->content->subject_data)){
                                    echo '<div class="col-xs-12"><div class="alert alert-info txtCenter"><i class="fa fa-info-circle"></i> មិនទាន់មានមុខវិជ្ជាសម្រាប់វគ្គសិក្សានេះទេ</div></div>';
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>

       	</article>
       	<article class="col-md-4">
        	<div class="jarviswidget" id="course_info_wid" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->user_course->icon.' '.$pageData->label->label->user_course->title?></strong></h2>    
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
                        
                        <div class="alert alert-success fs12">
                            <span class="inline-block"><i class="fa fa-users"></i> <?=enNum_khNum($pageData->data->content->course_info->total_student.'/'.$pageData->data->content->course_info->max_student)?></span> | 
                            <span class="inline-block"><i class="fa fa-calendar"></i> <?=khmerdate($pageData->data->content->course_info->created_date)?></span>
                            
                        </div>
                        <?=$pageData->data->content->course_info->description?>
                    </div>
                </div>
            </div>

            <div class="jarviswidget" id="course_info_wid" data-widget-editbutton="false" data-widget-deletebutton="false">
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?=$pageData->data->content->course_info->photo?>" class="box_shadow_out fullwidth">
                            </div>
                            <div class="col-md-8">
                                <div class="fs16">សាស្ត្រាចារ្យ៖ <?=$pageData->data->content->course_info->fullname_kh?></div><hr class="v_mgn5" />
                                <div class="fs12">សាស្ត្រាចារ្យ គណិតវិទ្យា នៃវិទ្យាល័យបាក់ទូក</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       	</article>
    </div>
</section>