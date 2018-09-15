<?php
$card = $pageData->data->content->card_data;
$prevcard_url = $card->prev_cardid?($pageData->label->label->user_flipcard->url.'/'.$pageData->data->content->code.'&cardid='.$card->prev_cardid):'#';
$nextcard_url = $card->next_cardid?($pageData->label->label->user_flipcard->url.'/'.$pageData->data->content->code.'&cardid='.$card->next_cardid):'#';
?>
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-md-12">
        	<div class="jarviswidget" id="id_wid" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <h2><strong><?=$pageData->label->label->user_flipcard->title?></strong></h2>    
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <div class="widget-body"> 
                        <div class="row">
                            <div class="col-sm-1">
                                <a href="<?=$prevcard_url?>" class="btn btn-info rounded margin-bottom-10 <?=$card->prev_cardid?'':'disabled'?>">Prev</a>
                                <a href="<?=$nextcard_url?>" class="pull-right btn btn-info rounded visible-xs <?=$card->next_cardid?'':'disabled'?>">Next</a>
                            </div>
                            <div class="col-sm-10">
                                <div class="card"> 
                                  <div class="front fs20 rounded20 shadow v_pad20 fullwidth bg-red txtCenter whitecolor" style="min-height: 300px;"> 
                                    <?=$card->front?>
                                  </div> 
                                  <div class="back fs15 rounded20 shadow v_pad20 fullwidth bg-blue txtCenter whitecolor" style="min-height: 300px;">
                                    <?=$card->back?>
                                  </div> 
                                </div>
                            </div>
                            <div class="col-sm-1 hidden-xs">
                                <a href="<?=$nextcard_url?>" class="btn btn-info rounded <?=$card->next_cardid?'':'disabled'?>">Next</a>
                            </div>
                        </div>
                    	
                    </div>
                </div>
            </div>

       	</article>
    </div>
</section>

<?php

$late_script_file='<script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>';
$late_script = '
                    $(".card").flip();
';

?>