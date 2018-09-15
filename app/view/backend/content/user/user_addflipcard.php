<?php
$listname='flipcardlist';
$formkey='user_addflipcard';
$formCmd='user_addflipcard';
?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-8">
        	<div class="jarviswidget" id="id_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->data->content->editmode?'កែប្រែ':'បញ្ចូល'?> Flip Card សម្រាប់ "<?=$pageData->data->content->lesson_info->lesson_title?>"</strong></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                    	<form class="ajaxfrm smart-form" role="form" id="<?=$formkey?>-form" data-func="submit_form" data-reset="1" action="" method="post">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="label">Front Card</label>
                                        <textarea class="minRichText" name="front_card"><?=$pageData->data->content->editmode?$pageData->data->content->card_data->front:''?></textarea>
                                    </section>                         
                                </div>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="label">Back Card</label>
                                        <textarea class="minRichText" name="back_card"><?=$pageData->data->content->editmode?$pageData->data->content->card_data->back:''?></textarea>
                                    </section>                         
                                </div>
                                <div class="row">
                                    <section class="col col-md-4">
                                        <label class="label">Front Card Color</label>
                                        <label class="input">
                                            <input type="text" name="front_card_color" class="colorpicker input-sm" placeholder="" value="<?=$pageData->data->content->editmode?$pageData->data->content->card_data->fcolor:''?>" data-color-format="rgba" style="background-color: <?=$pageData->data->content->editmode?$pageData->data->content->card_data->fcolor:''?>;">
                                        </label>
                                    </section>
                                    <section class="col col-md-4">
                                        <label class="label">Back Card Color</label>
                                        <label class="input">
                                            <input type="text" name="back_card_color" class="colorpicker input-sm" placeholder="" value="<?=$pageData->data->content->editmode?$pageData->data->content->card_data->bcolor:''?>" data-color-format="rgba" style="background-color: <?=$pageData->data->content->editmode?$pageData->data->content->card_data->bcolor:''?>;">
                                        </label>
                                    </section>
                                    <section class="col col-md-4">
                                        <label class="label">Ordering</label>
                                        <label class="input">
                                            <input type="Number" name="ordering" class="input-sm" placeholder="Number" value="<?=$pageData->data->content->editmode?$pageData->data->content->card_data->ordering:$pageData->data->content->ordering?>">
                                        </label>
                                    </section>
                                    <section class="col col-md-4">
                                        <label class="toggle inline-block">
                                            <input type="checkbox" name="active" <?=$pageData->data->content->editmode?($pageData->data->content->card_data->active?'checked':''):'checked'?>>
                                            <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Active
                                        </label>
                                        <div id="active_msg"></div>
                                    </section>
                                </div>
                            </fieldset>
                            
                            <footer>
                                <input class="removable" type="hidden" name="recordid" value="<?=encodeString($pageData->data->content->code.'_'.time(),$encryptKey)?>" />
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
       	<article class="col-md-4">
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
$late_script_file = '<script src="/assets/backend/js/plugin/colorpicker/bootstrap-colorpicker.min.js"></script>';
$late_script = '
        $(".colorpicker").colorpicker();
        $( ".colorpicker" ).blur(function() {
          $(this).css("background-color", $(this).val()); 
        });


    
';

?>