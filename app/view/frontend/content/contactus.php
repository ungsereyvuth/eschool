<div class="page_content bg-white">
    <div class="clearfix">
    	<div class="col-sm-5">
        	<div class="headline">
                <h3><?=$pageData->label->label->address->title?></h3>
            </div>
        	<?=$pageData->data->content->contactInfo->info?>
            <div class="footer-v4">
                <ul class="list-inline shop-social">
                    <?php
                    foreach($pageData->label->social_network as $key=>$value){
                        echo '<li><a href="'.$value->url.'" class="tooltips" title="'.$value->title.'" target="new">'.$value->icon.'</a></li>';
                    }
                    ?>
                </ul>
            </div>   
        </div>
        <div class="col-sm-7">
        	<form class="ajaxfrm sky-form noborder" role="form" id="contactus-form" data-func="submit_form" data-reset="1" action="" method="post">
                <div class="headline">
                	<h3><?=$pageData->label->label->leave_message->title?></h3>
                </div>
                <div class="row">
                	<div class="col-sm-6">
                        <section>
                            <div class="input">
                                <i class="icon-prepend fa fa-user"></i>
                                <input type="text" name="contact_fullname" placeholder="<?=$pageData->label->label->fullname->title?>" class="form-control">
                            </div>
                        </section>
                    </div>
                    <div class="col-sm-6">
                    	<section>
                            <div class="input">
                            	<span class="icon-prepend">@</span>
                                <input type="email" name="contact_email" placeholder="<?=$pageData->label->label->email->title?>" class="form-control" value="<?=$usersession->isLogin()?$usersession->info()->email:''?>">
                            </div>
                        </section>
                    </div>
                    <div class="col-sm-12">
                    	<section>
                            <div class="input">
                            	<i class="icon-prepend fa fa-pencil"></i>
                                <input type="text" name="contact_subject" placeholder="<?=$pageData->label->label->topic->title?>" class="form-control">
                            </div>
                        </section>
                    </div>
                </div>
                
                <div class="row">
                	<div class="col-sm-12">
                    	<section>
                            <div class="textarea">
                                <i class="icon-prepend fa fa-comment"></i>
                                <textarea rows="3" placeholder="<?=$pageData->label->label->description->title?>" name="message"></textarea>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                	<div class="col-sm-12">
                    	<section>
                            <label for="captcha"><?=$pageData->label->label->verify_code->title?></label> <span class="redStar">*</span>
                            <div class="row margin-bottom-10">                    
                                <div class="col-xs-6">
                                <input type="text" name="captcha" class="form-control" placeholder="<?=$pageData->label->label->code->title?>">
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-append input-group captchabox">
                                        <div id="captcha_img" class="form-control"></div>
                                        <span class="input-group-addon add-on renew_captcha click tooltips" title="<?=$pageData->label->label->change_code->title?>"><i class="fa fa-refresh"></i></span>
                                   </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                	<div class="col-sm-12 txtRight">
                		<button class="btn-u v_mgn3" type="submit"><?=$pageData->label->label->send->icon.' '.$pageData->label->label->send->title?></button>
                     </div>
                </div>   
                <input type="hidden" name="cmd" value="contactus">
                <div id="contactus_msg" data-loadtxt="<i class=&quot;fa fa-refresh&quot;></i> ដំណើរការ..."></div>
            </form>
        </div>
    </div>
    <hr />
    <div class="clearfix">
    	<div class="col-sm-12">
        	<?=$pageData->data->content->contactInfo->map?>
        </div>
    </div>
</div>