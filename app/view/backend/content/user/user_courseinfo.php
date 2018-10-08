<?php
$pData=$pageData->data->content;
$formCmd='joincourse';

$course_subject=$coursename=$course_des=$gradename=$teachername='';
foreach ($pData->course_info as $key => $value) {
    $lessonpage_url = $pageData->label->label->user_lessoncontent->url.'/'.encode($value['id'].'_'.$value['subject_id']).'&pc';

    $coursename=$value['title'];$gradename=$value['gradename'];$teachername=$value['teachername'];$course_des=$value['description'];
    $course_subject.= '<li class="v_pad5 hv-bg-gradient-2 "><a href="'.$lessonpage_url.'"><i class="fa fa-folder"></i> '.$value['coursesubject'].'</a><span class="pull-right h_pad10 fs12">'.$value['subjectname'].'</span></li>';
}
//course member by class
$totalmember=0;$memberbyclass=$classopt='';
foreach ($pData->classmember as $key => $value) {
    $memberbyclass.='<div><i class="fa fa-caret-right"></i> '.($value['classname']<>''?$value['classname']:'Standard Class').' ៖ '.enNum_khNum($value['totalmember']).' នាក់ '.($pData->isMember?($pData->membership->class_id==$value['class_id']?'(<span class="greencolor"><i class="fa fa-check-circle"></i> ថ្នាក់អ្នក</span>)':''):'').'</div>';
    if($value['class_id']){
        $classopt.='<option value="'.$value['class_id'].'">'.$value['classname'].'</option>';
    }
    
    $totalmember+=$value['totalmember'];
}

?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-8">
        	<div class="jarviswidget" id="user_courseinfo_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->user_courseinfo->title?></strong></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                        <div class="v_pad10 fs15"><?=$coursename.' '.$gradename?></div>
                    	<div><?=$course_des?></div><br />
                        <div class="status vote">
                            <ul class="comments">
                                <?=$course_subject?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

       	</article>
       	<article class="col-md-4">
        	<div class="jarviswidget" id="user_courseinfo_other_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong>ផ្សេងៗ</strong></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body">                         
                        <div class="status vote">
                            <ul class="comments">
                                <li class="v_pad5 ">សាស្រ្តាចារ្យ៖ <?=$teachername?></li>
                                <li class="v_pad5 ">
                                    ចំនួនសមាជិកសរុប៖ <?=enNum_khNum($totalmember)?> នាក់
                                    <?=$memberbyclass?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jarviswidget" id="user_courseinfo_reg_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong>ចុះឈ្មោះ</strong></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body">   
                        <form class="ajaxfrm smart-form" role="form" id="<?=$formCmd?>-form" data-func="submit_form" data-reset="1" action="" method="post">    
                            <div class="row">
                                <section class="col col-md-6">
                                    <label class="select">                 
                                        <select class="input-sm" name="class_id">
                                            <?php
                                            if($classopt==''){echo '<option value="0">Standard Class</option>';}
                                            echo $classopt;
                                            ?>
                                        </select>
                                    </label>
                                </section>    
                                <section class="col col-md-6">
                                    <input class="removable" type="hidden" name="recordid" value="<?=encode($pData->course_id)?>" />
                                    <input type="hidden" name="cmd" value="<?=$formCmd?>" />                                
                                    <button type="submit" class="btn btn-primary btn-sm" <?=$pData->isMember?'disabled':''?>><i class="fa fa-plus"></i> ចុះឈ្មោះ</button>
                                </section>                                
                            </div> 
                            
                            <div id="<?=$formCmd?>_msg" data-loadtxt='<?=htmlspecialchars($pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title)?>'>
                                <div class="alert-success pad5 <?=$pData->isMember?'':'hidden'?>"><i class="fa fa-check-square-o"></i> បានចុះឈ្មោះរួចហើយ</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       	</article>
    </div>
</section>