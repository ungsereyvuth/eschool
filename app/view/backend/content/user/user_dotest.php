<?php
$formkey='user_dotest';
?>

<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-8">
        	<div class="jarviswidget" id="dotest_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->questionnaire->title?></strong></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                    	<div class="alert alert-info"><?=$pageData->data->content->examdata->lesson_title?></div>
                        <form class="ajaxfrm smart-form realtime-upload" role="form" id="<?=$formkey?>-form" data-func="submit_form" data-reset="1" action="" method="post">
                            <fieldset>          
                            <?=$pageData->data->content->questionnaire?>

                                
                            </fieldset>
                            <footer>
                                <input class="removable" type="hidden" name="recordid" value="<?=encodeString($pageData->data->content->examdata->exam_result_id.'_'.time(),$encryptKey)?>" />
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

<?php
$late_script="
var updateOutput = function(e) { 
                var list = e.length ? e : $(e.target), output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));
                    //, null, 2));
                } else {
                    output.val('JSON browser support required.');
                }
            };

$('.sequence').each(function(index) {
    // activate sequence
    $(this).nestable({
        group : index
    }).on('change', updateOutput);

    // output initial serialised data
    updateOutput($(this).data('output',$('#'+$(this).data('outputid'))));
});


";

?>