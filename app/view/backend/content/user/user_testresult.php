<?php
$pdata = $pageData->data->content;
?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-8">
        	<div class="jarviswidget" id="testresult_view_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->questionnaire->title?></strong></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                    	<div class="alert alert-info"><?=$pdata->subject_info->subjectname.' <i class="fa fa-angle-double-right"></i> '.($pdata->examdata->lesson_title<>''?($pdata->examdata->lesson_title):'គ្រប់មេរៀន')?></div>
                        <form class="smart-form" role="form" action="" method="post">
                            <fieldset>
                                <?=$pdata->questionnaire?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>

       	</article>
       	<article class="col-md-4">
        	<div class="jarviswidget" id="testresult_info_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->user_testresult->title?></strong></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body status vote"> 
                        <ul class="comments fs12">
                            <li class="v_pad5">
                                ចាប់ផ្តើម៖ <?=khmerDate($pdata->examdata->start_datetime,'full_dt')?>
                            </li>
                            <li class="v_pad5">
                                បញ្ចប់៖ <?=khmerDate($pdata->examdata->end_datetime,'full_dt')?>
                            </li>
                            <li class="v_pad5">
                                ប្រើពេល៖ ០នាទី ០វិនាទី
                            </li>
                            <li class="v_pad5">
                                លទ្ធផល៖ <?=$pdata->examdata->correctq.'/'.$pdata->examdata->totalq.' <code>'.(int)(($pdata->examdata->correctq/$pdata->examdata->totalq)*100).'%</code>'?>
                            </li>
                            <li class="v_pad5">
                                ពិន្ទុ៖ <?=TrimTrailingZeroes($pdata->examdata->totalscore).'/'.$pdata->examdata->fullscore?>
                            </li>
                        </ul>
                        <div>
                            <a href="<?=$pageData->label->label->user_pretest->url.'/'.encodeString($pdata->examdata->course_subject_id.'_'.$pdata->examdata->lesson_id,$encryptKey)?>" class="btn btn-info btn-lg btn-block"><i class="fa fa-refresh"></i> ធ្វើតេស្តម្តងទៀត</a>
                            <a href="<?=$pageData->label->label->user_testresultlist->url?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-th-list"></i> ប្រវត្តិតេស្ត</a>
                            <a href="<?=$pageData->label->label->user_lessoncontent->url.'/'.encodeString($pdata->subject_info->grade_id.'_'.$pdata->subject_info->grade_subject_id,$encryptKey)?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-book"></i> មើលមេរៀន</a>
                        </div>
                    </div>
                </div>
            </div>
       	</article>
    </div>
</section>