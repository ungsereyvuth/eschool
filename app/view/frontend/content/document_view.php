<?php $view = $pageData->data->content->viewdata;?>
<div class="page_content_front_end">
    <div class="sub-info fs11"><i class="fa fa-clock-o"></i> <?=khmerDate($view['created_date'])?></div>
    <p class="v_mgn15">
    <?=$view['description']?>
    </p>
</div>