<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-12">
        	<div class="jarviswidget" id="id_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                    	<div class="row">
                            <?php
                            foreach ($pageData->data->content->subject_info as $key => $value) {
                                $lessonview_url = $pageData->label->label->user_lessonview->url.'/'.encodeString($pageData->data->content->grade_id.'_'.$value['id'],$encryptKey);
                                echo '<div class="col-xs-12 col-sm-6 col-md-3">
                                        <a href="'.$lessonview_url.'">
                                            <div class="panel panel-success pricing-big roundpic">
                                                
                                                <div class="panel-heading pad0">
                                                    <img class="img-responsive bg_pic_cover fullwidth" src="/assets/frontend/img/blank_img_wider.png" style="background-image:url('.$value['banner'].');" />
                                                </div>
                                                <div class="panel-body no-padding text-align-center">
                                                    <div class="the-price">
                                                        <h1>
                                                            <strong>'.$value['title'].'</strong></h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>';
                            }

                            ?>
                            
                                        
                        </div>
                    </div>
                </div>
            </div>

       	</article>
    </div>
</section>

<style type="text/css">
    .pricing-big:hover{ opacity: .6; cursor: pointer;  }

</style>