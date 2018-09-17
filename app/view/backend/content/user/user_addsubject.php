<?php
$formkey='user_addsubject';
$formCmd='user_addsubject';
?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-6">
        	<div class="jarviswidget" id="user_addsubject_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->user_addsubject->icon.' '.$pageData->label->label->user_addsubject->title?></strong></h2>    
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
                    	<form class="ajaxfrm smart-form" role="form" id="<?=$formkey?>-form" data-func="submit_form" data-reset="1" action="" method="post">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-md-6">
                                        <label class="label">Subject Name</label>
                                        <label class="input">
                                            <input type="text" name="title" class="input-sm" placeholder="Title">
                                        </label>
                                    </section>    
                                    <section class="col col-md-6">
                                        <label class="label">Category</label>
                                        <label class="select">
                                             <select name="grade_subject_id" class="input-sm">
                                                <option value="">--- Select ---</option>
                                                <?=$pageData->data->content->std_subject_opt?>
                                            </select>
                                        </label>
                                    </section>                                
                                </div>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="label">Description <i class="fs11">(optional)</i></label>
                                        <label class="textarea textarea-expandable">                                        
                                            <textarea rows="3" class="custom-scroll" name="description" placeholder="More detail about your course"></textarea> 
                                        </label>
                                    </section>  
                                </div>
                                <div class="row">
                                    <section class="col col-md-4">
                                        <label class="toggle inline-block">
                                            <input type="checkbox" name="private" checked="checked">
                                            <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Private
                                        </label>
                                        <div id="private_msg"></div>
                                    </section>
                                    <section class="col col-md-4">
                                        <label class="toggle inline-block">
                                            <input type="checkbox" name="require_membership" checked="checked">
                                            <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Membership
                                        </label>
                                        <div id="require_membership_msg"></div>
                                    </section>
                                    <section class="col col-md-4">
                                        <label class="toggle inline-block">
                                            <input type="checkbox" name="active" checked="checked">
                                            <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Active
                                        </label>
                                        <div id="active_msg"></div>
                                    </section>
                                </div>
                            </fieldset>
                            
                            <footer>
                                <input class="removable" type="hidden" name="recordid" value="<?=encodeString($pageData->data->content->course_info->id,$encryptKey)?>" />
                                <input type="hidden" name="cmd" value="<?=$formCmd?>" />                                
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                <button type="reset" class="btn btn-default btn-sm reset_btn">Cancel</button>
                            </footer>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <div id="<?=$formkey?>_msg" data-loadtxt='<?=htmlspecialchars($pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title)?>'></div>
                                    </section>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>

       	</article>
       	<article class="col-md-6">
        	<div class="jarviswidget" id="exist_subject_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->subject->icon.' '.$pageData->label->label->subject->title?></strong></h2>    
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
                            foreach($pageData->data->content->existing_subjects as $value){
                                echo '<div>
                                            <a href="#">
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
                            if(!count($pageData->data->content->existing_subjects)){
                                echo '<div><div class="alert alert-info txtCenter"><i class="fa fa-info-circle"></i> មិនទាន់មានមុខវិជ្ជាសម្រាប់វគ្គសិក្សានេះទេ</div></div>';
                            }
                        ?>


                        

                    </div>
                </div>
            </div>
       	</article>
    </div>
</section>

