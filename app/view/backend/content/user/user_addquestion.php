<?php
$listname='user_questionlist';
$formkey='user_addquestion';
//get options input code
$tf_format=$pageData->data->content->tf_format;
if($pageData->data->content->selected_qtype<>''){
    $qtype_file = 'app/view/'.$dir.'content/'.$more_dir.'qinput/'.$pageData->data->content->selected_qtype.'.php';
    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$qtype_file)) {
       include ($qtype_file); 
   }

}

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
                    	<form class="ajaxfrm smart-form realtime-upload" role="form" id="<?=$formkey?>-form" data-func="submit_form" data-reset="1" action="" method="post">
                            <fieldset>       
                                <div class="row">
                                    <section class="col col-md-6">
                                        <label class="label">ប្រភេទសំណួរ</label>
                                        <label class="select">
                                             <select name="qtype" id="qtype">
                                                <option value="">--- ជ្រើសរើស ---</option>
                                                <?=$pageData->data->content->qtype_opt?>
                                            </select>
                                        </label>
                                    </section>  
                                    <section class="col col-md-6">
                                        <label class="label">លំដាប់</label>
                                        <label class="input">
                                            <input type="number" name="ordering" placeholder="Numner" value="<?=$pageData->data->content->ordering?>">
                                        </label>
                                    </section>
                                </div>   
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="label">សំណួរ</label>
                                        <label class="input">
                                            <input type="text" name="title" placeholder="សរសេរសំណួរទីនេះ">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="label">បរិយាយបន្ថែម (ប្រសិនបើមាន)</label>
                                        <textarea class="mathinput" name="description"></textarea>
                                    </section>                         
                                </div>                  
                                <div class="row">                                    
                                      
                                    <section class="col col-md-6">
                                        <label class="toggle inline-block">
                                            <input type="checkbox" name="active" checked="checked">
                                            <i data-swchon-text="បើក" data-swchoff-text="បិទ"></i> បើកឬបិទ
                                        </label>
                                        <div id="active_msg"></div>
                                    </section>
                                </div>             
                                      
                            </fieldset>
                            <?php if(isset($qtype['html_input'])){echo $qtype['html_input'];}?>                            
                            <footer>
                                <input class="removable" type="hidden" name="recordid" value="<?=encodeString($pageData->data->content->lesson_info->lesson_id.'_'.time(),$encryptKey)?>" />
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

<?php

$pageurl = $pageData->label->label->user_addquestion->url.'/'.encodeString($pageData->data->content->lesson_info->lesson_id,$encryptKey);
$late_script = "
//switch q type
$('#qtype').change(function(){
    var param = $(this).val()!=''?('?type='+$(this).val()):'';
    window.location.href='$pageurl'+param;
});

function confirmDialog(message,e) {
    $('<div></div>').appendTo('body')
    .html('<div><h6>'+message+'</h6></div>')
    .dialog({
        modal: true, title: 'បញ្ជាក់', zIndex: 10000, autoOpen: true,
        width: 'auto', resizable: false,
        buttons: {
            'ប្រាកដ': function () {
                e.closest('.row').remove();
                $(this).dialog('close');
            },
            'អត់ទេ': function () {    
                $(this).dialog('close');
            }
        },
        close: function (event, ui) {
            $(this).remove();
        }
    });
}
";
if(isset($qtype['js_script'])){$late_script .= $qtype['js_script'];}

?>