<?php
$listname='flipcardlist';

//url new main
$add_main_url = $pageData->label->label->user_addlesson->url.'/'.encodeString($pageData->data->content->subject_info->id,$encryptKey);

$lesson_items='';$main_no=1;$alllesson=$allq=0;
foreach($pageData->data->content->lessons as $key=>$value){
    $subrow=isset($value['sub'])?$value['sub']:array();$mainrow=$value['info'];
    //url new sub
    $add_sub_url = $pageData->label->label->user_addlesson->url.'/'.encodeString($pageData->data->content->subject_info->id.'_'.$key,$encryptKey);
    
    $sub=$main='';$sub_no=1;$totalq=0;$alllesson+=count($subrow);
    foreach($subrow as $skey=>$svalue){
        //url new lesson
        $lesson_view_url = $pageData->label->label->user_lessonview->url.'/'.encodeString($svalue['id'].'_'.time(),$encryptKey);
        //url new question
        $totalq+=$svalue['totalq'];$allq+=$svalue['totalq'];
        $add_q_url = $pageData->label->label->user_addquestion->url.'/'.encodeString($svalue['id'],$encryptKey);
        $add_flipcard_url = $pageData->label->label->user_addflipcard->url.'/'.encodeString($svalue['id'],$encryptKey);
        $sub.='<li style="display:none">
                    <a href="'.$lesson_view_url.'"><span><i class="fa fa-file-text-o"></i> មេរៀនទី'.enNum_khNum($sub_no).'៖ <u>'.$svalue['title'].'</u></span></a>
                    <i class="fa fa-files-o"></i> '.enNum_khNum($svalue['totalq']).' សំណួរ 

                    <div class="btn-group fs11 pull-right">
                        <button class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>
                        <ol class="dropdown-menu fs11 h_pad5" style="min-width: 120px;">
                            <div class="v_pad3 h_pad10">
                                <a href="'.$add_q_url.'">'.$pageData->label->label->user_addquestion->icon.' '.$pageData->label->label->user_addquestion->title.'</a>
                            </div>
                            <hr class="v_mgn3" />
                            <div class="v_pad3 h_pad10">
                                <a href="'.$add_flipcard_url.'"><i class="fa fa-list-alt"></i> បញ្ចូល Flip Card</a>
                            </div>
                            <hr class="v_mgn3" />
                            <div class="v_pad3 h_pad10">
                                <a href="'.$add_sub_url.'&id='.encodeString($svalue['id'].'_'.time(),$encryptKey).'"><i class="fa fa-pencil"></i> កែប្រែមេរៀន</a>
                            </div>
                        </ol>
                    </div>


                    
                </li>';
        $sub_no++;
    }
    $sub.='<li style="display:none">
                <a href="'.$add_sub_url.'"><span class="bluecolor"><i class="fa fa-plus"></i> បញ្ចូលមេរៀនថ្មី</span></a>


                <a class="btn btn-xs btn-info" href="'.$add_main_url.'&id='.encodeString($mainrow['id'].'_'.time(),$encryptKey).'"><i class="fa fa-pencil"></i> កែប្រែជំពូក</a>
            </li>';
    $main.='<span><i class="fa fa-lg fa-folder-open"></i> ជំពូកទី'.enNum_khNum($main_no).'៖ '.$mainrow['title'].' <label class="pull-right"><i class="fa fa-files-o"></i> '.enNum_khNum($totalq).' សំណួរ</label></span>';
    $main.="<ul>$sub</ul>";
    $lesson_items.="<li>$main</li>";
    $main_no++;
}
?>
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
                        <div class="sub-info rounded"><span class="badge bg-color-greenLight"><?=enNum_khNum($alllesson)?> មេរៀន</span> <span class="badge bg-color-greenLight"><?=enNum_khNum($allq)?> សំណួរ</span> <span class="badge bg-color-greenLight"><?=enNum_khNum($pageData->data->content->totalcard)?> Flip card</span></div>

                    	<div class="tree smart-form">
                            <ul>
                            	<?php 

                            	echo $lesson_items;

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
       	<article class="col-md-5">
        	<div class="jarviswidget" id="flipcardlist_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2>Flip Card</h2> 
                    <div class="widget-toolbar" role="menu">
                        <div class="btn-group">
                            <button class="btn btn-xs btn-default switch_list_filters" data-list="<?=$listname?>">
                               <i class="fa fa-search"></i> Filter
                            </button>                            
                        </div>
                    </div>
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body">
                        <div class="datalist txtLeft" id="<?=$listname?>">
                            <div class="list_filters hidden">
                            <?=$pageData->data->content->search_inputs?>
                            </div>
                            <?php //include("app/view/frontend/layout/pagination_info.php"); ?>
                            <table width="100%" class="mytable" >
                                <thead>
                                    <tr class="hidden"><th style="width:30px;" class="txtCenter">No.</th><th>Course</th><th style="width:70px;" class="txtCenter">Tools</th></tr>
                                </thead>
                                <tbody></tbody>
                            </table> 
                            <?php include("app/view/backend/layout/listPagination.php");?>  
                        </div>


                    </div>
                </div>
            </div>
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