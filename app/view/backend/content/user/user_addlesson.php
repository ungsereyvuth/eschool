<?php
$listname='user_subject';
$formkey='user_addlesson';
$addmain = $pageData->data->content->addmain;
?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-8">
        	<div class="jarviswidget" id="<?=$formkey?>_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$addmain?$pageData->label->label->add_chapter->title:$pageData->label->label->user_addlesson->title?> សម្រាប់ <?=!$addmain?'ជំពូក '.$pageData->data->content->chapter_info->title:''?> <?=$pageData->data->content->subject_info->subject_title?></strong></h2>    
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
                    	
                        <form class="ajaxfrm smart-form realtime-upload" role="form" id="<?=$formkey?>-form" data-func="submit_form" data-reset="1" action="" method="post">
                            <fieldset>          
                                <div class="row">
                                    <section class="col col-md-6">
                                        <label class="label">Title</label>
                                        <label class="input">
                                            <input type="text" name="title" class="input-sm" placeholder="Title">
                                        </label>
                                    </section>
                                    <section class="col col-md-6">
                                        <label class="label">Ordering</label>
                                        <label class="input">
                                            <input type="number" name="ordering" class="input-sm" placeholder="Numner" value="<?=$pageData->data->content->ordering?>">
                                        </label>
                                    </section>  
                                </div>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="label">Description</label>
                                        <textarea class="richtext" name="description"></textarea>
                                    </section>                         
                                </div>                  
                                <div class="row">                                    
                                    
                                    <section class="col col-md-6">
                                        <label class="label">Active</label>
                                        <label class="toggle inline-block">
                                            <input type="checkbox" name="active" checked="checked">
                                            <i data-swchon-text="ON" data-swchoff-text="OFF"></i> ON/OFF
                                        </label>
                                        <div id="active_msg"></div>
                                    </section>
                                </div>   
                            </fieldset>
                            <fieldset class="<?=$addmain?'hidden':''?>">             
                                <div class="row">       
                                    <section class="col col-md-12">  
                                        <label>Attachments</label>                              
                                        <label class="input input-file">
                                            <div class="button">
                                                <input type="file" name="attachment" class="realtime-upload-btn">Add Picture
                                            </div>
                                            <input type="text" readonly placeholder="You can select only allowed file types">
                                            <input type="hidden" id="allfiles_attachment" name="filename" class="realtime-upload-allfiles">
                                            <div id="selectedFile_attachment" class=" thumbnail realtime-upload-selectedfile" style="display:none; margin-top:10px;"></div>
                                        </label>
                                    </section>
                                </div>    
                                      
                            </fieldset>
                            <footer>
                                <input class="removable" type="hidden" name="recordid" value="<?=$pageData->data->content->codes?>" />
                                <input type="hidden" name="cmd" value="<?=$formkey?>" />                                  
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                <button type="reset" class="btn btn-default btn-sm" onclick="javascript: window.history.back();">Back</button>
                            </footer>
                            <fieldset>
                                <div id="<?=$formkey?>_msg" data-loadtxt='<?=htmlspecialchars($pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title)?>'></div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>

       	</article>
       	<article class="col-md-4">
        	
       	</article>
    </div>
</section>
