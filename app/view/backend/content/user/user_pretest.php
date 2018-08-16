<?php
$listname='createdtest';
$formkey='createdtest';

?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-8 col-md-offset-2">
        	<div class="jarviswidget" id="id_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->user_pretest->title?></strong></h2>    
                </header>
                <div>
                    <div class="widget-body "> 
                        <fieldset class="smart-form">
                            <section>
                                <label class="label">ជ្រើសមេរៀនសម្រាប់ធ្វើតេស្ត</label>
                                <select class="form-control" id="lessontotest">
                                    <option value="">គ្រប់មេរៀន</option>
                                    <?php
                                    $main_no=1;
                                    foreach($pageData->data->content->lessons as $key=>$value){                 
                                        $subrow=isset($value['sub'])?$value['sub']:array();$mainrow=$value['info'];
                                        $sub=$main='';$sub_no=1;
                                        foreach($subrow as $skey=>$svalue){
                                            $sub.='<option value="'.encodeString($pageData->data->content->subject_info->id.'_'.$svalue['id'],$encryptKey).'" '.($svalue['id']==$pageData->data->content->lesson_id?'selected':'').'>មេរៀនទី'.enNum_khNum($sub_no).'៖ '.$svalue['title'].'</option>';
                                            $sub_no++;
                                        }
                                        $main='<optgroup label="ជំពូកទី'.enNum_khNum($main_no).'៖ '.$mainrow['title'].'">'.$sub.'</optgroup>';
                                        echo $main;
                                        $main_no++;
                                    }

                                    ?>
                                </select>
                            </section>
                            <section>
                                <label class="label">កម្រងសំណួរដែលរៀបចំជាស្រេច</label>
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
                            </section>                            
                        </fieldset>
                        <fieldset>
                            <section>
                                <label>អ្នកក៏អាចធ្វើតេស្តលើកម្រងសំណួរដែលបង្កើតភ្លាមៗដោយប្រព័ន្ធ ដោយចុចប៊ូតុងខាងក្រោម។</label>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-4 v_pad10">
                                        <a href="#" class="btn btn-info btn-block">ធ្វើតេស្ត</a>
                                    </div>
                                </div>
                            </section>
                        </fieldset>
                    </div>
                </div>
            </div>

       	</article>
    </div>
</section>
<?php
$late_script = "

$('#lessontotest').change(function(){
    var code = $(this).val()!=''?$(this).val():'".encodeString($pageData->data->content->subject_info->id,$encryptKey)."';
    window.location.href = '".$pageData->label->label->user_pretest->url."/'+code;

});";
?>