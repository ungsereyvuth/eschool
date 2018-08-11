<?php
$listname='user_questionlist';
$formkey='user_addquestion';
?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-7">
        	<div class="jarviswidget" id="<?=$formkey?>_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->user_addquestion->icon.' '.$pageData->label->label->user_addquestion->title?> <i class="fa fa-angle-double-right"></i> <?=$pageData->label->label->lesson->title.'៖ '.$pageData->data->content->lesson_info->lesson_title?></strong></h2>    
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
                    	This page is generated automatically from the system.
                    </div>
                </div>
            </div>

       	</article>
       	<article class="col-md-5">
        	<div class="jarviswidget" id="<?=$listname?>_wid" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->$listname->icon.' '.$pageData->label->label->$listname->title?></strong></h2>   
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