<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-7">
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
                            	<?php 
                            	$lesson_items='';
                            	foreach($pageData->data->content->lessons as $key=>$value){
                            		$subrow=$value['sub'];$mainrow=$value['info'];
                            		//url new sub
                            		$add_sub_url = $pageData->label->label->user_addlesson->url.'/'.encodeString($pageData->data->content->subject_info->id.'_'.$key,$encryptKey);
                            		//url new lesson
                            		$lesson_view_url = '#';
                            		$sub=$main='';
                            		foreach($subrow as $skey=>$svalue){
	                            		$sub.='<li style="display:none">
		                                            <a href="'.$lesson_view_url.'"><span><i class="fa fa-file-text-o"></i> មេរៀនទី១៖ <u>'.$svalue['title'].'</u></span></a>
		                                            - ២៣សំណួរ 
		                                            - ២ក្រេដីត
		                                        </li>';
	                            	}
	                            	$sub.='<li style="display:none">
	                                            <a href="'.$add_sub_url.'"><span class="bluecolor"><i class="fa fa-plus"></i> បញ្ចូលមេរៀនថ្មី</span></a>
	                                        </li>';
	                            	$main.='<span><i class="fa fa-lg fa-folder-open"></i> ជំពូកទី១៖ '.$mainrow['title'].' <label class="pull-right"><i class="fa fa-clock-o"></i> ២៥ក្រដីត</label></span>';
	                            	$main.="<ul>$sub</ul>";
	                            	$lesson_items.="<li>$main</li>";
                            	}

                            	echo $lesson_items;

                            	//url new main
                            	$add_main_url = $pageData->label->label->user_addlesson->url.'/'.encodeString($pageData->data->content->subject_info->id,$encryptKey);

                            	?>

                                <li>
                                    <a href="<?=$add_main_url?>"><span class="bluecolor"><i class="fa fa-plus"></i> បញ្ចូលជំពូកថ្មី</span></a>                        
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