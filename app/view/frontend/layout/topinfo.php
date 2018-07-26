<?php
$tel=$email='';
if(@json_decode($pageData->label->system_title->sys->data)){
	$contact = (object) json_decode($pageData->label->system_title->sys->data);
	$tel=$contact->tel;
	$email=$contact->email;
}
?>
<div class="container v_mgn0 btm_border_gray">
    <!-- Topbar -->
    <div class="topbar v_pad3 center-xs mgn0">
        <ul class="loginbar inline-block h_pad0">
            <li><a href="javascript:void(0);"><i class="fa fa-mobile"></i> ទូរស័ព្ទ៖ (855) 23 000 000</a></li>
            <li class="topbar-devider"></li>
            <li><a href="javascript:void(0);"><i class="fa fa-envelope-o"></i> អ៊ីម៉ែល៖ info@eschool.com</a></li></li>
        </ul>
        <ul class="loginbar pull-right center-xs h_pad0">
            <li class="v_pad0"><a href="<?=$pageData->label->label->register->url?>"><?=$pageData->label->label->register->icon.' '.$pageData->label->label->register->title?></a></li>
            <li class="topbar-devider v_pad0"></li>
            <li class="v_pad0"><a href="<?=$pageData->label->label->login->url?>"><?=$pageData->label->label->login->icon.' '.$pageData->label->label->login->title?></a></li>
        </ul>
    </div>
    <!-- End Topbar -->
</div>
<div class="container">
<!-- Logo -->
                <a class="logo" href="/">
                    <img src="http://eschooldemo.ezonecloud.com/images/logo.png" width="180" class="mgn0" alt="Logo">
                </a>
                <!-- End Logo -->

                

                <!-- Toggle get grouped for better mobile display -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-bars"></span>
                </button>
                <!-- End Toggle -->
</div>