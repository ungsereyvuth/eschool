<?php
$pdata=$pageData->data->content;

//get attached file
$file_item='';
$filedata = $pdata->lessonData->filenames;
if($filedata<>''){
$filenames = explode('|',$pdata->lessonData->filenames);
$filepath = web_config('post_doc_path');
foreach ($filenames as $key => $value) {
    $file_detail=file_detail($value);
    $size=filesize_formatted($filepath.$value);
    $itemname = explode('_',$value);
    unset($itemname[count($itemname)-1]); unset($itemname[count($itemname)-1]);

    $doc_view_url = $pageData->label->label->user_lessonview->url.'/'.encodeString($pdata->lessonData->id.'_'.time(),$encryptKey).'&doc='.$value;
    $file_item.='<li class="v_pad5 hv-bg-gradient-2">
                    <a href="'.$doc_view_url.'">
                        <div class="flex-parent">
                          <div class="flex-child long-and-truncated tooltips" title="'.$file_detail['name_kh'].'">
                            '.$file_detail['icon'].' '.implode('',$itemname).'
                          </div>
                          
                          <div class="flex-child short-and-fixed">
                            <span class="label bg-color-teal pull-right">'.$size.'</span>
                          </div>
                          
                        </div>
                    </a>
                    
                </li>';
}

}

?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-sm-4">
        	<div class="jarviswidget">
                <div>
                    <div class="jarviswidget-editbox">
                    </div>
                    <div class="widget-body"> 
                    	<div class="p_title">
                            <span class="khmerTitle fs16">ជំពូក៖ <?=$pdata->lessonData->maintitle?></span>
                            <hr class="v_mgn5" />
                            មេរៀន៖ <?=$pdata->lessonData->title?>
                        </div>
                        <div class="v_pad10">ខ្លឹមសារ​ និងឯកសារ</div>
                        <div class="status vote">
                            <ul class="comments">
                                <?=$file_item?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

       	</article>
       	<article class="col-sm-8">
        	<div class="jarviswidget" id="docview_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"

                -->
                <header>
                    <h2><strong><?=$pageData->label->label->user_lessonview->title?></strong></h2>    
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
                        <?php

                        if(isset($_GET['doc'])){
                            echo '<iframe src="https://docs.google.com/viewer?url=http://www.khmerdocs.com/files/docs/docs561818030060.pdf&amp;embedded=true" width="100%" height="780" style="border: none;"></iframe>';
                        }else{

                            echo '<div class="mathFont">'.$pdata->lessonData->description.'</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
       	</article>
    </div>
</section>
<?php
$late_script='
<script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>
<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>
';
?>