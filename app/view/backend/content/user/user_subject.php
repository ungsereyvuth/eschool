<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-6">
        	<div class="jarviswidget" id="user_addlesson_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->lesson->icon.' '.$pageData->label->label->lesson->title?> <i class="fa fa-angle-double-right"></i> <?=$pageData->label->label->subject->title.' "'.$pageData->data->content->subject_info->title.'"'?></strong></h2>  
                    <div class="widget-toolbar">
                        <div class="btn-group v_mgn5">
                            <a class="btn btn-xs btn-info" href="<?=$pageData->label->label->user_addlesson->url.'/'.encodeString($pageData->data->content->subject_info->id,$encryptKey)?>">
                               <?=$pageData->label->label->user_addlesson->icon.' '.$pageData->label->label->user_addlesson->title?>
                            </a>                            
                        </div>
                    </div>
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                    	<div class="tree smart-form">
                            <ul>
                                <li>
                                    <span><i class="fa fa-lg fa-folder-open"></i> ជំពូកទី១ <label class="pull-right"><i class="fa fa-clock-o"></i> ២៥ក្រដីត</label></span>
                                    <ul>
                                        <li style="display:none">
                                            <a href="#"><span><i class="icon-leaf"></i> មេរៀនទី១៖ <u>សេចក្តីផ្តើមចំនួនកំផ្លិច</u></span></a>
                                            - ២៣សំណួរ 
                                            - ២ក្រេដីត
                                        </li>
                                        <li style="display:none">
                                            <a href="#"><span><i class="icon-leaf"></i> មេរៀនទី២៖ <u>ប្រមាណវិធី</u></span></a>
                                            - ៤៣សំណួរ 
                                            - ២ក្រេដីត
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <span><i class="fa fa-lg fa-folder-open"></i> ជំពូកទី២ <label class="pull-right"><i class="fa fa-clock-o"></i> ៣៥ក្រដីត</label></span>
                                    <ul>
                                        <li style="display:none">
                                            <a href="#"><span><i class="icon-leaf"></i> មេរៀនទី១៖ <u>សេចក្តីផ្តើមចំនួនកំផ្លិច</u></span></a>
                                            - ២៣សំណួរ 
                                            - ២ក្រេដីត
                                        </li>
                                        <li style="display:none">
                                            <a href="#"><span><i class="icon-leaf"></i> មេរៀនទី២៖ <u>ប្រមាណវិធី</u></span></a>
                                            - ៤៣សំណួរ 
                                            - ២ក្រេដីត
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

       	</article>
       	<article class="col-md-4">
        	
       	</article>
    </div>
</section>

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