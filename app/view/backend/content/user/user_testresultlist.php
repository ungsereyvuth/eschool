<?php
$listname='user_testresultlist';
?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-8">
        	<div class="jarviswidget" id="user_testresultlist_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->user_testresultlist->icon.' '.$pageData->label->label->user_testresultlist->title?></strong></h2>    
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
                            <?php include("app/view/frontend/layout/pagination_info.php"); ?>
                            <table width="100%" class="mytable" >
                                <tbody></tbody>
                            </table> 
                            <?php include("app/view/frontend/layout/listPagination.php");?>  
                        </div> 
                    </div>
                </div>
            </div>

       	</article>
       	<article class="col-md-4">
       		<?php if(count((array) $pageData->data->content->statistic)){ ?>
        	<div class="jarviswidget" id="basic_statistic_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong>ស្ថិតិ</strong></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body status vote"> 
                    	<ul class="comments fs12">
                            <li class="v_pad5">
                                មធ្យមភាគ៖ <code><?=number_format($pageData->data->content->statistic->avg,2)?>%</code>
                            </li>
                            <li class="v_pad5">
                                ខ្ពស់បំផុត៖ <code><?=number_format($pageData->data->content->statistic->max,2)?>%</code>
                            </li>
                            <li class="v_pad5">
                                ទាបបំផុត៖ <code><?=number_format($pageData->data->content->statistic->min,2)?>%</code>
                            </li>
                            <li class="v_pad5">
                                តេស្តចុងក្រោយ៖ <code><?=khmerDate($pageData->data->content->statistic->max_date,'full_dt')?></code>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        	<?php }?>
       	</article>
    </div>
</section>